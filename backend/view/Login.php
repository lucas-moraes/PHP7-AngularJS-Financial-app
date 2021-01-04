<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once("../controller/ControllerLogConsult.php");
require_once("./decrypt.php");

$item = new LogConsultController();

$pass = decrypt($_POST['pass']);

$arr = $item->consultItem($_POST['login'], $pass);

echo json_encode($arr);
