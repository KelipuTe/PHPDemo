<?php

namespace App\ShuJuJieGou;


require_once 'ErChaShuJieDian.php';

/**
 * Class ErChaShu [二叉树]
 * @package App\ShuJuJieGou
 */
class ErChaShu
{
    /**
     * @var array [二叉树元素数组]
     */
    protected $yuanSuList;

    /**
     * @var ErChaShuJieDian [根结点]
     */
    protected $genJieDian;

    /**
     * ErChaShu constructor.
     * @param $yuanSuList [二叉树元素数组]
     */
    public function __construct($yuanSuList = [])
    {
        $this->yuanSuList = [];
        $this->genJieDian = null;

        if (is_array($yuanSuList) && count($yuanSuList) > 0) $this->setYuanSuList($yuanSuList);
    }

    /**
     * 设置二叉树元素数组
     * @param $yuanSuList
     */
    public function setYuanSuList($yuanSuList)
    {
        if (!is_array($yuanSuList)) return;
        if (count($yuanSuList) < 1) return;
        $this->yuanSuList = $yuanSuList;
        $this->buildTreeWithArray();
        $this->qianXuBianLiXiuJian();
    }

    /**
     * 用数组构造二叉树
     */
    protected function buildTreeWithArray()
    {
        if (count($this->yuanSuList) === 0) return null;
        // 创建根结点
        $this->genJieDian = new ErChaShuJieDian($this->yuanSuList[0]);
        for ($i = 1, $numLen = count($this->yuanSuList); $i < $numLen; $i++) {
            // 依次添加结点
            $jieDian = new ErChaShuJieDian($this->yuanSuList[$i]);
            $this->chaRuJieDianByNLR($jieDian);
        }
    }

    /**
     * 以层次遍历的顺序插入结点
     * @param ErChaShuJieDian $jieDian
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

                return;
            } else {
                // 左结点先入队
                array_unshift($duiLie, $tempJieDian->zuoZhiZhen);
            }
            if ($tempJieDian->youZhiZhen === null) {
                // 如果右结点为空就插入结点
                $tempJieDian->youZhiZhen = $jieDian;

                return;
            } else {
                // 右结点后入队
                array_unshift($duiLie, $tempJieDian->youZhiZhen);
            }
        }
    }

    /**
     * 获取二叉树
     * @return ErChaShuJieDian
     */
    public function getErChaShu()
    {
        return $this->genJieDian;
    }

    /**
     * 使用前序遍历移除多余的空结点
     */
    protected function qianXuBianLiXiuJian()
    {
        $this->qianXuBianLiXiuJianDiGui($this->genJieDian);
    }

    /**
     * @param ErChaShuJieDian $genJieDian
     */
    protected function qianXuBianLiXiuJianDiGui($genJieDian)
    {
        if ($genJieDian === null) return;
        if ($genJieDian->jieDianZhi === null) return;
        if ($genJieDian->zuoZhiZhen !== null && $genJieDian->zuoZhiZhen->jieDianZhi === null)
            $genJieDian->zuoZhiZhen = null;
        else $this->qianXuBianLiXiuJianDiGui($genJieDian->zuoZhiZhen);
        if ($genJieDian->youZhiZhen !== null && $genJieDian->youZhiZhen->jieDianZhi === null)
            $genJieDian->youZhiZhen = null;
        else $this->qianXuBianLiXiuJianDiGui($genJieDian->youZhiZhen);
    }

    /**
     * 前序遍历
     */
    public function qianXuBianLi()
    {
        return $this->qianXuBianLiDiGui($this->genJieDian);
    }

    /**
     * @param ErChaShuJieDian $genJieDian
     * @return string
     */
    protected function qianXuBianLiDiGui($genJieDian)
    {
        if ($genJieDian === null) return '';
        if ($genJieDian->jieDianZhi === null) return '';
        $xuLie = '';
        $xuLie .= $genJieDian->jieDianZhi . ';';
        $xuLie .= $this->qianXuBianLiDiGui($genJieDian->zuoZhiZhen);
        $xuLie .= $this->qianXuBianLiDiGui($genJieDian->youZhiZhen);

        return $xuLie;
    }

    /**
     * 中序遍历
     * @return string
     */
    public function zhongXuBianLi()
    {
        return $this->zhongXuBianLiDiGui($this->genJieDian);
    }

    /**
     * @param ErChaShuJieDian $genJieDian
     * @return string
     */
    protected function zhongXuBianLiDiGui($genJieDian)
    {
        if ($genJieDian === null) return '';
        if ($genJieDian->jieDianZhi === null) return '';
        $xuLie = '';
        $xuLie .= $this->zhongXuBianLiDiGui($genJieDian->zuoZhiZhen);
        $xuLie .= $genJieDian->jieDianZhi . ';';
        $xuLie .= $this->zhongXuBianLiDiGui($genJieDian->youZhiZhen);

        return $xuLie;
    }

    /**
     * 后序遍历
     */
    public function houXuBianLi()
    {
        return $this->houXuBianLiDiGui($this->genJieDian);
    }

    /**
     * @param ErChaShuJieDian $genJieDian
     * @return string
     */
    protected function houXuBianLiDiGui($genJieDian)
    {
        if ($genJieDian === null) return '';
        if ($genJieDian->jieDianZhi === null) return '';
        $xuLie = '';
        $xuLie .= $this->houXuBianLiDiGui($genJieDian->zuoZhiZhen);
        $xuLie .= $this->houXuBianLiDiGui($genJieDian->youZhiZhen);
        $xuLie .= $genJieDian->jieDianZhi . ';';

        return $xuLie;
    }

    /**
     * 计算二叉树的最大深度
     * @return int
     */
    public function zuiDaShenDu()
    {
        return $this->zuiDaShenDuDiGui($this->genJieDian);
    }

    /**
     * @param ErChaShuJieDian $genJieDian
     * @return int
     */
    protected function zuiDaShenDuDiGui($genJieDian)
    {
        if ($genJieDian === null) return 0;
        if ($genJieDian->jieDianZhi === null) return 0;
        $zuoZhiZhen = $this->zuiDaShenDuDiGui($genJieDian->zuoZhiZhen);
        $youZhiZhen = $this->zuiDaShenDuDiGui($genJieDian->youZhiZhen);

        return max($zuoZhiZhen, $youZhiZhen) + 1;
    }

    /**
     * 广度优先遍历
     * @return array
     */
    public function guangDuYouXianBianLi()
    {
        $xuLie = [];
        $duiLie = [];
        // 根结点入队
        array_unshift($duiLie, $this->genJieDian);
        while (!empty($duiLie)) {
            // 持续输出结点，直到队列为空
            // 队列元素出队
            $tempJieDian = array_pop($duiLie);
            // 存放结点数据
            if ($tempJieDian->jieDianZhi !== null) $xuLie[] = $tempJieDian->jieDianZhi;
            // 左结点先入队，先遍历
            if ($tempJieDian->zuoZhiZhen !== null) array_unshift($duiLie, $tempJieDian->zuoZhiZhen);
            // 右结点后入队，后遍历
            if ($tempJieDian->youZhiZhen !== null) array_unshift($duiLie, $tempJieDian->youZhiZhen);
        }

        return $xuLie;
    }

    /**
     * 广度优先遍历，可分层输出结果
     * @return array
     */
    public function guangDuYouXianBianLiFenCeng()
    {
        $xuLie = [];
        $cengShu = 1;
        $duiLie = [];
        // 根结点入队
        array_unshift($duiLie, $this->genJieDian);
        while ($length = count($duiLie)) {
            // 持续输出结点，直到队列为空
            for ($i = 0; $i < $length; $i++) {
                // 队列元素出队
                $tempJieDian = array_pop($duiLie);
                if ($tempJieDian->jieDianZhi !== null) $xuLie[$cengShu][] = $tempJieDian->jieDianZhi;
                // 左结点先入队，先遍历
                if ($tempJieDian->zuoZhiZhen !== null) array_unshift($duiLie, $tempJieDian->zuoZhiZhen);
                // 右结点后入队，后遍历
                if ($tempJieDian->youZhiZhen !== null) array_unshift($duiLie, $tempJieDian->youZhiZhen);
            }
            // 一层遍历结束，层数+1
            $cengShu++;
        }

        return $xuLie;
    }

    /**
     * 深度优先遍历
     * @return array
     */
    public function shenDuYouXianBianLi()
    {
        $xuLie = [];
        $zhan = [];
        // 根结点入栈
        array_push($zhan, $this->genJieDian);
        while (!empty($zhan)) {
            // 持续输出结点，直到栈为空
            // 栈顶元素出栈
            $tempJieDian = array_pop($zhan);
            // 存放结点数据
            if ($tempJieDian->jieDianZhi !== null) $xuLie[] = $tempJieDian->jieDianZhi;
            // 右结点先入栈，后遍历
            if ($tempJieDian->youZhiZhen !== null) array_push($zhan, $tempJieDian->youZhiZhen);
            // 左结点后入栈，先遍历
            if ($tempJieDian->zuoZhiZhen !== null) array_push($zhan, $tempJieDian->zuoZhiZhen);
        }

        return $xuLie;
    }
}

/* 测试代码 */

$numList = ['A', 'B', 'C', null, 'D', null, 'E', null, null, 'F', 'I', null, null, 'J', null];
$erChaShu = new ErChaShu();
$erChaShu->setYuanSuList($numList);
echo json_encode($erChaShu->getErChaShu());
// echo json_encode($erChaShu->qianXuBianLi());
// echo json_encode($erChaShu->zhongXuBianLi());
// echo json_encode($erChaShu->houXuBianLi());
// echo json_encode($erChaShu->zuiDaShenDu());
// echo json_encode($erChaShu->guangDuYouXianBianLi());
// echo json_encode($erChaShu->guangDuYouXianBianLiFenCeng());
// echo json_encode($erChaShu->shenDuYouXianBianLi());
