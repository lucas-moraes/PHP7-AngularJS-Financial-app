<?php

require_once("../includes/init.php");


class GetDate
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

    public function getDate()
    {
        $query_ano = $this->mysqli->query("SELECT ano from lc_movimento GROUP BY ano");
        while ($row_ano = $query_ano->fetch_assoc()) {
            $ano[] = array('ano' => $row_ano['ano']);
        }
        $data['ano'] = $ano;

        $query_mes = $this->mysqli->query("SELECT mes from lc_movimento GROUP BY mes");
        while ($row_mes = $query_mes->fetch_assoc()) {
            $mes[] = array('mes' => $row_mes['mes']);
        }
        $data['mes'] = $mes;

        return $data;
    }
}
