<?php

require_once("../includes/init.php");

class RegMoviment
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

    public function insertMoviment($date, $type, $category, $description, $value)
    {
        $valor = str_replace(',', '.', str_replace('.', '', $value));

        if ($type == 'saida') { $newValue = -$valor; } else { $newValue = $valor; }

        $t = explode("-", $date);
        $dia = $t[2];
        $mes = $t[1];
        $ano = $t[0];

        $this->db->exec("INSERT INTO lc_movimento(dia,mes,ano,tipo,categoria,descricao,valor) VALUES ('$dia', '$mes', '$ano', '$type', '$category', '$description', '$newValue')");
    }

    public function getLastId(){
        return $this->db->lastInsertRowID();
    }
}
