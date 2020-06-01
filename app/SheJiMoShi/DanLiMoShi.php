<?php

/* 单例模式 */

/**
 * Class DouJiangJi 豆浆机，假设家里只有一个
 */
class DouJiangJi
{
    // 用静态私有变量保存该类唯一实例
    static private $weiYiDouJiangJi;

    // 豆浆机容量
    protected $rongLiang;

    // 防止使用 new 直接创建对象
    private function __construct()
    {
        $this->rongLiang = 500;
    }

    // 防止使用 clone() 克隆对象
    private function __clone()
    {
    }

    // 对外提供静态方法获取唯一实例对象
    static public function huoQuDouJiangJi()
    {
        if (!self::$weiYiDouJiangJi instanceof self) {
            // 如果对象没有创建过，则创建对象
            self::$weiYiDouJiangJi = new self();
        }
        return self::$weiYiDouJiangJi;
    }

    public function jiaLiao($peiLiao)
    {
        if ($this->rongLiang < $peiLiao) {
            echo "豆浆机装不下 {$peiLiao}ml 配料了。" . PHP_EOL;
        } else {
            echo "装入 {$peiLiao}ml 配料。" . PHP_EOL;
            $this->rongLiang -= $peiLiao;
        }
    }

    public function zuoDouJiang()
    {
        $douJiang = 500 - $this->rongLiang;
        echo "做 {$douJiang}ml 豆浆。" . PHP_EOL;
        $this->rongLiang = 500;
        echo "把做好的豆浆全部倒出。" . PHP_EOL;
    }
}

/* 测试代码 */

$douJiangJi1 = DouJiangJi::huoQuDouJiangJi();
$douJiangJi1->jiaLiao(200);
$douJiangJi1->jiaLiao(200);
$douJiangJi2 = DouJiangJi::huoQuDouJiangJi();
$douJiangJi2->jiaLiao(200);
$douJiangJi1->zuoDouJiang();
$douJiangJi2->jiaLiao(500);
$douJiangJi2->zuoDouJiang();