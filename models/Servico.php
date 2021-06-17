<?php

class Servico {

    const TABLE_NAME = "servicos";
    const ID_FIELD = "id_servico";

    private $id;
    private $designacao;
    private $diretor;
    private $enfermeiro_chefe;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['id_servico'];
        $this->designacao = $attributes['designacao'];
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getDesignacao()
    {
        return $this->designacao;
    }
}