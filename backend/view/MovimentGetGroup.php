<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once("../controller/ControllerGetGroup.php");

$list = new GetGroupController();

$getGroupCategories = $list->getGroupCategories($_POST['month'], $_POST['year']);
$getGroupCategoriesByYear = $list->getCategoriesByYear($_POST['year']);
$getGroupMonth = $list->getGroutMonth($_POST['year']);

echo json_encode($getGroupCategories + $getGroupCategoriesByYear + $getGroupMonth);
