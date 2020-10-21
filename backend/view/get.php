<?php

require_once("../controller/ControllerListar.php");

$list = new listarController();

$arr = $list->criarTabela();

echo json_encode($arr);
