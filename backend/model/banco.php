<?php

require_once("../includes/init.php");
class Banco
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

    public function setLivro($nome, $autor, $quantidade, $preco, $data)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO livros (`nome`, `autor`, `quantidade`, `preco`, `data`) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss", $nome, $autor, $quantidade, $preco, $data);
        if ($stmt->execute() == TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function getMov()
    {
        $mes_hoje = date('m');
        $ano_hoje = date('Y');

        $result = $this->mysqli->query("SELECT * FROM lc_movimento WHERE mes='$mes_hoje' && ano='$ano_hoje' ORDER BY dia DESC");

        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
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
            $data['movimentacao'][] = array('id' => $row['id'], 'dia' => $row['dia'], 'mes' => $row['mes'], 'ano' => $row['ano'], 'tipo' => $row['tipo'], 'categoria' => $categoria, 'descricao' => $row['descricao'], 'valor' => $row['valor']);
        }

        $entrada = $this->mysqli->query("SELECT SUM(valor) as entrada FROM lc_movimento WHERE tipo='entrada' && mes='$mes_hoje' && ano='$ano_hoje'");
        $saida = $this->mysqli->query("SELECT SUM(valor*-1) as saida FROM lc_movimento WHERE tipo='saida' && mes='$mes_hoje' && ano='$ano_hoje'");
        $in = $entrada->fetch_array(MYSQLI_ASSOC);
        $out = $saida->fetch_array(MYSQLI_ASSOC);
        $resultado = ($in['entrada'] - $out['saida']);

        $data['total'] = $resultado;

        return $data;
    }
    public function getCat()
    {
        $query = $this->mysqli->query("SELECT * FROM categoria ORDER BY nome");
        while ($row = $query->fetch_assoc()) {
            $categoria[] = array('id' => $row['id'], 'nome' => $row['nome']);
        }
        $data['categoria'] = $categoria;

        return $data;
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
    public function deleteLivro($id)
    {
        if ($this->mysqli->query("DELETE FROM `livros` WHERE `nome` = '" . $id . "';") == TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function pesquisaLivro($id)
    {
        $result = $this->mysqli->query("SELECT * FROM livros WHERE nome='$id'");
        return $result->fetch_array(MYSQLI_ASSOC);
    }
    public function updateLivro($nome, $autor, $quantidade, $preco, $flag, $data, $id)
    {
        $stmt = $this->mysqli->prepare("UPDATE `livros` SET `nome` = ?, `autor`=?, `quantidade`=?, `preco`=?, `flag`=?,`data` = ? WHERE `nome` = ?");
        $stmt->bind_param("sssssss", $nome, $autor, $quantidade, $preco, $flag, $data, $id);
        if ($stmt->execute() == TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
