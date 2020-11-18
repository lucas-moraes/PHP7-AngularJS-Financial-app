<?php
require_once("../model/delMoviment.php");

class delMovimentController
{
    public $delete;

    public function __construct()
    {
        $this->delete = new DelMoviment();
    }

    public function deletar()
    {
        $this->delete->deleteMoviment();
    }
}
