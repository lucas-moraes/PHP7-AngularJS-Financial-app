<?php
require_once("../model/movimentSet.php");

class EditMovController
{
    public $moviment;

    public function __construct()
    {
        $this->moviment = new EditMoviment();
    }

    public function editar($id, $date, $type, $category, $description, $value)
    {
        $this->moviment->editMoviment($id, $date, $type, $category, $description, $value);
    }
}
