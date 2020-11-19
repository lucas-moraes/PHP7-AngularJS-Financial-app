<?php
require_once("../model/getMov.php");
class listarController
{

    private $lista;

    public function __construct()
    {
        $this->lista = new GetMov();
        $this->criarTabela();
    }

    public function criarTabela()
    {
        return $this->lista->getMov();
    }
}
