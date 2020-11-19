<?php

require_once("../includes/init.php");

class RegCat
{
    protected $mysqli;

    public function __construct()
    {
        $this->conexao();
    }

    private function conexao()
    {
        $this->mysqli = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO);
    }

    public function insertCat($string)
    {
        $this->mysqli->query("INSERT INTO categoria (nome) values ('$string')");
    }
}
