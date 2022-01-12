<?php

require_once("../includes/init.php");

class FilterMoviment
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

    public function filterMoviment($category, $month, $year)
    {
        if ($category != 0 && $month == 0 && $year == 0) {
            $result = $this->db->query("SELECT rowid, * FROM lc_movimento WHERE categoria = '$category'");
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

            $entrada = $this->db->query("SELECT SUM(valor) as entrada FROM lc_movimento WHERE categoria = '$category'");
            $saida = $this->db->query("SELECT SUM(valor*-1) as saida FROM lc_movimento WHERE categoria = '$category'");
            $in = $entrada->fetchArray();
            $out = $saida->fetchArray();
            $resultado = ($in['entrada'] - $out['saida']);

            $data['total'] = $resultado;

            return $data;
        } else if ($category == 0 && $month != 0 && $year != 0) {
            $result = $this->db->query("SELECT rowid, * FROM lc_movimento WHERE mes ='$month' AND ano='$year' ");
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

            $entrada = $this->db->query("SELECT SUM(valor) as entrada FROM lc_movimento WHERE mes ='$month' AND ano='$year' ");
            $saida = $this->db->query("SELECT SUM(valor*-1) as saida FROM lc_movimento WHERE mes ='$month' AND ano='$year' ");
            $in = $entrada->fetchArray();
            $out = $saida->fetchArray();
            $resultado = ($in['entrada'] - $out['saida']);

            $data['total'] = $resultado;

            return $data;
        } else if ($category == 0 && $month != 0 && $year == 0) {
            $result = $this->db->query("SELECT rowid, * FROM lc_movimento WHERE categoria='$category' AND ano='$year'");
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

            $entrada = $this->db->query("SELECT SUM(valor) as entrada FROM lc_movimento WHERE categoria='$category' AND ano='$year' ");
            $saida = $this->db->query("SELECT SUM(valor*-1) as saida FROM lc_movimento WHERE categoria='$category' AND ano='$year' ");
            $in = $entrada->fetchArray();
            $out = $saida->fetchArray();
            $resultado = ($in['entrada'] - $out['saida']);

            $data['total'] = $resultado;

            return $data;
        } else if ($category == 0 && $month == 0 && $year != 0) {
            $result = $this->db->query("SELECT rowid, * FROM lc_movimento WHERE ano='$year' ");
            while ($row = $result->fetchArray()) {
                $cat = $row['categoria'];
                $res = $this->db->query("SELECT descricao FROM categoria WHERE idCategory='$cat'");
                $row2 = $res->fetchArray();;
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

            $entrada = $this->db->query("SELECT SUM(valor) as entrada FROM lc_movimento WHERE ano='$year' ");
            $saida = $this->db->query("SELECT SUM(valor*-1) as saida FROM lc_movimento WHERE ano='$year' ");
            $in = $entrada->fetchArray();
            $out = $saida->fetchArray();
            $resultado = ($in['entrada'] - $out['saida']);

            $data['total'] = $resultado;

            return $data;
        } else if ($category != 0 && $month == 0 && $year == 0) {
            $result = $this->db->query("SELECT rowid, * FROM lc_movimento WHERE mes='$month' AND ano='$year' ");
            while ($row = $result->fetchArray()) {
                $cat = $row['categoria'];
                $res = $this->db->query("SELECT descricao FROM categoria WHERE idCategory='$cat'");
                $row2 = $res->fetchArray();;
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

            $entrada = $this->db->query("SELECT SUM(valor) as entrada FROM lc_movimento WHERE mes='$month' AND ano='$year' ");
            $saida = $this->db->query("SELECT SUM(valor*-1) as saida FROM lc_movimento WHERE mes='$month' AND ano='$year' ");
            $in = $entrada->fetchArray();
            $out = $saida->fetchArray();
            $resultado = ($in['entrada'] - $out['saida']);

            $data['total'] = $resultado;

            return $data;
        } else if ($category != 0 && $month != 0 && $year == 0) {
            $result = $this->db->query("SELECT rowid, * FROM lc_movimento WHERE categoria='$category' AND mes='$month'");
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

            $entrada = $this->db->query("SELECT SUM(valor) as entrada FROM lc_movimento WHERE categoria='$category' AND mes='$month'");
            $saida = $this->db->query("SELECT SUM(valor*-1) as saida FROM lc_movimento WHERE categoria='$category' AND mes='$month'");
            $in = $entrada->fetchArray();
            $out = $saida->fetchArray();
            $resultado = ($in['entrada'] - $out['saida']);

            $data['total'] = $resultado;

            return $data;
        }
    }
}
