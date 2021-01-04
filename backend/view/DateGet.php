<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once("../controller/ControllerDate.php");

$list = new listarController();

$arr = $list->criarTabela();

echo json_encode($arr);
