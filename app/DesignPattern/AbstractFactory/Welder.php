<?php
/**
 * Created by PhpStorm.
 * User: Kelip
 * Date: 2019/8/21
 * Time: 23:13
 */

namespace App\DesignPattern\Factory;


class Welder implements DoorFittingExpertInterface
{
    public function getDescription()
    {
        echo 'I can only fit iron doors';
    }
}