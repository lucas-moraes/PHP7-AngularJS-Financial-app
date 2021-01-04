<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once("../controller/ControllerSetMoviment.php");

$insert = new EditMovController();

$insert->editar($_POST['id'], $_POST['date'], $_POST['type'], $_POST['category'], $_POST['description'], $_POST['value']);
