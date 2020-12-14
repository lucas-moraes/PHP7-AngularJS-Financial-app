<?php
require_once("../model/log.php");

class LogConsultController
{
    public $item;

    public function __construct()
    {
        $this->item = new LogConsult();
    }

    public function consultItem($login, $pass)
    {
        return $this->item->consult($login, $pass);
    }
}
