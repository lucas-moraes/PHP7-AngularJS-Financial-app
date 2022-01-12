<?php

require_once("../includes/init.php");


class GetGroup
{

    protected $db;
    protected $json_three;


    public function __construct()
    {
        $this->conexao();
    }

    private function conexao()
    {
        $this->db = new MyDB();
    }

    public function getGroupCategoriesByMonthAndYear($month, $year)
    {

        $data_one['mes'] = $month;
        $data_one['ano'] = $year;

        $result = $this->db->query("SELECT mes, ano, categoria, SUM(valor) AS valor FROM lc_movimento WHERE mes='$month' AND ano='$year' GROUP BY categoria");

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
            $data_one['resume'][] = array('categoria' => $categoria, 'valor' => $row['valor']);
        }

        $entrada = $this->db->query("SELECT SUM(valor) as entrada FROM lc_movimento WHERE tipo='entrada' AND mes='$month' AND ano='$year'");
        $saida = $this->db->query("SELECT SUM(valor*-1) as saida FROM lc_movimento WHERE tipo='saida' AND mes='$month' AND ano='$year'");
        $in = $entrada->fetchArray();
        $out = $saida->fetchArray();
        $resultado = ($in['entrada'] - $out['saida']);

        $data_one['totalResume'] = $resultado;

        return $data_one;
    }

    public function getGroupCategoriesByYear($ano)
    {
        $year = date('Y');

        if (!empty($ano)) {
            $year = $ano;
        }

        $result = $this->db->query("SELECT categoria, sum(valor) as valor FROM lc_movimento WHERE ano='$year' GROUP BY categoria ORDER BY valor desc");

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
            $data_two['categoriesByYear'][] = array('categoria' => $categoria, 'valor' => $row['valor']);
        }

        $entrada = $this->db->query("SELECT SUM(valor) AS entrada FROM lc_movimento WHERE tipo='entrada'");
        $saida = $this->db->query("SELECT SUM(valor*-1) AS saida FROM lc_movimento WHERE tipo='saida'");
        $in = $entrada->fetchArray();
        $out = $saida->fetchArray();
        $resultado = ($in['entrada'] - $out['saida']);

        $data_two['totalCategoriesByYear'] = $resultado;

        return $data_two;
    }

    public function getGroupByMonth($ano)
    {
        $year = date('Y');

        if (!empty($ano)) {
            $year = $ano;
        }

        $result = $this->db->query("SELECT mes, ano, SUM(valor) AS valor FROM lc_movimento WHERE ano='$year' GROUP BY mes");

        while ($row = $result->fetchArray()) {
            $data_three['groupMonth'][] = array('mes' => $row['mes'], 'ano' => $row['ano'], 'valor' => $row['valor']);
        }

        return $data_three;
    }

}
