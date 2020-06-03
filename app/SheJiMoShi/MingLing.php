<?php

/* 命令模式 */

// 用一个遥控器同时控制家里的几个电灯和自动门

/**
 * Interface YaoKongQiJieKou 遥控器接口
 */
interface YaoKongQiJieKou
{
    // 执行指令按钮
    public function zhiXingZhiLing();

    // 回退指令按钮
    public function huiTuiZhiLing();
}

/**
 * Class KongZhiLing 空指令或无效指令
 */
class KongZhiLing implements YaoKongQiJieKou
{
    public function zhiXingZhiLing()
    {
    }

    public function huiTuiZhiLing()
    {
    }
}

/**
 * Class DianDeng 电灯
 */
class DianDeng
{
    // 电灯位置
    public $weiZhi;

    public function __construct($weiZhi)
    {
        $this->weiZhi = $weiZhi;
    }

    public function daKai()
    {
        echo "打开{$this->weiZhi}的灯" . PHP_EOL;
    }

    public function guanBi()
    {
        echo "关闭{$this->weiZhi}的灯" . PHP_EOL;
    }
}

/**
 * Class KaiDengZhiLing 开灯指令
 */
class KaiDengZhiLing implements YaoKongQiJieKou
{
    /**
     * @var DianDeng
     */
    public $dianDeng;

    public function __construct($dianDeng)
    {
        $this->dianDeng = $dianDeng;
    }

    public function zhiXingZhiLing()
    {
        $this->dianDeng->daKai();
    }

    public function huiTuiZhiLing()
    {
        $this->dianDeng->guanBi();
    }
}

/**
 * Class GuanDengZhiLing 关灯指令
 */
class GuanDengZhiLing implements YaoKongQiJieKou
{
    /**
     * @var DianDeng
     */
    public $dianDeng;

    public function __construct($dianDeng)
    {
        $this->dianDeng = $dianDeng;
    }

    public function zhiXingZhiLing()
    {
        $this->dianDeng->guanBi();
    }

    public function huiTuiZhiLing()
    {
        $this->dianDeng->daKai();
    }
}

/**
 * Class ZiDongMen 自动门
 */
class ZiDongMen
{
    // 自动门位置
    public $weiZhi;

    public function __construct($weiZhi)
    {
        $this->weiZhi = $weiZhi;
    }

    public function daKai()
    {
        echo "打开{$this->weiZhi}的自动门" . PHP_EOL;
    }

    public function guanBi()
    {
        echo "关闭{$this->weiZhi}的自动门" . PHP_EOL;
    }
}

class KaiMenZhiLing implements YaoKongQiJieKou
{
    /**
     * @var ZiDongMen
     */
    public $ziDongMen;

    public function __construct($ziDongMen)
    {
        $this->ziDongMen = $ziDongMen;
    }

    public function zhiXingZhiLing()
    {
        $this->ziDongMen->daKai();
    }

    public function huiTuiZhiLing()
    {
        $this->ziDongMen->guanBi();
    }
}

class GuanMenZhiLing implements YaoKongQiJieKou
{
    /**
     * @var ZiDongMen
     */
    public $ziDongMen;

    public function __construct($ziDongMen)
    {
        $this->ziDongMen = $ziDongMen;
    }

    public function zhiXingZhiLing()
    {
        $this->ziDongMen->guanBi();
    }

    public function huiTuiZhiLing()
    {
        $this->ziDongMen->daKai();
    }
}

/**
 * Class YaoKongQi 遥控器
 */
class YaoKongQi
{
    /**
     * @var array [打开指令指令集]
     */
    public $daKaiZhiLingJi;

    /**
     * @var array [关闭按钮指令集]
     */
    public $guanBiZhiLingJi;

    /**
     * 退回指令记录上次的操作
     * @var YaoKongQiJieKou
     */
    public $huiTuiZhiLing;

    /**
     * 设置指令集
     * @param $kongZhiDuiXiang [控制对象]
     * @param $daKaiZhiLing [打开指令]
     * @param $guanBiZhiLing [关闭指令]
     */
    public function sheZhiZhiLingJi($kongZhiDuiXiang, $daKaiZhiLing, $guanBiZhiLing)
    {
        // 初始化空指令
        $this->daKaiZhiLingJi[$kongZhiDuiXiang] = new KongZhiLing();
        $this->guanBiZhiLingJi[$kongZhiDuiXiang] = new KongZhiLing();
        // 如果是有效的指令类型才会存入遥控器的指令集
        if ($daKaiZhiLing instanceof YaoKongQiJieKou) {
            $this->daKaiZhiLingJi[$kongZhiDuiXiang] = $daKaiZhiLing;
        }
        if ($guanBiZhiLing instanceof YaoKongQiJieKou) {
            $this->guanBiZhiLingJi[$kongZhiDuiXiang] = $guanBiZhiLing;
        }
    }

    /**
     * 按下打开按钮
     * @param $kongZhiDuiXiang [控制对象]
     */
    public function daKaiAnNiu($kongZhiDuiXiang)
    {
        $this->daKaiZhiLingJi[$kongZhiDuiXiang]->zhiXingZhiLing();
        $this->huiTuiZhiLing = $this->daKaiZhiLingJi[$kongZhiDuiXiang];
    }

    /**
     * 按下关闭按钮
     * @param $kongZhiDuiXiang [控制对象]
     */
    public function guanBiAnNiu($kongZhiDuiXiang)
    {
        $this->guanBiZhiLingJi[$kongZhiDuiXiang]->zhiXingZhiLing();
        $this->huiTuiZhiLing = $this->guanBiZhiLingJi[$kongZhiDuiXiang];
    }

    /**
     * 回退按钮
     */
    public function huiTuiAnNiu()
    {
        // 直接调用上次操作的回退命令
        $this->huiTuiZhiLing->huiTuiZhiLing();
    }
}

/* 测试代码 */

$yaoKongQi = new YaoKongQi();

$keTingDianDeng = new DianDeng('客厅');
$keTingKaiDengZhiLing = new KaiDengZhiLing($keTingDianDeng);
$keTingGuanDengZhiLing = new GuanDengZhiLing($keTingDianDeng);
$yaoKongQi->sheZhiZhiLingJi('ke_ting_deng', $keTingKaiDengZhiLing, $keTingGuanDengZhiLing);

$woShiDianDeng = new DianDeng('卧室');
$woShiKaiDengZhiLing = new KaiDengZhiLing($woShiDianDeng);
$woShiGuanDengZhiLing = new GuanDengZhiLing($woShiDianDeng);
$yaoKongQi->sheZhiZhiLingJi('wo_shi', $woShiKaiDengZhiLing, $woShiGuanDengZhiLing);

$qianMenZiDongMen = new ZiDongMen('前门');
$qianMenKaiMenZhiLing = new KaiMenZhiLing($qianMenZiDongMen);
$qianMenGuanMenZhiLing = new GuanMenZhiLing($qianMenZiDongMen);
$yaoKongQi->sheZhiZhiLingJi('qian_men', $qianMenKaiMenZhiLing, $qianMenGuanMenZhiLing);

$yaoKongQi->daKaiAnNiu('wo_shi');
$yaoKongQi->huiTuiAnNiu();
$yaoKongQi->daKaiAnNiu('ke_ting_deng');
$yaoKongQi->guanBiAnNiu('ke_ting_deng');
$yaoKongQi->daKaiAnNiu('qian_men');
$yaoKongQi->guanBiAnNiu('qian_men');
$yaoKongQi->huiTuiAnNiu();
