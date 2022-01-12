<?php

class MyDB extends SQLite3 {
    function __construct() {
       $this->open('../../db/banco_de_dados.db');
    }
 }
?>