<?php
require_once("../model/movimentGetById.php");

class GetMovimentByIdController
{
    private $moviment;

    public function __construct()
    {
        $this->moviment = new GetMovById();
    }

    public function movimentId($id)
    {
        return $this->moviment->getMovById($id);
    }
}
