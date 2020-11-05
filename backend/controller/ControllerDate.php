<?php
require_once("../model/getDate.php");
class listarController
{

    private $date;

    public function __construct()
    {
        $this->date = new GetDate();
        $this->criarTabela();
    }

    public function criarTabela()
    {
        return $this->date->getDate();
    }
}
