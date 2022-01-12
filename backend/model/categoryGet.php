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
        $query = $this->db->query("SELECT rowid, * FROM categoria ORDER BY descricao");
        while ($row = $query->fetch_assoc()) {
            $categoria[] = array('id' => $row['rowid'], 'descricao' => $row['descricao']);
        }
        $data['categoria'] = $categoria;

        return $data;
    }
}
