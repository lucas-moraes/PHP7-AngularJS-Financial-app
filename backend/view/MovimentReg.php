<?php

require_once("../controller/ControllerRegMoviment.php");

$insert = new regMovController();

$insert->incluir($_POST['date'], $_POST['type'], $_POST['category'], $_POST['description'], $_POST['value']);
