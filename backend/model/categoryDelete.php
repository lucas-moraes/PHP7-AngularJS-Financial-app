<?php

require_once("../includes/init.php");

class DelCat
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

    public function deleteCat($id)
    {
        $this->db->query("DELETE FROM categoria WHERE idCategory = '" . $id . "'");
    }
}
