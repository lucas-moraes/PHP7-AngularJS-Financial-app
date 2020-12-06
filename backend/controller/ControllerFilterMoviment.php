<?php
require_once("../model/movimentFilter.php");
class FilterController
{

    private $list;

    public function __construct()
    {
        $this->list = new FilterMoviment();
    }

    public function filtrarTabela($category, $month, $year)
    {
        return $this->list->filterMoviment($category, $month, $year);
    }
}
