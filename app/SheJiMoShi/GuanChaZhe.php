<?php

/* 观察者模式 */

/**
 * Interface QiXiangShuJUInterface 气象数据接口，被观察者
 */
interface QiXiangShuJUInterface
{
    // 注册观察者
    public function tianJiaXianShiPingMu(XianShiPingMuInterface $observer);

    // 移除观察者
    public function yiChuXianShiPingMu(XianShiPingMuInterface $observer);

    // 数据发生变化，通知观察者
    public function shuJuFaShengBianHua();
}

/**
 * Interface XianShiPingMuInterface 显示屏幕接口，观察者
 */
interface XianShiPingMuInterface
{
    // 获取识别号
    public function huoQuShiBieHao();

    // 数据更新时的响应
    public function shuJuGenXin(float $qiWen, float $shiDu, float $qiYa);
}

/**
 * Class QiXiangShuJu 气象数据主体，被观察者
 */
class QiXiangShuJu implements QiXiangShuJUInterface
{
    // 显示屏幕列表，观察者列表
    protected $xianShiPingMuList;

    // 气温
    protected $qiWen;

    // 湿度
    protected $shiDu;

    // 气压
    protected $qiYa;

    public function __construct()
    {
        $this->xianShiPingMuList = [];
    }

    public function tianJiaXianShiPingMu(XianShiPingMuInterface $xianShiPingMu)
    {
        $this->xianShiPingMuList[$xianShiPingMu->huoQuShiBieHao()] = $xianShiPingMu;
    }

    public function yiChuXianShiPingMu(XianShiPingMuInterface $xianShiPingMu)
    {
        unset($this->xianShiPingMuList[$xianShiPingMu->huoQuShiBieHao()]);
    }

    public function shuJuFaShengBianHua()
    {
        foreach ($this->xianShiPingMuList as $itemXianShiPingMu) {
            $itemXianShiPingMu->shuJuGenXin($this->qiWen, $this->shiDu, $this->qiYa);
        }
    }

    // 设置新的气象数据，通知观察者
    public function setMeasurements(float $qiWen, float $shiDu, float $qiYa)
    {
        $this->qiWen = $qiWen;
        $this->shiDu = $shiDu;
        $this->qiYa = $qiYa;
        $this->shuJuFaShengBianHua();
    }
}

/**
 * Class XianShiPingMu 显示屏幕，观察者
 */
class XianShiPingMu implements XianShiPingMuInterface
{
    // 观察者唯一标识
    protected $weiYiBiaoShi;

    // 被观察的天气数据主体
    protected $qiXiangShuJu;

    // 气温
    protected $qiWen;

    // 湿度
    protected $shiDu;

    // 气压
    protected $qiYa;

    public function __construct($weiYiBiaoShi, QiXiangShuJu $qiXiangShuJu)
    {
        $this->weiYiBiaoShi = $weiYiBiaoShi;
        $this->qiXiangShuJu = $qiXiangShuJu;
        $qiXiangShuJu->tianJiaXianShiPingMu($this);
    }

    public function huoQuShiBieHao()
    {
        return $this->weiYiBiaoShi;
    }

    public function shuJuGenXin(float $qiWen, float $shiDu, float $qiYa)
    {
        $this->qiWen = $qiWen;
        $this->shiDu = $shiDu;
        $this->qiYa = $qiYa;
        $this->shuJuXianShi();
    }

    // 数据展示
    public function shuJuXianShi()
    {
        echo "显示屏幕：{$this->weiYiBiaoShi}，当前气温：{$this->qiYa};当前湿度：{$this->shiDu};当前气压：{$this->qiYa};" . PHP_EOL;
    }
}

/* 测试代码 */

$qiXiangShuJu1 = new QiXiangShuJu();
$qiXiangShuJu2 = new QiXiangShuJu();

$xianShiPingMu1 = new XianShiPingMu('屏幕1', $qiXiangShuJu1);
$xianShiPingMu2 = new XianShiPingMu('屏幕2', $qiXiangShuJu2);
$xianShiPingMu3 = new XianShiPingMu('屏幕3', $qiXiangShuJu1);

$qiXiangShuJu1->setMeasurements(1, 11, 111);
$qiXiangShuJu2->setMeasurements(2, 22, 222);
$qiXiangShuJu1->setMeasurements(3, 33, 333);