<?php

namespace App\Algorithm\Tree;


class Tree
{
    /**
     * 使用数组引用还原树
     *
     * @param $treeMap
     * @return array
     */
    public function treeMapToTreeAddress($treeMap)
    {
        // 临时保存节点，用于获取数组地址
        $address = [];
        $tree = [];

        foreach ($treeMap as $childId => $parentData) {
            if (!isset($address[$childId])) {
                $address[$childId] = [
                    'name'     => $parentData['name'],
                    'children' => []
                ];
            }
            if (!empty($parentData['parent_id'])) {
                if (!isset($address[$parentData['parent_id']])) {
                    $parentNode = [
                        'name'     => $parentData['name'],
                        'children' => [&$address[$childId]],
                    ];
                    $address[$parentData['parent_id']] = $parentNode;
                } else {
                    $address[$parentData['parent_id']]['children'][] = &$address[$childId];
                }
            } else {
                $tree[$childId] = &$address[$childId];
            }
        }

        return $tree;
    }

    /**
     * 使用递归还原树
     *
     * @param      $tree
     * @param null $root
     * @return array|null
     */
    public function treeMapToTreeRecursion($tree, $root = null)
    {
        $return = [];
        foreach ($tree as $child => $parent) {
            if ($parent == $root) {
                unset($tree[$child]);
                $return[] = array(
                    'name'     => $child,
                    'children' => $this->treeMapToTreeRecursion($tree, $child)
                );
            }
        }

        return empty($return) ? null : $return;
    }

    /**
     * 使用递归输出树
     *
     * @param $tree
     * @return string
     */
    function printTree($tree)
    {
        $print = '';
        if (!is_null($tree) && count($tree) > 0) {
            $print .= '<ul>';
            foreach ($tree as $node) {
                $print .= '<li>' . $node['name'];
                $print .= $this->printTree($node['children']);
                $print .= '</li>';
            }
            $print .= '</ul>';
        }
        return $print;
    }
}
