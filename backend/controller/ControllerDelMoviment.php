<?php
require_once("../model/movimentDelete.php");

class delMovimentController
{
    public $delete;

    public function __construct()
    {
        $this->delete = new DelMoviment();
    }

    public function deletar($id)
    {
        $this->delete->deleteMoviment($id);
    }
}
