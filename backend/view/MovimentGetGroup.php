<?php

require_once("../controller/ControllerGetGroup.php");

$list = new GetGroupController();

$getGroupCategories = $list->getGroupCategories($_POST['month'], $_POST['year']);
$getGroupCategoriesByYear = $list->getCategoriesByYear($_POST['year']);
$getGroupMonth = $list->getGroutMonth($_POST['year']);

echo json_encode($getGroupCategories);

echo json_encode($getGroupCategoriesByYear);

echo json_encode($getGroupMonth);
