<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once("../controller/ControllerGetMovimentById.php");

$item = new GetMovimentByIdController();

$arr = $item->movimentId($_POST['id']);

echo json_encode($arr);
