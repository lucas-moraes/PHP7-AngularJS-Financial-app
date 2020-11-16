<?php
require_once("../model/regCat.php");

class regCatController
{
    public $description;

    public function __construct()
    {
        $this->description = new RegCat();
    }

    public function incluir()
    {
        $this->description->insertCat();
    }
}
