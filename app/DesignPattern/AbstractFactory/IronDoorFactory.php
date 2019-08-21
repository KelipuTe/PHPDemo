<?php
/**
 * Created by PhpStorm.
 * User: Kelip
 * Date: 2019/8/21
 * Time: 23:12
 */

namespace App\DesignPattern\Factory;


class IronDoorFactory implements DoorFactoryInterface
{
    public function makeDoor()
    {
        return new IronDoor();
    }

    public function makeFittingExpert()
    {
        return new Welder();
    }
}