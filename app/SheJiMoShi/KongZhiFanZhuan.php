<?php

/* 控制反转容器（IOC 容器） */

/**
 * Interface LogInterface 日志接口
 */
interface LogInterface
{
    public function saveLog();
}

/**
 * Class FileLog 文件记录日志
 */
class FileLog implements LogInterface
{
    public function saveLog()
    {
        echo "save log by file" . PHP_EOL;
    }
}

/**
 * Class DatabaseLog 数据库记录日志
 */
class DatabaseLog implements LogInterface
{
    public function saveLog()
    {
        echo "save log by database" . PHP_EOL;
    }
}

/**
 * Class LogService 日志操作类
 */
class LogService
{
    protected $log;

    public function __construct(LogInterface $log)
    {
        $this->log = $log;
    }

    public function saveLog()
    {
        $this->log->saveLog();
    }
}

/**
 * Class IOC 容器
 */
class IOC
{
    protected $binding = [];

    /**
     * 绑定抽象类和实例类的关系
     * @param $abstract
     * @param $concrete
     */
    public function bind($abstract, $concrete)
    {
        // 因为 bind() 的时候还不需要创建对象，所以采用 closure，等到 make() 的时候再创建对象
        $this->binding[$abstract]['concrete'] = function ($ioc) use ($concrete) {
            return $ioc->build($concrete);
        };
    }

    /**
     * 创建对象
     * @param $concrete
     * @return object [实例对象]
     * @throws ReflectionException
     */
    public function build($concrete)
    {
        // 获取 reflectionClass 对象
        $reflector = new ReflectionClass($concrete);
        // 拿到构造函数
        $constructor = $reflector->getConstructor();
        if (is_null($constructor)) {
            // 创建对象
            return $reflector->newInstance();
        } else {
            // 拿到构造函数的所有依赖参数
            $dependencies = $constructor->getParameters();
            $instances = $this->getDependencies($dependencies);
            // 创建对象，需要传递参数
            return $reflector->newInstanceArgs($instances);
        }
    }

    /**
     * 获取参数依赖
     * @param $paramters [反射得到的依赖参数]
     * @return array
     */
    protected function getDependencies($paramters)
    {
        $dependencies = [];
        foreach ($paramters as $paramter) {
            $dependencies[] = $this->make($paramter->getClass()->name);
        }
        return $dependencies;
    }

    /**
     * 创建对象
     * @param $abstract
     * @return mixed
     */
    public function make($abstract)
    {
        $concrete = $this->binding[$abstract]['concrete']; // 根据 key 获取 binding 的值

        return $concrete($this);
    }
}

/* 测试代码 */

// $ioc = new IOC();
// // $ioc->bind('LogInterface','DataBaseLog');
// $ioc->bind('LogInterface','FileLog');
// $ioc->bind('LogService','LogService');

// $logService = $ioc->make('LogService');
// $logService->saveLog();