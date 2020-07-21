<?php

namespace App\ShuJuJieGou;


/**
 * Trait XuNiNeiCunTrait [虚拟内存]
 * @package App\ShuJuJieGou
 */
trait XuNiNeiCunTrait
{
    /**
     * @var array [虚拟内存空间]
     * 用于模拟C语言中的指针
     */
    protected $xuNiNeiCunKongJian;

    /**
     * @var int [虚拟内存大小]
     * 用于记录分配内存的数量
     */
    protected $xuNiNeiCunDaXiao;

    /**
     * 虚拟内存初始化
     */
    protected function xuNiNeiCunChuShiHua()
    {
        $this->xuNiNeiCunKongJian = [];
        $this->xuNiNeiCunDaXiao = 0;
    }

    /**
     * 分配虚拟内存
     * 这个方法需要各个调用的类自行编码
     */
    protected function fenPeiXuNiNeiCun()
    {
    }

    /**
     * 获取虚拟内存数据
     * @param string $zhiZhen
     * @return mixed|null
     */
    protected function huoQuNeiCunShuJu($zhiZhen)
    {
        if (!is_string($zhiZhen) || strlen($zhiZhen) < 1) {
            return null;
        }
        if (isset($this->xuNiNeiCunKongJian[$zhiZhen])) {
            return $this->xuNiNeiCunKongJian[$zhiZhen];
        } else {
            return null;
        }
    }

    /**
     * 整理虚拟内存空间，移除不需要的元素
     * 这个方法需要各个调用的类自行编码
     */
    protected function zhenLiXuNiNeiCunKongJian()
    {
    }
}