<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once("../controller/ControllerDelCat.php");

$delete = new delCatController();

$delete->deletar($_POST['id']);
