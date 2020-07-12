<?php
/* 栈 */

namespace App\ShuJuJieGou;

/**
 * Class Zhan [栈]
 * @package App\ShuJuJieGou
 */
class Zhan
{
    /**
     * @var array [栈的数据存储空间]
     */
    protected $zhanKongJian;

    /**
     * @var int [栈顶]
     */
    protected $zhanDing;

    /**
     * @var int [栈底]
     */
    protected $zhanDi;

    public function __construct()
    {
        $this->zhanKongJian = [];
        $this->zhanDing = -1;
        $this->zhanDi = 0;
    }

    /**
     * 获取栈顶元素，但不出栈
     * @return mixed
     */
    public function getZhanDingYuanSu()
    {
        if ($this->zhanDi < $this->zhanDing) return null;
        return $this->zhanKongJian[$this->zhanDing];
    }

    /**
     * 元素入栈
     * @param mixed
     */
    public function ruZhan($item)
    {
        ++$this->zhanDing;
        array_push($this->zhanKongJian, $item);
    }

    /**
     * 元素出栈
     * @return mixed
     */
    public function chuZhan()
    {
        if ($this->zhanDing < $this->zhanDi) return null;
        --$this->zhanDing;
        return array_pop($this->zhanKongJian);
    }
}