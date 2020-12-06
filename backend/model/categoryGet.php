<?php

require_once("../includes/init.php");


class GetCat
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

    public function getCat()
    {
        $query = $this->mysqli->query("SELECT * FROM categoria ORDER BY nome");
        while ($row = $query->fetch_assoc()) {
            $categoria[] = array('id' => $row['id'], 'nome' => $row['nome']);
        }
        $data['categoria'] = $categoria;

        return $data;
    }
}
