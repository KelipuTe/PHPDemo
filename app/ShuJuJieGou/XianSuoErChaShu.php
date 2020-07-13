<?php
/* 线索二叉树 */

namespace App\ShuJuJieGou;


require_once 'XianSuoErChaShuJieDian.php';

/**
 * Class XianSuoErChaShu [线索二叉树]
 * @package App\ShuJuJieGou
 */
class XianSuoErChaShu
{
    /**
     * @var array [二叉树元素数组]
     */
    protected $yuanSuList;

    /**
     * @var XianSuoErChaShuJieDian [根结点]
     */
    protected $genJieDian;

    /**
     * @var XianSuoErChaShuJieDian [前驱结点]
     * 前驱结点需要额外记录，而后继结点不需要
     */
    protected $qianQuJieDian;

    /**
     * @var XianSuoErChaShuJieDian [前驱结点值]
     * 前驱结点需要额外记录，而后继结点不需要
     */
    protected $qianQuJieDianZhi;

    /**
     * ErChaShu constructor.
     * @param $yuanSuList [二叉树元素数组]
     */
    public function __construct($yuanSuList)
    {
        $this->yuanSuList = $yuanSuList;
        $this->genJieDian = null;
        $this->qianQuJieDian = null;
        $this->qianQuJieDianZhi = null;
    }

    /**
     * 用数组构造二叉树
     */
    public function buildTreeWithArray()
    {
        // 空数组返回 null
        if (count($this->yuanSuList) === 0) return null;
        // 创建根结点
        $this->genJieDian = new XianSuoErChaShuJieDian($this->yuanSuList[0]);
        for ($i = 1, $numLen = count($this->yuanSuList); $i < $numLen; $i++) {
            // 依次添加结点
            $jieDian = new XianSuoErChaShuJieDian($this->yuanSuList[$i]);
            $this->chaRuJieDianByNLR($jieDian);
        }
    }

    /**
     * 以先序遍历的顺序插入结点（根左右）
     * @param XianSuoErChaShuJieDian $jieDian
     */
    protected function chaRuJieDianByNLR($jieDian)
    {
        // 初始化一个队列
        $duiLie = [];
        // 根结点入队
        array_unshift($duiLie, $this->genJieDian);
        while (!empty($duiLie)) {
            // 持续遍历结点，直到队列为空
            // 队列元素出队
            $tempJieDian = array_pop($duiLie);
            if ($tempJieDian->zuoZhiZhen === null) {
                // 如果左结点为空就插入结点
                $tempJieDian->zuoZhiZhen = $jieDian;
                $tempJieDian->zuoBiaoShi = 1;

                return;
            } else {
                // 左结点先入队
                array_unshift($duiLie, $tempJieDian->zuoZhiZhen);
            }
            if ($tempJieDian->youZhiZhen === null) {
                // 如果右结点为空就插入结点
                $tempJieDian->youZhiZhen = $jieDian;
                $tempJieDian->youBiaoShi = 1;

                return;
            } else {
                // 右结点后入队
                array_unshift($duiLie, $tempJieDian->youZhiZhen);
            }
        }
    }

    /**
     * 获取二叉树
     * @return XianSuoErChaShuJieDian
     */
    public function getErChaShu()
    {
        return $this->genJieDian;
    }

    /**
     * 使用前序遍历移除多余的空结点
     * @param XianSuoErChaShuJieDian $genJieDian
     */
    public function qianXuBianLiXiuJian($genJieDian)
    {
        if ($genJieDian === null) return;
        if ($genJieDian->jieDianZhi === null) return;
        if ($genJieDian->zuoZhiZhen !== null && $genJieDian->zuoZhiZhen->jieDianZhi === null) {
            $genJieDian->zuoZhiZhen = null;
            $genJieDian->zuoBiaoShi = -1;
        } else {
            $this->qianXuBianLiXiuJian($genJieDian->zuoZhiZhen);
        }
        if ($genJieDian->youZhiZhen !== null && $genJieDian->youZhiZhen->jieDianZhi === null) {
            $genJieDian->youZhiZhen = null;
            $genJieDian->youBiaoShi = -1;
        } else {
            $this->qianXuBianLiXiuJian($genJieDian->youZhiZhen);
        }
    }

    /**
     * 中序遍历
     * @param XianSuoErChaShuJieDian $genJieDian
     * @return string
     */
    public function zhongXuBianLi($genJieDian)
    {
        if ($genJieDian === null) return '';
        if ($genJieDian->jieDianZhi === null) return '';
        $xuLie = '';
        if ($genJieDian->zuoBiaoShi === 1) $xuLie .= $this->zhongXuBianLi($genJieDian->zuoZhiZhen);
        $xuLie .= $genJieDian->jieDianZhi . ';';
        if ($genJieDian->youBiaoShi === 1) $xuLie .= $this->zhongXuBianLi($genJieDian->youZhiZhen);

        return $xuLie;
    }

    /**
     * 中序遍历线索化
     */
    public function zhongXuBianLiXianSuoHua()
    {
        $this->zhongXuBianLiXianSuoHuaDiGui($this->genJieDian);
        $this->qianQuJieDian = null;
    }

    /**
     * 中序遍历线索化
     * @param XianSuoErChaShuJieDian $genJieDian
     */
    protected function zhongXuBianLiXianSuoHuaDiGui($genJieDian)
    {
        if ($genJieDian === null) return;
        if ($genJieDian->jieDianZhi === null) return;
        if ($genJieDian->zuoBiaoShi === 1) {
            // 有左孩子
            $this->zhongXuBianLiXianSuoHuaDiGui($genJieDian->zuoZhiZhen);
        }
        if ($this->qianQuJieDian !== null && $genJieDian->zuoBiaoShi === -1) {
            // 设置前驱线索
            $genJieDian->zuoBiaoShi = 0;
            $genJieDian->zuoZhiZhen = $this->qianQuJieDianZhi;
        }
        if ($this->qianQuJieDian !== null && $this->qianQuJieDian->youBiaoShi === -1) {
            // 设置后继线索
            $this->qianQuJieDian->youBiaoShi = 0;
            $this->qianQuJieDian->youZhiZhen = $genJieDian->jieDianZhi;
        }
        // 登记自己为前驱
        $this->qianQuJieDian = $genJieDian;
        $this->qianQuJieDianZhi = $genJieDian->jieDianZhi;

        if ($genJieDian->youBiaoShi === 1) {
            // 有右孩子
            $this->zhongXuBianLiXianSuoHuaDiGui($genJieDian->youZhiZhen);
        }
    }
}

$numList = ['A', 'B', 'C', null, 'D', null, 'E', null, null, 'F', 'I', null, null, 'J', null];
$erChaShu = new XianSuoErChaShu($numList);
$erChaShu->buildTreeWithArray();
$erChaShu->qianXuBianLiXiuJian($erChaShu->getErChaShu());
$erChaShu->zhongXuBianLiXianSuoHua();
// print_r(var_dump($erChaShu->getErChaShu()), true);die;
echo json_encode($erChaShu->getErChaShu());
echo json_encode($erChaShu->zhongXuBianLi($erChaShu->getErChaShu()));
