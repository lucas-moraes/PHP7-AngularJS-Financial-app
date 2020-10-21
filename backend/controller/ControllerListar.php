<?php
require_once("../model/banco.php");
class listarController
{

    private $lista;

    public function __construct()
    {
        $this->lista = new Banco();
        $this->criarTabela();
    }

    public function criarTabela()
    {
        return $this->lista->getLivro();
    }
}
