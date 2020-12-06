<?php

require_once("../includes/init.php");


class GetGroup
{

    protected $mysqli;
    protected $json_one;
    protected $json_two;
    protected $json_three;


    public function __construct()
    {
        $this->conexao();
    }

    private function conexao()
    {
        $this->mysqli = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO);
    }

    public function getGroupCategoriesByMonthAndYear($mes, $ano)
    {
        $month = date('m');
        $year = date('Y');

        if (!empty($mes)) {
            $this->month = $mes;
        }
        if (!empty($ano)) {
            $this->year = $ano;
        }

        $this->json_one = $this->mysqli->query("SELECT * FROM lc_movimento WHERE mes='$month' && ano='$year' GROUP BY categoria ORDER BY (valor >=0) desc");

        $data_one['mes'] = $month;
        $data_one['ano'] = $year;

        while ($row = $this->json_one->fetch_array(MYSQLI_ASSOC)) {
            $cat = $row['categoria'];
            $res = $this->mysqli->query("SELECT nome FROM categoria WHERE id='$cat'");
            $row2 = mysqli_fetch_array($res);
            $categoria = $row2['nome'];

            if ($categoria === NULL) {
                switch ($cat) {
                    case '777':
                        $categoria = "Poupança";
                        break;
                }
            }
            $data_one['resume'][] = array('categoria' => $categoria, 'valor' => $row['valor']);
        }

        $entrada = $this->mysqli->query("SELECT SUM(valor) as entrada FROM lc_movimento WHERE tipo='entrada' && mes='$month' && ano='$year'");
        $saida = $this->mysqli->query("SELECT SUM(valor*-1) as saida FROM lc_movimento WHERE tipo='saida' && mes='$month' && ano='$year'");
        $in = $entrada->fetch_array(MYSQLI_ASSOC);
        $out = $saida->fetch_array(MYSQLI_ASSOC);
        $resultado = ($in['entrada'] - $out['saida']);

        $data_one['total'] = $resultado;

        return $data_one;
    }

    public function getGroupCategoriesByYear($ano)
    {
        $year = date('Y');

        if (!empty($ano)) {
            $year = $ano;
        }

        $this->json_two = $this->mysqli->query("SELECT categoria, sum(valor) as valor FROM lc_movimento WHERE ano='$year' GROUP BY categoria ORDER BY (valor >=0) desc");

        while ($row = $this->json_two->fetch_array(MYSQLI_ASSOC)) {
            $cat = $row['categoria'];
            $res = $this->mysqli->query("SELECT nome FROM categoria WHERE id='$cat'");
            $row2 = mysqli_fetch_array($res);
            $categoria = $row2['nome'];

            if ($categoria === NULL) {
                switch ($cat) {
                    case '777':
                        $categoria = "Poupança";
                        break;
                }
            }
            $data_two['categoriesByYear'][] = array('categoria' => $categoria, 'valor' => $row['valor']);
        }

        $entrada = $this->mysqli->query("SELECT SUM(valor) as entrada FROM lc_movimento WHERE tipo='entrada'");
        $saida = $this->mysqli->query("SELECT SUM(valor*-1) as saida FROM lc_movimento WHERE tipo='saida'");
        $in = $entrada->fetch_array(MYSQLI_ASSOC);
        $out = $saida->fetch_array(MYSQLI_ASSOC);
        $resultado = ($in['entrada'] - $out['saida']);

        $data_two['total'] = $resultado;

        return $data_two;
    }

    public function getGroupByMonth($ano)
    {
        $year = date('Y');

        if (!empty($ano)) {
            $year = $ano;
        }

        $this->json_three = $this->mysqli->query("SELECT mes, ano, sum(valor) as valor FROM lc_movimento WHERE ano='$year' GROUP BY mes");

        while ($row = $this->json_three->fetch_array(MYSQLI_ASSOC)) {
            $data_three['groupMonth'][] = array('mes' => $row['mes'], 'ano' => $row['ano'], 'valor' => $row['valor']);
        }

        return $data_three;
    }
}
