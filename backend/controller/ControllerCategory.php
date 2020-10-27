<?php
require_once("../model/banco.php");
class listarController
{

    private $categoria;

    public function __construct()
    {
        $this->categoria = new Banco();
        $this->criarTabela();
    }

    public function criarTabela()
    {
        return $this->categoria->getCat();
    }
}
