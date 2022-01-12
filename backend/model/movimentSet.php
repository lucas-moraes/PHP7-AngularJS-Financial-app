<?php

require_once("../includes/init.php");

class EditMoviment
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

    public function editMoviment($id, $date, $type, $category, $description, $value)
    {
        $valor = str_replace(',', '.', str_replace('.', '', $value));

        if ($type == 'saida') { $newValue = -$valor; } else { $newValue = $valor; }

        $t = explode("-", $date);
        $dia = $t[2];
        $mes = $t[1];
        $ano = $t[0];

        $stmt = $this->db->prepare('UPDATE lc_movimento SET dia = :dia, mes = :mes, ano = :ano, tipo = :tipo, categoria = :categoria, descricao = :descricao, valor = :valor WHERE rowid = :id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $stmt->bindValue(':dia', $dia, SQLITE3_INTEGER);
        $stmt->bindValue(':mes', $mes, SQLITE3_INTEGER);
        $stmt->bindValue(':ano', $ano, SQLITE3_INTEGER);
        $stmt->bindValue(':tipo', $type, SQLITE3_TEXT);
        $stmt->bindValue(':categoria', $category, SQLITE3_INTEGER);
        $stmt->bindValue(':descricao', $description, SQLITE3_TEXT);
        $stmt->bindValue(':valor', $newValue, SQLITE3_FLOAT);

        $stmt->execute();
    }
}
