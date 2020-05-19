<?php

namespace App\ShuJuJieGou\Shu\Tree;


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
     * Shu constructor.
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
                'id_1'  => ['self_id' => 'id_1', 'self_name' => 'name_1', 'parent_id' => null, 'parent_name' => 'root'],
                'id_2'  => ['self_id' => 'id_2', 'self_name' => 'name_2', 'parent_id' => 'id_1', 'parent_name' => 'name_1'],
                'id_3'  => ['self_id' => 'id_3', 'self_name' => 'name_3', 'parent_id' => 'id_1', 'parent_name' => 'name_1'],
                'id_4'  => ['self_id' => 'id_4', 'self_name' => 'name_4', 'parent_id' => 'id_1', 'parent_name' => 'name_1'],
                'id_5'  => ['self_id' => 'id_5', 'self_name' => 'name_5', 'parent_id' => 'id_2', 'parent_name' => 'name_2'],
                'id_6'  => ['self_id' => 'id_6', 'self_name' => 'name_6', 'parent_id' => 'id_2', 'parent_name' => 'name_2'],
                'id_7'  => ['self_id' => 'id_7', 'self_name' => 'name_7', 'parent_id' => 'id_3', 'parent_name' => 'name_3'],
                'id_8'  => ['self_id' => 'id_8', 'self_name' => 'name_8', 'parent_id' => 'id_3', 'parent_name' => 'name_3'],
                'id_9'  => ['self_id' => 'id_9', 'self_name' => 'name_9', 'parent_id' => 'id_3', 'parent_name' => 'name_3'],
                'id_10' => ['self_id' => 'id_10', 'self_name' => 'name_10', 'parent_id' => 'id_4', 'parent_name' => 'name_4'],
                'id_11' => ['self_id' => 'id_11', 'self_name' => 'name_11', 'parent_id' => 'id_5', 'parent_name' => 'name_5'],
                'id_12' => ['self_id' => 'id_12', 'self_name' => 'name_12', 'parent_id' => 'id_10', 'parent_name' => 'name_10'],
                'id_13' => ['self_id' => 'id_13', 'self_name' => 'name_13', 'parent_id' => 'id_10', 'parent_name' => 'name_10'],
                'id_14' => ['self_id' => 'id_14', 'self_name' => 'name_14', 'parent_id' => 'id_10', 'parent_name' => 'name_10'],
            ];
        }
    }

    /**
     * 使用数组引用还原树
     *
     * @param string $childTree [子家族节点名]
     * @return array [家族树或子家族树]
     */
    public function treeMapToTreeAddress($childTree = '')
    {
        $tree = [];
        // 临时保存节点，用于获取数组地址
        $address = [];
        foreach ($this->treeMap as $kChildId => $vChildData) {
            // 循环遍历上下级关系表
            if (!isset($address[$kChildId])) {
                $address[$kChildId] = [
                    'self_id'   => $vChildData['self_id'],
                    'self_name' => $vChildData['self_name'],
                    'children'  => [],
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
                        'self_id'   => $vChildData['parent_id'],
                        'self_name' => $vChildData['parent_name'],
                        'children'  => [$kChildId => &$address[$kChildId]],
                    ];
                    $address[$parentId] = $parentNode;
                }
            } else {
                // 如果上级节点是 root 节点，则本节点为树的根节点
                $tree[$kChildId] = &$address[$kChildId];
            }
        }

        if (!empty($childTree) && !empty($address[$childTree])) {
            return [$childTree => $address[$childTree]];
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
                    'self_id'   => $vChildData['self_id'],
                    'self_name' => $vChildData['self_name'],
                    'children'  => $this->buildTreeRecursion($treeMap, $kChild)
                ];
            }
        }

        return count($tree) > 0 ? $tree : [];
    }

    /**
     * 遍历树获取 id
     *
     * @param $tree
     * @return string
     */
    public function ergodicTreeForId(array $tree)
    {
        $idList = [];
        if (!is_null($tree) && count($tree) > 0) {
            $chileIdList = [];
            foreach ($tree as $node) {
                $idList[] = $node['self_id'];
                $chileIdList = $this->ergodicTreeForId($node['children']);
            }
            $idList = array_merge($idList, $chileIdList);
        }

        return $idList;
    }
}
