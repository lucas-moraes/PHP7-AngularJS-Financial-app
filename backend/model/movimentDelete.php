<?php

require_once("../includes/init.php");

class DelMoviment
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

    public function deleteMoviment($id)
    {
        $this->mysqli->query("DELETE FROM lc_movimento WHERE id = '" . $id . "'");
    }
}
