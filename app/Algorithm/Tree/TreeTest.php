<?php

namespace App\Algorithm\Tree;


require 'Tree.php';

$tree = (new Tree())->treeMapToTreeAddress();

echo json_encode($tree);
