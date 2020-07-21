<?php

namespace App\ShuJuJieGou;


require_once 'Zhan.php';

/**
 * Class HouZhuiBiaoDaShi [后缀表达式]
 * @package App\ShuJuJieGou
 */
class HouZhuiBiaoDaShi
{
    /**
     * @var string [中缀表达式]
     */
    protected $zhongZhuiBiaoDaShi;

    /**
     * @var string [后缀表达式]
     */
    protected $houZhuiBiaoDaShi;

    /**
     * HouZhuiBiaoDaShi constructor.
     * @param $zhongZhuiBiaoDaShi [中缀表达式]
     */
    public function __construct($zhongZhuiBiaoDaShi)
    {
        $this->zhongZhuiBiaoDaShi = '';
        $this->houZhuiBiaoDaShi = '';
        if (is_string($zhongZhuiBiaoDaShi) && $zhongZhuiBiaoDaShi !== '') {
            $this->zhongZhuiBiaoDaShi = $zhongZhuiBiaoDaShi;
            $this->zhongZhuiZhuanHouZhui();
        }
    }

    /**
     * 获取后缀表达式
     * @return string
     */
    public function getHouZhuiBiaoDaShi()
    {
        return $this->houZhuiBiaoDaShi;
    }

    /**
     * 中缀表达式转后缀表达式
     */
    protected function zhongZhuiZhuanHouZhui()
    {
        $houZhuiBiaoDaShi = [];
        $caoZuoFuZhan = new Zhan();
        $shuZiString = '';
        $chuanChang = strlen($this->zhongZhuiBiaoDaShi);
        for ($i = 0; $i < $chuanChang; ++$i) {
            $itemChar = $this->zhongZhuiBiaoDaShi[$i];
            // 判断超过9的数字
            if (is_numeric($itemChar)) {
                $shuZiString .= $itemChar;

                continue;
            } else if ($shuZiString !== '') {
                $houZhuiBiaoDaShi[] = $shuZiString;
                $shuZiString = '';
            }
            // 分别判断各个操作符
            switch ($itemChar) {
                case '+':
                case '-':
                    // 如果加号和减号前面有其他操作符则需要输出
                    while (1) {
                        $caoZuoFu = $caoZuoFuZhan->getZhanDingYuanSu();
                        if ($caoZuoFu === '+' || $caoZuoFu === '-' || $caoZuoFu === '*' || $caoZuoFu === '/') {
                            $caoZuoFu = $caoZuoFuZhan->chuZhan();
                            $houZhuiBiaoDaShi[] = $caoZuoFu;
                        } else {
                            $caoZuoFuZhan->ruZhan($itemChar);
                            break 2;
                        }
                    }
                    break;
                case '*':
                case '/':
                    // 如果乘号和除号前面有乘号或除号则需要输出，加号或减号则不输出
                    while (1) {
                        $caoZuoFu = $caoZuoFuZhan->getZhanDingYuanSu();
                        if ($caoZuoFu === '*' && $caoZuoFu === '/') {
                            $caoZuoFu = $caoZuoFuZhan->chuZhan();
                            $houZhuiBiaoDaShi[] = $caoZuoFu;
                        } else {
                            $caoZuoFuZhan->ruZhan($itemChar);
                            break 2;
                        }
                    }
                    break;
                case'(':
                    $caoZuoFuZhan->ruZhan($itemChar);
                    break;
                case ')':
                    // 遇到右括号时，需要输出操作符，直到匹配到左括号
                    while (1) {
                        $caoZuoFu = $caoZuoFuZhan->chuZhan();
                        if ($caoZuoFu === '(') {
                            break;
                        }
                        $houZhuiBiaoDaShi[] = $caoZuoFu;
                    }
                    break;
            }
        }
        // 把最后一个数字输出
        $houZhuiBiaoDaShi[] = $shuZiString;
        // 把栈中操作符全部输出
        while (1) {
            $caoZuoFu = $caoZuoFuZhan->chuZhan();
            if ($caoZuoFu === null) {
                break;
            }
            $houZhuiBiaoDaShi[] = $caoZuoFu;
        }
        $this->houZhuiBiaoDaShi = implode(' ', $houZhuiBiaoDaShi);
    }

    /**
     * 使用后缀表达式计算结果
     * @return float
     */
    public function jiSuanHouZhui()
    {
        $shuZiZhan = new Zhan();
        $shuZiString = '';
        $chuanChang = strlen($this->houZhuiBiaoDaShi);
        for ($i = 0; $i < $chuanChang; ++$i) {
            $itemChar = $this->houZhuiBiaoDaShi[$i];
            if (is_numeric($itemChar)) {
                $shuZiString .= $itemChar;

                continue;
            } else if ($itemChar === ' ') {
                if ($shuZiString !== '') {
                    // 字符之间使用空格隔开，用于区分大于9的数字
                    $shuZiZhan->ruZhan(floatval($shuZiString));
                    $shuZiString = '';
                }

                continue;
            }
            switch ($itemChar) {
                case '+':
                    $num1 = $shuZiZhan->chuZhan();
                    $num2 = $shuZiZhan->chuZhan();
                    $num3 = $num2 + $num1;
                    $shuZiZhan->ruZhan($num3);
                    break;
                case '-':
                    $num1 = $shuZiZhan->chuZhan();
                    $num2 = $shuZiZhan->chuZhan();
                    $num3 = $num2 - $num1;
                    $shuZiZhan->ruZhan($num3);
                    break;
                case '*':
                    $num1 = $shuZiZhan->chuZhan();
                    $num2 = $shuZiZhan->chuZhan();
                    $num3 = $num2 * $num1;
                    $shuZiZhan->ruZhan($num3);
                    break;
                case '/':
                    $num1 = $shuZiZhan->chuZhan();
                    $num2 = $shuZiZhan->chuZhan();
                    $num3 = $num2 / $num1;
                    $shuZiZhan->ruZhan($num3);
                    break;
            }
        }

        return $shuZiZhan->chuZhan();
    }
}

/* 测试代码 */

// $zhongZhuiBiaoDaShi = '9+(3-1)*3+10/2';
// $houZhuiBiaoDaShi = new HouZhuiBiaoDaShi($zhongZhuiBiaoDaShi);
// $result = [
//     'zhongZhuiBiaoDaShi' => $zhongZhuiBiaoDaShi,
//     'houZhuiBiaoDaShi' => $houZhuiBiaoDaShi->getHouZhuiBiaoDaShi(),
//     'jieGuo' => $houZhuiBiaoDaShi->jiSuanHouZhui(),
// ];
// echo json_encode($result);



