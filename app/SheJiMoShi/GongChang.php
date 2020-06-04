<?php

/* 工厂模式 */

// 假设不同的城市有不同的饭馆
// 不同的饭馆有相同或者不同的菜，这些菜有相同或不同的做法
// 不同城市的饭馆需要去不同城市的菜市场买菜

/**
 * Class CaiShiChang 菜市场
 */
abstract class CaiShiChang
{
    /**
     * @var array
     */
    public $kuCunList;

    public function jinHuo($caiMing, $zhiLiang)
    {
    }

    public function maiCai($caiMing, $zhiLiang)
    {
        echo "买{$zhiLiang}克{$this->kuCunList[$caiMing]['ming_cheng']}" . PHP_EOL;
    }
}

/**
 * Class Cai 菜
 */
abstract class Cai
{
    /**
     * @var string
     */
    protected $caiMing;

    /**
     * @var CaiShiChang
     */
    protected $caiShiChang;

    public function __construct(CaiShiChang $caiShiChang)
    {
        $this->sheZhiCaiMing();
        $this->caiShiChang = $caiShiChang;
    }

    abstract public function sheZhiCaiMing();

    abstract public function maiCai();

    abstract public function zuoCai();

    public function zhuangPan()
    {
        echo "把{$this->caiMing}装盘" . PHP_EOL;
    }

    public function shangCai()
    {
        echo "把{$this->caiMing}端上桌" . PHP_EOL;
    }
}

/**
 * Class FanGuan 饭馆
 */
abstract class FanGuan
{
    /**
     * @param $caiMing
     * @return Cai
     */
    abstract public function caiPu($caiMing);

    public function dianCai($caiMing)
    {
        $cai = $this->caiPu($caiMing);

        $cai->maiCai();
        $cai->zuoCai();
        $cai->zhuangPan();
        $cai->shangCai();

        return $cai;
    }
}

/* 菜的实例 */

class XiHongShiChaoDan extends Cai
{
    public function sheZhiCaiMing()
    {
        $this->caiMing = '西红柿炒鸡蛋';
    }

    public function maiCai()
    {
        $this->caiShiChang->maiCai('xi_hong_shi', 500);
        $this->caiShiChang->maiCai('ji_dan', 200);
    }

    public function zuoCai()
    {
        echo '做西红柿炒鸡蛋' . PHP_EOL;
    }
}

class ChaoTuDouSi extends Cai
{
    public function sheZhiCaiMing()
    {
        $this->caiMing = '炒土豆丝';
    }

    public function maiCai()
    {
        $this->caiShiChang->maiCai('tu_dou', 500);
    }

    public function zuoCai()
    {
        echo '做炒土豆丝' . PHP_EOL;
    }
}

class LaChaoTuDouSi extends ChaoTuDouSi
{
    public function maiCai()
    {
        parent::maiCai();
        $this->caiShiChang->maiCai('la_jiao', 50);
    }

    public function zuoCai()
    {
        parent::zuoCai();
        echo '加点辣椒' . PHP_EOL;
    }
}

/* 菜市场的实例 */

class JiangSuCaiShiChang extends CaiShiChang
{
    public function __construct()
    {
        $this->kuCunList = [
            'xi_hong_shi' => [
                'ming_cheng' => '江苏西红柿',
                'ku_cun'     => 1000
            ],
            'ji_dan'      => [
                'ming_cheng' => '江苏鸡蛋',
                'ku_cun'     => 1000
            ],
            'tu_dou'      => [
                'ming_cheng' => '江苏土豆',
                'ku_cun'     => 1000
            ]
        ];
    }
}

class SiChuanCaiShiChang extends CaiShiChang
{
    public function __construct()
    {
        $this->kuCunList = [
            'tu_dou'  => [
                'ming_cheng' => '四川土豆',
                'ku_cun'     => 1000
            ],
            'la_jiao' => [
                'ming_cheng' => '四川辣椒',
                'ku_cun'     => 1000
            ]
        ];
    }
}

/* 饭馆的实例 */

class JiangSuFanGuan extends FanGuan
{
    protected $caiShiChang;

    public function __construct($caiShiChang = null)
    {
        if ($caiShiChang !== null) {
            $this->caiShiChang = $caiShiChang;
        } else {
            $this->caiShiChang = new JiangSuCaiShiChang();
        }
    }

    public function caiPu($caiMing)
    {
        $caiPu = null;
        if ($caiMing === 'xi_hong_shi_chao_dan') {
            $caiPu = new XiHongShiChaoDan($this->caiShiChang);
        } elseif ($caiMing === 'chao_to_dou_si') {
            $caiPu = new ChaoTuDouSi($this->caiShiChang);
        }

        return $caiPu;
    }
}

class SiChuanFanGuan extends FanGuan
{
    protected $caiShiChang;

    public function __construct($caiShiChang = null)
    {
        if ($caiShiChang !== null) {
            $this->caiShiChang = $caiShiChang;
        } else {
            $this->caiShiChang = new SiChuanCaiShiChang();
        }
    }

    public function caiPu($caiMing)
    {
        $caiPu = null;
        if ($caiMing === 'chao_to_dou_si') {
            $caiPu = new LaChaoTuDouSi($this->caiShiChang);
        }

        return $caiPu;
    }
}

/* 测试代码 */

$fanGuan = new JiangSuFanGuan();
$fanGuan->dianCai('xi_hong_shi_chao_dan');
$fanGuan->dianCai('chao_to_dou_si');

$fanGuan = new SiChuanFanGuan();
$fanGuan->dianCai('chao_to_dou_si');