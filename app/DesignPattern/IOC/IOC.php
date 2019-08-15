<?php

require 'LogService.php';

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
        $reflector = new ReflectionClass($concrete);
        $constructor = $reflector->getConstructor();
        if (is_null($constructor)) {
            return $reflector->newInstance();
        } else {
            $dependencies = $constructor->getParameters();
            $instances = $this->getDependencies($dependencies);

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
