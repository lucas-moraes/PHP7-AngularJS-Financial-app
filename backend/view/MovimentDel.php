<?php
require_once("../controller/ControllerDelMoviment.php");

$delete = new delMovimentController();

$delete->deletar($_POST['id']);
