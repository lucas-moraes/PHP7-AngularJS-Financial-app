<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once("../controller/ControllerFilterMoviment.php");

$item = new FilterController();

$arr = $item->filtrarTabela($_POST['category'], $_POST['month'], $_POST['year']);

echo json_encode($arr);
