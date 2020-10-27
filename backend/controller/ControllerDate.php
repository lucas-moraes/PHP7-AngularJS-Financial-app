<?php
require_once("../model/banco.php");
class listarController
{

    private $date;

    public function __construct()
    {
        $this->date = new Banco();
        $this->criarTabela();
    }

    public function criarTabela()
    {
        return $this->date->getDate();
    }
}
