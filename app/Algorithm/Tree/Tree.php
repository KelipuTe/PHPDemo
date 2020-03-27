<?php

namespace App\Algorithm\Tree;


class Tree
{
    /**
     * 使用数组引用还原树
     *
     * @param array $treeMap
     * @param null  $rootNode
     * @return array
     */
    public function treeMapToTreeAddress(array $treeMap, $rootNode = null)
    {
        // 临时保存节点，用于获取数组地址
        $address = [];
        $tree = [];

        foreach ($treeMap as $kChildId => $vParentData) {
            if (!isset($address[$kChildId])) {
                $address[$kChildId] = [
                    'name'     => $kChildId,
                    'children' => [],
                ];
            }
            if ($vParentData['parent_id'] !== $rootNode) {
                if (isset($address[$vParentData['parent_id']])) {
                    $address[$vParentData['parent_id']]['children'][$kChildId] = &$address[$kChildId];
                } else {
                    $parentNode = [
                        'name'     => $vParentData['name'],
                        'children' => [$kChildId => &$address[$kChildId]],
                    ];
                    $address[$vParentData['parent_id']] = $parentNode;
                }
            } else {
                $tree[$kChildId] = &$address[$kChildId];
            }
        }

        return $tree;
    }

    /**
     * 使用递归还原树
     *
     * @param array $treeMap
     * @param null  $rootNode
     * @return array|null
     */
    public function treeMapToTreeRecursion(array $treeMap, $rootNode = null)
    {
        $tree = [];
        foreach ($treeMap as $kChild => $vParentNode) {
            if ($vParentNode['parent_id'] === $rootNode) {
                unset($treeMap[$kChild]);
                $tree[$kChild] = [
                    'name'     => $kChild,
                    'children' => $this->treeMapToTreeRecursion($treeMap, $kChild)
                ];
            }
        }

        return empty($tree) ? [] : $tree;
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
