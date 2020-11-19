<?php
require_once("../model/movimentRegister.php");

class regMovController
{
    public $moviment;

    public function __construct()
    {
        $this->moviment = new RegMoviment();
    }

    public function incluir()
    {
        $this->moviment->insertMoviment();
    }
}
