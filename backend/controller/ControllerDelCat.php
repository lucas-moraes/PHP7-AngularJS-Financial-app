<?php
require_once("../model/categoryDelete.php");

class delCatController
{
    public $delete;

    public function __construct()
    {
        $this->delete = new DelCat();
    }

    public function deletar()
    {
        $this->delete->deleteCat();
    }
}
