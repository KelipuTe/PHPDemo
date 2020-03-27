<?php

namespace App\Algorithm\Tree;


require 'Tree.php';

$treeMap = array(
    'id_53'  => array('parent_id' => 'id_1', 'name' => 'name_1',),
    'id_56'  => array('parent_id' => 'id_53', 'name' => 'name_53',),
    'id_74'  => array('parent_id' => 'id_56', 'name' => 'name_56',),
    'id_86'  => array('parent_id' => 'id_53', 'name' => 'name_53',),
    'id_90'  => array('parent_id' => 'id_56', 'name' => 'name_56',),
    'id_93'  => array('parent_id' => 'id_86', 'name' => 'name_86',),
    'id_104' => array('parent_id' => 'id_53', 'name' => 'name_53',),
    'id_122' => array('parent_id' => 'id_53', 'name' => 'name_53',),
    'id_141' => array('parent_id' => 'id_93', 'name' => 'name_93',),
    'id_151' => array('parent_id' => 'id_56', 'name' => 'name_56',),
    'id_161' => array('parent_id' => 'id_90', 'name' => 'name_90',),
    'id_164' => array('parent_id' => 'id_161', 'name' => 'name_161',),
    'id_188' => array('parent_id' => 'id_90', 'name' => 'name_90',),
    'id_189' => array('parent_id' => 'id_161', 'name' => 'name_161',),
    'id_197' => array('parent_id' => 'id_104', 'name' => 'name_104',),
    'id_215' => array('parent_id' => 'id_161', 'name' => 'name_161',),
    'id_238' => array('parent_id' => 'id_56', 'name' => 'name_56',),
    'id_249' => array('parent_id' => 'id_93', 'name' => 'name_93',),
    'id_272' => array('parent_id' => 'id_93', 'name' => 'name_93',),
    'id_282' => array('parent_id' => 'id_93', 'name' => 'name_93',),
    'id_291' => array('parent_id' => 'id_122', 'name' => 'name_122',),
    'id_300' => array('parent_id' => 'id_249', 'name' => 'name_249',),
    'id_1'   => array('parent_id' => null, 'name' => 'root',),
);

$tree = (new Tree())->treeMapToTreeAddress($treeMap);

echo json_encode($tree);