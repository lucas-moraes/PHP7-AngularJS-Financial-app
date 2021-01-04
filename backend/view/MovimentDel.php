<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once("../controller/ControllerDelMoviment.php");

$delete = new delMovimentController();

$delete->deletar($_POST['id']);
