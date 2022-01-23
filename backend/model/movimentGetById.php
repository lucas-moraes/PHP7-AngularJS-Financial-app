<?php

require_once("../includes/init.php");

class GetMovById
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

    public function getMovById($id)
    {
       $result = $this->db->query("SELECT rowid, * FROM lc_movimento WHERE rowid='$id'");
        
        while ($row = $result->fetchArray()) {
            if($row['valor'] < 0)
            {
                $valor = $row['valor'] * -1;
            } else {
                $valor = $row['valor'];
            }
            
            $json[] = array('id' => $row['rowid'], 'dia' => $row['dia'], 'mes' => $row['mes'], 'ano' => $row['ano'], 'tipo' => $row['tipo'], 'categoria' => $row['categoria'], 'descricao' => $row['descricao'], 'valor' => $valor);
        }

        return $json;
    }
}
