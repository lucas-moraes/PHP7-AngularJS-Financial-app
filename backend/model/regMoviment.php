<?php
require_once("../includes/init.php");

class RegMoviment
{
    protected $mysqli;
    protected $diamesano;
    protected $tipo;
    protected $categoria;
    protected $descricao;
    protected $valor;
    protected $value;
    protected $dia;
    protected $mes;
    protected $ano;

    public function __construct()
    {
        $this->conexao();
    }

    private function conexao()
    {
        $this->mysqli = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO);
    }

    public function insertMoviment()
    {

        echo json_decode($_POST['date']);
        echo json_decode($_POST['type']);
        echo json_decode($_POST['category']);
        echo json_decode($_POST['description']);
        echo json_decode($_POST['valor']);

        $this->diamesano = $_POST['date'];
        $this->tipo = $_POST['type'];
        $this->categoria = $_POST['category'];
        $this->descricao = $_POST['description'];
        $this->valor = str_replace(',', '.', str_replace('.', '', $_POST['valor']));
        if ($this->tipo == 'saida') {
            $this->value = -$this->valor;
        } else {
            $this->value = $this->valor;
        }

        $t = explode("-", $this->diamesano);
        $this->dia = $t[2];
        $this->mes = $t[1];
        $this->ano = $t[0];

        $this->mysqli->query("
            INSERT INTO lc_movimento (dia,mes,ano,tipo,categoria,descricao,valor) 
            values ('$this->dia','$this->mes','$this->ano','$this->tipo','$this->categoria','$this->descricao','$this->value')
            ");
    }
}
