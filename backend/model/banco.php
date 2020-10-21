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
    public function getLivro()
    {
        $mes_hoje = date('m');
        $ano_hoje = date('Y');
        $num_rec_per_page = 9;

        if (isset($_GET["page"])) {
            $page  = $_GET["page"];
        } else {
            $page = 1;
        };

        $start_from = ($page - 1) * $num_rec_per_page;

        $result = $this->mysqli->query("SELECT * FROM lc_movimento WHERE mes='$mes_hoje' && ano='$ano_hoje' ORDER BY dia DESC LIMIT $start_from, $num_rec_per_page");

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
