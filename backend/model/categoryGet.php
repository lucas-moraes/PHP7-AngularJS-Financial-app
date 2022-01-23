<?php

require_once("../includes/init.php");


class GetCat
{

    protected $db;

    public function __construct()
    {
        $this->conexao();
    }

    private function conexao()
    {
        $this->db = new MyDB();
    }

    public function getCat()
    {
        $query = $this->db->query("SELECT * FROM categoria ORDER BY descricao");
        while ($row = $query->fetchArray()) {
            $categoria[] = array('id' => $row['idCategory'], 'descricao' => $row['descricao']);
        }
        $data['categoria'] = $categoria;

        return $data;
    }
}
