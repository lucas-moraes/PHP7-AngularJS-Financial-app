<?php
require_once("../controller/ControllerDelCat.php");

$delete = new delCatController();

$delete->deletar($_POST['id']);
