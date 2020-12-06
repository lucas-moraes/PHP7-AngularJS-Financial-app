<?php

require_once("../controller/ControllerGetMovimentById.php");

$item = new GetMovimentByIdController();

$arr = $item->movimentId($_POST['id']);

echo json_encode($arr);
