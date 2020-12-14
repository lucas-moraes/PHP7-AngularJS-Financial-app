<?php

require_once("../includes/log.php");

class LogConsult
{

    protected $mysqli;
    protected $user;

    public function __construct()
    {
        $this->conexao();
    }
    private function conexao()
    {
        $this->mysqli = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO);
    }

    public function consult($login, $pass)
    {
        $this->user =  $this->mysqli->query("SELECT username, reg from members WHERE email = '" . $login . "' && password = '" . $pass . "' LIMIT 1");

        return mysqli_fetch_assoc($this->user);
    }
}
