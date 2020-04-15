<?php

namespace App\Algorithm\Tree;


require 'Tree.php';

$treeC = (new Tree());

$treeA = $treeC->treeMapToTreeAddress();
$idList = $treeC->ergodicTreeForId($treeA);

echo json_encode($treeA);
echo '<br/>';
echo json_encode($idList);
echo '<br/>';

$treeR = $treeC->treeMapToTreeRecursion();
$idList = $treeC->ergodicTreeForId($treeA);

echo json_encode($treeR);
echo '<br/>';
echo json_encode($idList);
echo '<br/>';
