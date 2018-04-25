<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/18
 * Time: 11:57
 */

class Task
{
    protected $taskId;   // 任务ID
    protected $coroutine; // 协同程序
    protected $sendValue = null;
    protected $beforeFirstYield = true;

    protected $exception = null;


    /**
     * Task constructor.
     * @param $taskId
     * @param Generator $coroutine
     */
    public function __construct($taskId, Generator $coroutine)
    {
        $this->taskId = $taskId;
        $this->coroutine = $coroutine;
    }


    public function getTaskId()
    {
        return $this->taskId;
    }


    public function setException($exception)
    {
        $this->exception = $exception;
    }


    public function setSendValue($sendValue)
    {
        $this->sendValue = $sendValue;
    }


    public function run()
    {
        if ($this->beforeFirstYield) {
            $this->beforeFirstYield = false;

            return $this->coroutine->current();
        } elseif ($this->exception) {
            $retval = $this->coroutine->throw($this->exception);
            $this->exception = null;

            return $retval;
        } else {
            $retval = $this->coroutine->send($this->sendValue);
            $this->sendValue = null;

            return $retval;
        }
    }


    public function isFinished()
    {
        return !$this->coroutine->valid();
    }
}


/**
 * 任务调度器
 *
 * Class Scheduler
 */
class Scheduler
{
    protected $maxTaskId = 0;
    protected $taskMap = []; // taskId => task
    protected $taskQueue;


    public function __construct()
    {
        $this->taskQueue = new SplQueue();
    }


    public function newTask(Generator $coroutine)
    {
        $tid = ++$this->maxTaskId;
        $task = new Task($tid, $coroutine);
        $this->taskMap[$tid] = $task;
        $this->schedule($task);

        return $tid;
    }


    public function killTask($tid)
    {
        if (!isset($this->taskMap[$tid])) {
            return false;
        }

        unset($this->taskMap[$tid]);

        // This is a bit ugly and could be optimized so it does not have to walk the queue,
        // but assuming that killing tasks is rather rare I won't bother with it now
        foreach ($this->taskQueue as $i => $task) {
            if ($task->getTaskId() === $tid) {
                unset($this->taskQueue[$i]);
                break;
            }
        }

        return true;
    }


    public function schedule(Task $task)
    {
        $this->taskQueue->enqueue($task);
    }


    public function run()
    {
        while (!$this->taskQueue->isEmpty()) {
            $task = $this->taskQueue->dequeue();
            $retval = $task->run();

            if ($retval instanceof SystemCall) {
                $retval($task, $this);
                continue;
            }

            if ($task->isFinished()) {
                unset($this->taskMap[$task->getTaskId()]);
            } else {
                $this->schedule($task);
            }
        }
    }
}

/**
 * 系统调用
 *
 * Class SystemCall
 */
class SystemCall
{
    protected $callback;


    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }


    protected $waitingForRead = [];
    protected $waitingForWrite = [];


    public function waitForRead($socket, Task $task)
    {
        if (isset($this->waitingForRead[(int)$socket])) {
            $this->waitingForRead[(int)$socket][1][] = $task;
        } else {
            $this->waitingForRead[(int)$socket] = [$socket, [$task]];
        }
    }


    public function waitForWrite($socket, Task $task)
    {
        if (isset($this->waitingForWrite[(int)$socket])) {
            $this->waitingForWrite[(int)$socket][1][] = $task;
        } else {
            $this->waitingForWrite[(int)$socket] = [$socket, [$task]];
        }
    }


    /**
     * 对象当做方式调用的时候自动执行方法
     *
     * @param Task $task
     * @param Scheduler $scheduler
     * @return mixed
     */
    public function __invoke(Task $task, Scheduler $scheduler)
    {
        $callback = $this->callback;

        return $callback($task, $scheduler);
    }


    protected function ioPoll($timeout)
    {
        $rSocks = [];
        foreach ($this->waitingForRead as list($socket)) {
            $rSocks[] = $socket;
        }

        $wSocks = [];
        foreach ($this->waitingForWrite as list($socket)) {
            $wSocks[] = $socket;
        }

        $eSocks = []; // dummy

        if (!stream_select($rSocks, $wSocks, $eSocks, $timeout)) {
            return;
        }

        foreach ($rSocks as $socket) {
            list(, $tasks) = $this->waitingForRead[(int)$socket];
            unset($this->waitingForRead[(int)$socket]);

            foreach ($tasks as $task) {
                $this->schedule($task);
            }
        }

        foreach ($wSocks as $socket) {
            list(, $tasks) = $this->waitingForWrite[(int)$socket];
            unset($this->waitingForWrite[(int)$socket]);

            foreach ($tasks as $task) {
                $this->schedule($task);
            }
        }
    }


    protected function ioPollTask()
    {
        while (true) {
            if ($this->taskQueue->isEmpty()) {
                $this->ioPoll(null);
            } else {
                $this->ioPoll(0);
            }
            yield;
        }
    }
}


function getTaskId()
{
    return new SystemCall(
        function (Task $task, Scheduler $scheduler) {
            $task->setSendValue($task->getTaskId());
            $scheduler->schedule($task);
        }
    );
}


function newTask(Generator $coroutine)
{
    return new SystemCall(
        function (Task $task, Scheduler $scheduler) use ($coroutine) {
            $task->setSendValue($scheduler->newTask($coroutine));
            $scheduler->schedule($task);
        }
    );
}


function killTask($tid)
{
    return new SystemCall(
        function (Task $task, Scheduler $scheduler) use ($tid) {
//            $task->setSendValue($scheduler->killTask($tid));
//            $scheduler->schedule($task);
            if ($scheduler->killTask($tid)) {
                $scheduler->schedule($task);
            } else {
                throw new InvalidArgumentException('Invalid task ID!');
            }
        }
    );
}


//function task($max)
//{
//    $tid = (yield getTaskId());
//
//    for ($i = 1; $i <= $max; ++$i) {
//        echo "This is task $tid iteration $i.\n";
//        yield;
//    }
//}
//
//
//$scheduler = new Scheduler;
//
//$scheduler->newTask(task(10));
//$scheduler->newTask(task(5));
//
//$scheduler->run();

function childTask()
{
    $tid = (yield getTaskId());
    while (true) {
        echo "Child task $tid still alive!\n";
        yield;
    }
}


function task()
{
    $tid = (yield getTaskId());
    $childTid = (yield newTask(childTask()));

    for ($i = 1; $i <= 6; ++$i) {
        echo "Parent task $tid iteration $i.\n";
        yield;

        if ($i == 3) {
            yield killTask($childTid);
        }
    }
}


//$scheduler = new Scheduler;
//$scheduler->newTask(task());
//$scheduler->run();


function server($port)
{
    echo "Starting server at port $port...\n";

    $socket = @stream_socket_server("tcp://localhost:$port", $errNo, $errStr);
    if (!$socket) {
        throw new Exception($errStr, $errNo);
    }

    stream_set_blocking($socket, 0);

    while (true) {
        yield waitForRead($socket);
        $clientSocket = stream_socket_accept($socket, 0);
        yield newTask(handleClient($clientSocket));
    }
}


function handleClient($socket)
{
    yield waitForRead($socket);
    $data = fread($socket, 8192);

    $msg = "Received following request:\n\n$data";
    $msgLength = strlen($msg);

    $response = <<<RES
HTTP/1.1 200 OK\r
Content-Type: text/plain\r
Content-Length: $msgLength\r
Connection: close\r
\r
$msg
RES;

    yield waitForWrite($socket);
    fwrite($socket, $response);

    fclose($socket);
}


$scheduler = new Scheduler;
$scheduler->newTask(server(8000));
$scheduler->run();


class CoroutineReturnValue
{
    protected $value;


    public function __construct($value)
    {
        $this->value = $value;
    }


    public function getValue()
    {
        return $this->value;
    }
}

function retval($value)
{
    return new CoroutineReturnValue($value);
}


//$retval = (yield someCoroutine($foo, $bar));
//yield retval("I'm a return value!");

function stackedCoroutine(Generator $gen)
{
    $stack = new SplStack;

    for (; ;) {
        $value = $gen->current();

        if ($value instanceof Generator) {
            $stack->push($gen);
            $gen = $value;
            continue;
        }

        $isReturnValue = $value instanceof CoroutineReturnValue;
        if (!$gen->valid() || $isReturnValue) {
            if ($stack->isEmpty()) {
                return;
            }

            $gen = $stack->pop();
            $gen->send($isReturnValue ? $value->getValue() : null);
            continue;
        }

        $gen->send(yield $gen->key() => $value);
    }
}


class CoSocket
{
    protected $socket;


    public function __construct($socket)
    {
        $this->socket = $socket;
    }


    public function accept()
    {
        yield waitForRead($this->socket);
        yield retval(new CoSocket(stream_socket_accept($this->socket, 0)));
    }


    public function read($size)
    {
        yield waitForRead($this->socket);
        yield retval(fread($this->socket, $size));
    }


    public function write($string)
    {
        yield waitForWrite($this->socket);
        fwrite($this->socket, $string);
    }


    public function close()
    {
        @fclose($this->socket);
    }
}


