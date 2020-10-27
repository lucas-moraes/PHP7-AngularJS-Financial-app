<?php

require_once("../controller/ControllerCategory.php");

$list = new listarController();

$arr = $list->criarTabela();

echo json_encode($arr);
