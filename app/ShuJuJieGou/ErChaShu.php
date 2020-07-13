<?php
/* 二叉树 */

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
    public function __construct($yuanSuList)
    {
        $this->yuanSuList = $yuanSuList;
        $this->genJieDian = null;
    }

    /**
     * 用数组构造二叉树
     */
    public function buildTreeWithArray()
    {
        // 空数组返回 null
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
     * 以先序遍历的顺序插入结点（根左右）
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
            if ($tempJieDian->zuoZiShu === null) {
                // 如果左结点为空就插入结点
                $tempJieDian->zuoZiShu = $jieDian;

                return;
            } else {
                // 左结点先入队
                array_unshift($duiLie, $tempJieDian->zuoZiShu);
            }
            if ($tempJieDian->youZiShu === null) {
                // 如果右结点为空就插入结点
                $tempJieDian->youZiShu = $jieDian;

                return;
            } else {
                // 右结点后入队
                array_unshift($duiLie, $tempJieDian->youZiShu);
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
     * @param ErChaShuJieDian $genJieDian
     */
    public function qianXuBianLiXiuJian($genJieDian)
    {
        if ($genJieDian === null) return;
        if ($genJieDian->jieDianZhi === null) return;
        if ($genJieDian->zuoZiShu !== null && $genJieDian->zuoZiShu->jieDianZhi === null) {
            $genJieDian->zuoZiShu = null;
        } else {
            $this->qianXuBianLiXiuJian($genJieDian->zuoZiShu);
        }
        if ($genJieDian->youZiShu !== null && $genJieDian->youZiShu->jieDianZhi === null) {
            $genJieDian->youZiShu = null;
        } else {
            $this->qianXuBianLiXiuJian($genJieDian->youZiShu);
        }
    }

    /**
     * 前序遍历
     * @param ErChaShuJieDian $genJieDian
     * @return string
     */
    public function qianXuBianLi($genJieDian)
    {
        if ($genJieDian === null) return '';
        if ($genJieDian->jieDianZhi === null) return '';
        $xuLie = '';
        $xuLie .= $genJieDian->jieDianZhi . ';';
        $xuLie .= $this->qianXuBianLi($genJieDian->zuoZiShu);
        $xuLie .= $this->qianXuBianLi($genJieDian->youZiShu);

        return $xuLie;
    }

    /**
     * 中序遍历
     * @param ErChaShuJieDian $genJieDian
     * @return string
     */
    public function zhongXuBianLi($genJieDian)
    {
        if ($genJieDian === null) return '';
        if ($genJieDian->jieDianZhi === null) return '';
        $xuLie = '';
        $xuLie .= $this->zhongXuBianLi($genJieDian->zuoZiShu);
        $xuLie .= $genJieDian->jieDianZhi . ';';
        $xuLie .= $this->zhongXuBianLi($genJieDian->youZiShu);

        return $xuLie;
    }

    /**
     * 后序遍历
     * @param ErChaShuJieDian $genJieDian
     * @return string
     */
    public function houXuBianLi($genJieDian)
    {
        if ($genJieDian === null) return '';
        if ($genJieDian->jieDianZhi === null) return '';
        $xuLie = '';
        $xuLie .= $this->houXuBianLi($genJieDian->zuoZiShu);
        $xuLie .= $this->houXuBianLi($genJieDian->youZiShu);
        $xuLie .= $genJieDian->jieDianZhi . ';';

        return $xuLie;
    }

    /**
     * 计算二叉树的最大深度
     * @param ErChaShuJieDian $genJieDian
     * @return int
     */
    public function zuiDaShenDu($genJieDian)
    {
        if ($genJieDian === null) return 0;
        if ($genJieDian->jieDianZhi === null) return 0;
        $zuoZiShu = $this->zuiDaShenDu($genJieDian->zuoZiShu);
        $youZiShu = $this->zuiDaShenDu($genJieDian->youZiShu);

        return max($zuoZiShu, $youZiShu) + 1;
    }

    /**
     * 广度优先遍历
     * @param ErChaShuJieDian $genJieDian
     * @return array
     */
    public function guangDuYouXianBianLi($genJieDian)
    {
        $xuLie = [];

        $duiLie = [];
        // 根结点入队
        array_unshift($duiLie, $genJieDian);
        while (!empty($duiLie)) {
            // 持续输出结点，直到队列为空
            // 队列元素出队
            $tempJieDian = array_pop($duiLie);
            // 存放结点数据
            if ($tempJieDian->jieDianZhi !== null) $xuLie[] = $tempJieDian->jieDianZhi;
            // 左结点先入队，先遍历
            if ($tempJieDian->zuoZiShu !== null) array_unshift($duiLie, $tempJieDian->zuoZiShu);
            // 右结点后入队，后遍历
            if ($tempJieDian->youZiShu !== null) array_unshift($duiLie, $tempJieDian->youZiShu);
        }

        return $xuLie;
    }

    /**
     * 广度优先遍历，可分层输出结果
     * @param ErChaShuJieDian $genJieDian
     * @return array
     */
    public function guangDuYouXianBianLiFenCeng($genJieDian)
    {
        $xuLie = [];
        $cengShu = 1;

        $duiLie = [];
        // 根结点入队
        array_push($duiLie, $genJieDian);
        while ($length = count($duiLie)) {
            // 持续输出结点，直到队列为空
            for ($i = 0; $i < $length; $i++) {
                // 队列元素出队
                $tempJieDian = array_shift($duiLie);
                if ($tempJieDian->jieDianZhi !== null) $xuLie[$cengShu][] = $tempJieDian->jieDianZhi;
                // 左结点先入队，先遍历
                if ($tempJieDian->zuoZiShu !== null) array_push($duiLie, $tempJieDian->zuoZiShu);
                // 右结点后入队，后遍历
                if ($tempJieDian->youZiShu !== null) array_push($duiLie, $tempJieDian->youZiShu);
            }
            // 一层遍历结束，层数+1
            $cengShu++;
        }

        return $xuLie;
    }

    /**
     * 深度优先遍历
     * @param ErChaShuJieDian $genJieDian
     * @return array
     */
    public function shenDuYouXianBianLi($genJieDian)
    {
        $xuLie = [];

        $zhan = [];
        // 根结点入栈
        array_push($zhan, $genJieDian);
        while (!empty($zhan)) {
            // 持续输出结点，直到栈为空
            // 栈顶元素出栈
            $tempJieDian = array_pop($zhan);
            // 存放结点数据
            if ($tempJieDian->jieDianZhi !== null) $xuLie[] = $tempJieDian->jieDianZhi;
            // 右结点先入栈，后遍历
            if ($tempJieDian->youZiShu !== null) array_push($zhan, $tempJieDian->youZiShu);
            // 左结点后入栈，先遍历
            if ($tempJieDian->zuoZiShu !== null) array_push($zhan, $tempJieDian->zuoZiShu);
        }

        return $xuLie;
    }
}

/* 测试代码 */

$numList = ['A', 'B', 'C', null, 'D', null, 'E'];
$erChaShu = new ErChaShu($numList);
$erChaShu->buildTreeWithArray();
$erChaShu->qianXuBianLiXiuJian($erChaShu->getErChaShu());
echo json_encode($erChaShu->getErChaShu());
// echo json_encode($erChaShu->qianXuBianLi($erChaShu->getErChaShu()));
// echo json_encode($erChaShu->zhongXuBianLi($erChaShu->getErChaShu()));
// echo json_encode($erChaShu->houXuBianLi($erChaShu->getErChaShu()));
// echo json_encode($erChaShu->zuiDaShenDu($erChaShu->getErChaShu()));
// echo json_encode($erChaShu->guangDuYouXianBianLi($erChaShu->getErChaShu()));
// echo json_encode($erChaShu->guangDuYouXianBianLiFenCeng($erChaShu->getErChaShu()));
// echo json_encode($erChaShu->shenDuYouXianBianLi($erChaShu->getErChaShu()));
