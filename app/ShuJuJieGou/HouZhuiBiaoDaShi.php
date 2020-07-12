<?php
/* 后缀表达式 */

namespace App\ShuJuJieGou;

require_once 'Zhan.php';

/**
 * 中缀表达式转换后缀表达式
 * @param string $zhongZhuiBiaoDaShi
 * @return string
 */
function getRPN($zhongZhuiBiaoDaShi)
{
    $houZhuiBiaoDaShi = [];

    $operatorStack = new Zhan();

    $numStr = '';
    $strLen = strlen($zhongZhuiBiaoDaShi);
    for ($i = 0; $i < $strLen; ++$i) {
        $itemChar = $zhongZhuiBiaoDaShi[$i];
        // 判断超过9的数字
        if (is_numeric($itemChar)) {
            $numStr .= $itemChar;
            continue;
        } else if ($numStr !== '') {
            $houZhuiBiaoDaShi[] = $numStr;
            $numStr = '';
        }

        switch ($itemChar) {
            case '+':
            case '-':
                // 如果加号和减号前面有其他操作符则需要输出
                while (1) {
                    $operator = $operatorStack->getZhanDingYuanSu();
                    if ($operator === '+' || $operator === '-' || $operator === '*' || $operator === '/') {
                        $operator = $operatorStack->chuZhan();
                        $houZhuiBiaoDaShi[] = $operator;
                    } else {
                        $operatorStack->ruZhan($itemChar);
                        break 2;
                    }
                }
            case '*':
            case '/':
                // 如果乘号和除号前面有乘号或除号则需要输出，加号或减号则不输出
                while (1) {
                    $operator = $operatorStack->getZhanDingYuanSu();
                    if ($operator === '*' && $operator === '/') {
                        $operator = $operatorStack->chuZhan();
                        $houZhuiBiaoDaShi[] = $operator;
                    } else {
                        $operatorStack->ruZhan($itemChar);
                        break 2;
                    }
                }
                break;
            case'(':
                $operatorStack->ruZhan($itemChar);
                break;
            case ')':
                // 遇到右括号时，需要输出操作符，直到匹配到左括号
                while (1) {
                    $operator = $operatorStack->chuZhan();
                    if ($operator === '(') break;
                    $houZhuiBiaoDaShi[] = $operator;
                }
                break;
        }

    }
    // 把最后一个数字输出
    $houZhuiBiaoDaShi[] = $numStr;
    // 把栈中操作符全部输出
    while (1) {
        $operator = $operatorStack->chuZhan();
        if ($operator === null) break;
        $houZhuiBiaoDaShi[] = $operator;
    }

    return implode(' ', $houZhuiBiaoDaShi);
}

/**
 * 使用后缀表达式计算结果
 * @param $houZhuiBiaoDaShi
 * @return float
 */
function calculateRPN($houZhuiBiaoDaShi)
{
    $numStack = new Zhan();

    $numStr = '';
    $strLen = strlen($houZhuiBiaoDaShi);
    for ($i = 0; $i < $strLen; ++$i) {
        $itemChar = $houZhuiBiaoDaShi[$i];
        if (is_numeric($itemChar)) {
            $numStr .= $itemChar;
            continue;
        } else if ($itemChar === ' ') {
            if ($numStr !== '') {
                // 字符之间使用空格隔开，用于区分大于9的数字
                $numStack->ruZhan(floatval($numStr));
                $numStr = '';
            }
            continue;
        }
        switch ($itemChar) {
            case '+':
                $num1 = $numStack->chuZhan();
                $num2 = $numStack->chuZhan();
                $num3 = $num2 + $num1;
                $numStack->ruZhan($num3);
                break;
            case '-':
                $num1 = $numStack->chuZhan();
                $num2 = $numStack->chuZhan();
                $num3 = $num2 - $num1;
                $numStack->ruZhan($num3);
                break;
            case '*':
                $num1 = $numStack->chuZhan();
                $num2 = $numStack->chuZhan();
                $num3 = $num2 * $num1;
                $numStack->ruZhan($num3);
                break;
            case '/':
                $num1 = $numStack->chuZhan();
                $num2 = $numStack->chuZhan();
                $num3 = $num2 / $num1;
                $numStack->ruZhan($num3);
                break;
        }

    }
    return $numStack->chuZhan();
}

/* 测试代码 */

$zhongZhuiBiaoDaShi = '9+(3-1)*3+10/2';
$houZhuiBiaoDaShi = getRPN($zhongZhuiBiaoDaShi);
$jieGuo = calculateRPN($houZhuiBiaoDaShi);

echo json_encode([
    'houZhuiBiaoDaShi' => $houZhuiBiaoDaShi,
    'jieGuo' => $jieGuo,
]);



