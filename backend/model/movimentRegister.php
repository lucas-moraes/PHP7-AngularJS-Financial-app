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

        $stmt = $this->db->prepare('INSERT INTO lc_movimento(dia,mes,ano,tipo,categoria,descricao,valor) VALUES (:dia, :mes, :ano, :tipo, :categoria, :descricao, :valor)');
        $stmt->bindValue(':dia', $dia, SQLITE3_INTEGER);
        $stmt->bindValue(':mes', $mes, SQLITE3_INTEGER);
        $stmt->bindValue(':ano', $ano, SQLITE3_INTEGER);
        $stmt->bindValue(':tipo', $type, SQLITE3_TEXT);
        $stmt->bindValue(':categoria', $category, SQLITE3_INTEGER);
        $stmt->bindValue(':descricao', $description, SQLITE3_TEXT);
        $stmt->bindValue(':valor', $newValue, SQLITE3_FLOAT);

        $stmt->execute();

        return $stmt->lastInsideRowID();
    }
}
