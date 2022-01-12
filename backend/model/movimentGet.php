<?php

require_once("../includes/init.php");

class GetMov
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

    public function getMov()
    {
        $mes_hoje = date('m');
        $ano_hoje = date('Y');

        $result = $this->db->query("SELECT rowid, * FROM lc_movimento WHERE mes='$mes_hoje' AND ano='$ano_hoje' ORDER BY dia DESC");

        while ($row = $result->fetchArray()) {
            
            $cat = $row['categoria'];
            $res = $this->db->query("SELECT descricao FROM categoria WHERE idCategory='$cat'");
            $row2 = $res->fetchArray();
            $categoria = $row2['descricao'];

            if ($categoria === NULL) {
                switch ($cat) {
                    case '777':
                        $categoria = "Poupança";
                        break;
                }
            }
            $data['moviment'][] = array('id' => $row['rowid'], 'dia' => $row['dia'], 'mes' => $row['mes'], 'ano' => $row['ano'], 'tipo' => $row['tipo'], 'categoria' => $categoria, 'descricao' => $row['descricao'], 'valor' => $row['valor']);
        }

        $entrada = $this->db->query("SELECT SUM(valor) AS entrada FROM lc_movimento WHERE tipo='entrada' AND mes='$mes_hoje' AND ano='$ano_hoje'");
        $saida = $this->db->query("SELECT SUM(valor*-1) AS saida FROM lc_movimento WHERE tipo='saida' AND mes='$mes_hoje' AND ano='$ano_hoje'");
        $in = $entrada->fetchArray();
        $out = $saida->fetchArray();
        $resultado = ($in['entrada'] - $out['saida']);

        $data['total'] = $resultado;

        return $data;
    }
}