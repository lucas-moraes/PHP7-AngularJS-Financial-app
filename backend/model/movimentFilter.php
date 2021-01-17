<?php

require_once("../includes/init.php");


class FilterMoviment
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

    public function filterMoviment($category, $month, $year)
    {
        if ($category != 0 && $month == 0 && $year == 0) {
            $this->moviment = $this->mysqli->query("SELECT * FROM lc_movimento WHERE categoria = '$category'");
            while ($row = $this->moviment->fetch_array(MYSQLI_ASSOC)) {
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
                $data['moviment'][] = array('id' => $row['id'], 'dia' => $row['dia'], 'mes' => $row['mes'], 'ano' => $row['ano'], 'tipo' => $row['tipo'], 'categoria' => $categoria, 'descricao' => $row['descricao'], 'valor' => $row['valor']);
            }

            $entrada = $this->mysqli->query("SELECT SUM(IF(valor > 0, valor, 0)) as entrada FROM lc_movimento WHERE categoria = '$category'");
            $saida = $this->mysqli->query("SELECT SUM(valor < 0, valor, 0)*-1) as saida FROM lc_movimento WHERE categoria = '$category'");
            $in = $entrada->fetch_array(MYSQLI_ASSOC);
            $out = $saida->fetch_array(MYSQLI_ASSOC);
            $resultado = ($in['entrada'] - $out['saida']);

            $data['total'] = $resultado;

            return $data;
        } else if ($category == 0 && $month != 0 && $year != 0) {
            $this->moviment = $this->mysqli->query("SELECT * FROM lc_movimento WHERE mes ='$month' AND ano='$year' ");
            while ($row = $this->moviment->fetch_array(MYSQLI_ASSOC)) {
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
                $data['moviment'][] = array('id' => $row['id'], 'dia' => $row['dia'], 'mes' => $row['mes'], 'ano' => $row['ano'], 'tipo' => $row['tipo'], 'categoria' => $categoria, 'descricao' => $row['descricao'], 'valor' => $row['valor']);
            }

            $entrada = $this->mysqli->query("SELECT SUM(if(valor > 0, valor, 0)) as entrada FROM lc_movimento WHERE mes ='$month' AND ano='$year' ");
            $saida = $this->mysqli->query("SELECT SUM(if(valor < 0, valor, 0)*-1) as saida FROM lc_movimento WHERE mes ='$month' AND ano='$year' ");
            $in = $entrada->fetch_array(MYSQLI_ASSOC);
            $out = $saida->fetch_array(MYSQLI_ASSOC);
            $resultado = ($in['entrada'] - $out['saida']);

            $data['total'] = $resultado;

            return $data;
        } else if ($category == 0 && $month != 0 && $year == 0) {
            $this->moviment = $this->mysqli->query("SELECT * FROM lc_movimento WHERE categoria='$category' AND ano='$year'");
            while ($row = $this->moviment->fetch_array(MYSQLI_ASSOC)) {
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
                $data['moviment'][] = array('id' => $row['id'], 'dia' => $row['dia'], 'mes' => $row['mes'], 'ano' => $row['ano'], 'tipo' => $row['tipo'], 'categoria' => $categoria, 'descricao' => $row['descricao'], 'valor' => $row['valor']);
            }

            $entrada = $this->mysqli->query("SELECT SUM(IF(valor > 0, valor, 0)) as entrada FROM lc_movimento WHERE categoria='$category' AND ano='$year' ");
            $saida = $this->mysqli->query("SELECT SUM(valor < 0, valor, 0)*-1) as saida FROM lc_movimento WHERE categoria='$category' AND ano='$year' ");
            $in = $entrada->fetch_array(MYSQLI_ASSOC);
            $out = $saida->fetch_array(MYSQLI_ASSOC);
            $resultado = ($in['entrada'] - $out['saida']);

            $data['total'] = $resultado;

            return $data;
        } else if ($category == 0 && $month == 0 && $year != 0) {
            $this->moviment = $this->mysqli->query("SELECT * FROM lc_movimento WHERE ano='$year' ");
            while ($row = $this->moviment->fetch_array(MYSQLI_ASSOC)) {
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
                $data['moviment'][] = array('id' => $row['id'], 'dia' => $row['dia'], 'mes' => $row['mes'], 'ano' => $row['ano'], 'tipo' => $row['tipo'], 'categoria' => $categoria, 'descricao' => $row['descricao'], 'valor' => $row['valor']);
            }

            $entrada = $this->mysqli->query("SELECT SUM(IF(valor > 0, valor, 0)) as entrada FROM lc_movimento WHERE ano='$year' ");
            $saida = $this->mysqli->query("SELECT SUM(IF(valor < 0, valor, 0)*-1) as saida FROM lc_movimento WHERE ano='$year' ");
            $in = $entrada->fetch_array(MYSQLI_ASSOC);
            $out = $saida->fetch_array(MYSQLI_ASSOC);
            $resultado = ($in['entrada'] - $out['saida']);

            $data['total'] = $resultado;

            return $data;
        } else if ($category != 0 && $month == 0 && $year == 0) {
            $this->moviment = $this->mysqli->query("SELECT * FROM lc_movimento WHERE mes='$month' AND ano='$year' ");
            while ($row = $this->moviment->fetch_array(MYSQLI_ASSOC)) {
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
                $data['moviment'][] = array('id' => $row['id'], 'dia' => $row['dia'], 'mes' => $row['mes'], 'ano' => $row['ano'], 'tipo' => $row['tipo'], 'categoria' => $categoria, 'descricao' => $row['descricao'], 'valor' => $row['valor']);
            }

            $entrada = $this->mysqli->query("SELECT SUM(IF(valor > 0, valor, 0)) as entrada FROM lc_movimento WHERE mes='$month' AND ano='$year' ");
            $saida = $this->mysqli->query("SELECT SUM(IF(valor < 0, valor, 0)*-1) as saida FROM lc_movimento WHERE mes='$month' AND ano='$year' ");
            $in = $entrada->fetch_array(MYSQLI_ASSOC);
            $out = $saida->fetch_array(MYSQLI_ASSOC);
            $resultado = ($in['entrada'] - $out['saida']);

            $data['total'] = $resultado;

            return $data;
        } else if ($category != 0 && $month != 0 && $year == 0) {
            $this->moviment = $this->mysqli->query("SELECT * FROM lc_movimento WHERE categoria='$category' AND mes='$month'");
            while ($row = $this->moviment->fetch_array(MYSQLI_ASSOC)) {
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
                $data['moviment'][] = array('id' => $row['id'], 'dia' => $row['dia'], 'mes' => $row['mes'], 'ano' => $row['ano'], 'tipo' => $row['tipo'], 'categoria' => $categoria, 'descricao' => $row['descricao'], 'valor' => $row['valor']);
            }

            $entrada = $this->mysqli->query("SELECT SUM(IF(valor > 0, valor, 0)) as entrada FROM lc_movimento WHERE categoria='$category' AND mes='$month'");
            $saida = $this->mysqli->query("SELECT SUM(IF(valor < 0, valor, 0)*-1) as saida FROM lc_movimento WHERE categoria='$category' AND mes='$month'");
            $in = $entrada->fetch_array(MYSQLI_ASSOC);
            $out = $saida->fetch_array(MYSQLI_ASSOC);
            $resultado = ($in['entrada'] - $out['saida']);

            $data['total'] = $resultado;

            return $data;
        }
    }
}
