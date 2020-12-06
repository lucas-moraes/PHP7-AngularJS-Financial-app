<?php

require_once("../controller/ControllerGetMoviment.php");

$list = new listarController();

$arr = $list->criarTabela();

echo json_encode($arr);
