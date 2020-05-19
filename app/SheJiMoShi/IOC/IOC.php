<?php

class IOC
{
    protected $binding = [];

    public function bind($abstract, $concrete)
    {
        // 因为 bind() 的时候还不需要创建对象，所以采用 closure，等到 make() 的时候再创建对象
        $this->binding[$abstract]['concrete'] = function ($ioc) use ($concrete) {
            return $ioc->build($concrete);
        };
    }

    public function make($abstract)
    {
        $concrete = $this->binding[$abstract]['concrete']; // 根据 key 获取 binding 的值

        return $concrete($this);
    }

    /**
     * 创建对象
     *
     * @param $concrete
     * @return object
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
     *
     * @param $paramters
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
}
