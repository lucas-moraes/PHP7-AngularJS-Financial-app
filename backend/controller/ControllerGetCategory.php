<?php
require_once("../model/categoryGet.php");
class listarController
{

    private $categoria;

    public function __construct()
    {
        $this->categoria = new GetCat();
        $this->criarTabela();
    }

    public function criarTabela()
    {
        return $this->categoria->getCat();
    }
}
