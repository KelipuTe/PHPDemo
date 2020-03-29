<?php

namespace App\Algorithm\Tree;


class Tree
{
    /**
     * @var array [上下级关系表]
     */
    protected $treeMap;

    /**
     * @var null [root 节点]
     */
    protected $rootNode;

    /**
     * Tree constructor.
     *
     * @param array $treeMap
     * @param null  $rootNode
     */
    public function __construct(array $treeMap = [], $rootNode = null)
    {
        $this->rootNode = $rootNode;
        if (count($treeMap) > 0) {
            $this->treeMap = $treeMap;
        } else {
            $this->treeMap = [
                'id_01' => ['name' => 'name_01', 'parent_id' => null, 'parent_name' => 'root'],
                'id_02' => ['name' => 'name_02', 'parent_id' => 'id_01', 'parent_name' => 'name_01'],
                'id_03' => ['name' => 'name_03', 'parent_id' => 'id_01', 'parent_name' => 'name_01'],
                'id_04' => ['name' => 'name_04', 'parent_id' => 'id_01', 'parent_name' => 'name_01'],
                'id_05' => ['name' => 'name_05', 'parent_id' => 'id_02', 'parent_name' => 'name_02'],
                'id_06' => ['name' => 'name_06', 'parent_id' => 'id_02', 'parent_name' => 'name_02'],
                'id_07' => ['name' => 'name_07', 'parent_id' => 'id_03', 'parent_name' => 'name_03'],
                'id_08' => ['name' => 'name_08', 'parent_id' => 'id_03', 'parent_name' => 'name_03'],
                'id_09' => ['name' => 'name_09', 'parent_id' => 'id_03', 'parent_name' => 'name_03'],
                'id_10' => ['name' => 'name_10', 'parent_id' => 'id_04', 'parent_name' => 'name_04'],
                'id_11' => ['name' => 'name_11', 'parent_id' => 'id_05', 'parent_name' => 'name_05'],
                'id_12' => ['name' => 'name_12', 'parent_id' => 'id_10', 'parent_name' => 'name_10'],
                'id_13' => ['name' => 'name_13', 'parent_id' => 'id_10', 'parent_name' => 'name_10'],
                'id_14' => ['name' => 'name_14', 'parent_id' => 'id_10', 'parent_name' => 'name_10'],
            ];
        }
    }

    /**
     * 使用数组引用还原树
     *
     * @return array
     */
    public function treeMapToTreeAddress()
    {
        $tree = [];
        // 临时保存节点，用于获取数组地址
        $address = [];
        foreach ($this->treeMap as $kChildId => $vChildData) {
            // 循环遍历上下级关系表
            if (!isset($address[$kChildId])) {
                $address[$kChildId] = [
                    'name'     => $vChildData['name'],
                    'children' => [],
                ];
            }
            $parentId = $vChildData['parent_id'];
            if ($parentId !== $this->rootNode) {
                // 如果上级节点不是 root 节点
                if (isset($address[$parentId])) {
                    // 如果已出现过上级节点，则直接把新的子节点加到上级节点下
                    $address[$parentId]['children'][$kChildId] = &$address[$kChildId];
                } else {
                    // 如果未出现过上级节点，则要先构造上级节点
                    $parentNode = [
                        'name'     => $vChildData['parent_name'],
                        'children' => [$kChildId => &$address[$kChildId]],
                    ];
                    $address[$parentId] = $parentNode;
                }
            } else {
                // 如果上级节点是 root 节点，则本节点为树的根节点
                $tree[$kChildId] = &$address[$kChildId];
            }
        }
        return $tree;
    }

    /**
     * 使用递归还原树
     *
     * @return array
     */
    public function treeMapToTreeRecursion()
    {
        return $this->buildTreeRecursion($this->treeMap, $this->rootNode);
    }

    /**
     * 使用递归还原树
     *
     * @param array $treeMap
     * @param null  $rootNode
     * @return array
     */
    protected function buildTreeRecursion(array $treeMap, $rootNode = null)
    {
        $tree = [];
        foreach ($treeMap as $kChild => $vChildData) {
            if ($vChildData['parent_id'] === $rootNode) {
                unset($treeMap[$kChild]);
                $tree[$kChild] = [
                    'name'     => $vChildData['name'],
                    'children' => $this->buildTreeRecursion($treeMap, $kChild)
                ];
            }
        }
        return count($tree) > 0 ? $tree : [];
    }

    /**
     * 使用递归输出树
     *
     * @param $tree
     * @return string
     */
    function printTree($tree)
    {
        $treeString = '';
        if (!is_null($tree) && count($tree) > 0) {
            $treeString .= '<ul>';
            foreach ($tree as $node) {
                $treeString .= '<li>' . $node['name'];
                $treeString .= $this->printTree($node['children']);
                $treeString .= '</li>';
            }
            $treeString .= '</ul>';
        }
        return $treeString;
    }
}
