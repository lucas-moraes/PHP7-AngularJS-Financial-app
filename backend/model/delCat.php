<?php

require_once("../includes/init.php");

class DelCat
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

    public function deleteCat()
    {
        $id = $_POST['id'];
        $this->mysqli->query("DELETE FROM categoria WHERE id = '" . $id . "'");
    }
}
