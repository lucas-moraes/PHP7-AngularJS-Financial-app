<?php

require_once("../includes/init.php");


class GetMovById
{

    protected $mysqli;
    protected $moviment;

    public function __construct()
    {
        $this->conexao();
    }

    private function conexao()
    {
        $this->mysqli = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO);
    }

    public function getMovById($id)
    {
        $this->moviment = $this->mysqli->query("SELECT id, dia, mes, ano, tipo, categoria, descricao, SUM(IF(valor<0, valor*-1, valor)) as valor FROM lc_movimento WHERE id='$id'");

        while ($row = $this->moviment->fetch_assoc()) {
            $json = array('id' => $row['id'], 'dia' => $row['dia'], 'mes' => $row['mes'], 'ano' => $row['ano'], 'tipo' => $row['tipo'], 'categoria' => $row['categoria'], 'descricao' => $row['descricao'], 'valor' => $row['valor']);
        }

        return $json;
    }
}
