<?php

require_once("../includes/init.php");

class RegCat
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

    public function insertCat($description)
    {
        $stmt = $this->db->prepare("INSERT INTO categoria (descricao) values (:descricao)");
        $stmt->bindValue(':descricao', $description, SQLITE3_TEXT);

        $stmt->execute();
    }
}
