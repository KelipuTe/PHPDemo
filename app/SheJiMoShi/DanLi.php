<?php

/* 单例模式 */

// 假设家里只有一个豆浆机
// 所以，重复的新建对象都会得到同一个豆浆机
// 重复的加配料最终都会加到同一个豆浆机里去

/**
 * Class DouJiangJi 豆浆机
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

    // 加配料，不能超过豆浆机容积
    public function jiaPeiLiao($peiLiao)
    {
        if ($this->rongLiang < $peiLiao) {
            echo "豆浆机装不下 {$peiLiao}ml 配料了。" . PHP_EOL;
        } else {
            echo "装入 {$peiLiao}ml 配料。" . PHP_EOL;
            $this->rongLiang -= $peiLiao;
        }
    }

    // 做豆浆，会消耗掉所有的配料
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
$douJiangJi1->jiaPeiLiao(200);
$douJiangJi1->jiaPeiLiao(200);
$douJiangJi2 = DouJiangJi::huoQuDouJiangJi();
$douJiangJi2->jiaPeiLiao(200);
$douJiangJi1->zuoDouJiang();
$douJiangJi2->jiaPeiLiao(500);
$douJiangJi2->zuoDouJiang();