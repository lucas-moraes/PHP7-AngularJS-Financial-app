<?php

require_once("../includes/init.php");


class GetDate
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

    public function getDate()
    {
        $query_ano = $this->db->query("SELECT ano from lc_movimento GROUP BY ano");
        while ($row_ano = $query_ano->fetchArray()) {
            $ano[] = array('ano' => $row_ano['ano']);
        }
        $data['ano'] = $ano;

        $query_mes = $this->db->query("SELECT mes from lc_movimento GROUP BY mes");
        while ($row_mes = $query_mes->fetchArray()) {
            $mes[] = array('mes' => $row_mes['mes']);
        }
        $data['mes'] = $mes;

        return $data;
    }
}
