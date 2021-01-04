<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once("../controller/ControllerRegCat.php");

$insert = new regCatController();

$insert->incluir($_POST['description']);
