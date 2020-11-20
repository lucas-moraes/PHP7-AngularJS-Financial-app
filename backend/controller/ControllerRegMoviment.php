<?php
require_once("../model/movimentRegister.php");

class regMovController
{
    public $moviment;

    public function __construct()
    {
        $this->moviment = new RegMoviment();
    }

    public function incluir($date, $type, $category, $description, $value)
    {
        $this->moviment->insertMoviment($date, $type, $category, $description, $value);
    }
}
