<?php

/* 适配器模式(Adapter) */

// 三脚插头没法插在四孔插座上
// 这时就需要一个适配器插在四孔插座上，把它变成三孔插座

class SanJiaoChaTou
{
    protected $mingCheng;

    public function __construct($mingCheng)
    {
        $this->mingCheng = '三脚插头 ' . $mingCheng;
    }

    public function chaRuChaZuo()
    {
        echo "{$this->mingCheng} 插入插座。" . PHP_EOL;
    }
}

class SanKongChaZuo
{
    public function sanKong220V()
    {
        echo '三孔 220 伏插座。' . PHP_EOL;
    }
}

class SiKongChaZuo
{
    public function siKong380V()
    {
        echo '四孔 380 伏插座。' . PHP_EOL;
    }
}

class SiZhuanSanShiPeiQi
{
    /**
     * @var SiKongChaZuo
     */
    protected $siKongChaZuo;

    public function __construct($siKongChaZuo)
    {
        $this->siKongChaZuo = $siKongChaZuo;
    }

    public function sanKong220V()
    {
        $this->siKongChaZuo->siKong380V();
        echo '转换插孔，电压适配。' . PHP_EOL;
    }
}

/* 测试代码 */

$sanJiaoChaTou = new SanJiaoChaTou('插头1');
$sanKongChaZuo = new SanKongChaZuo();
$sanKongChaZuo->sanKong220V();
$sanJiaoChaTou->chaRuChaZuo();

$sanJiaoChaTou = new SanJiaoChaTou('插头2');
$siKongChaZuo = new SiKongChaZuo();
$siZhuanSanShiPeiQi = new SiZhuanSanShiPeiQi($siKongChaZuo);
$siZhuanSanShiPeiQi->sanKong220V();
$sanJiaoChaTou->chaRuChaZuo();