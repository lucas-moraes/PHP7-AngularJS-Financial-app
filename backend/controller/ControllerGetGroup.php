<?php

require_once("../model/movimentGetGroup.php");

class GetGroupController
{

    private $lista;

    public function __construct()
    {
        $this->lista = new GetGroup();
    }

    public function getGroupCategories($month, $year)
    {
        return $this->lista->getGroupCategoriesByMonthAndYear($month, $year);
    }

    public function getCategoriesByYear($year)
    {
        return $this->lista->getGroupCategoriesByYear($year);
    }

    public function getGroutMonth($year)
    {
        return $this->lista->getGroupByMonth($year);
    }
}
