<?php

require_once("../includes/init.php");

class DelMoviment
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

    public function deleteMoviment($id)
    {
        $this->db->query("DELETE FROM lc_movimento WHERE rowid = '" . $id . "'");
    }
}
