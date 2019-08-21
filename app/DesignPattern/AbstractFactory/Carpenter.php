<?php
/**
 * Created by PhpStorm.
 * User: Kelip
 * Date: 2019/8/21
 * Time: 23:14
 */

namespace App\DesignPattern\Factory;


class Carpenter implements DoorFittingExpertInterface
{
    public function getDescription()
    {
        echo 'I can only fit wooden doors';
    }
}