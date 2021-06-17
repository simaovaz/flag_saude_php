<?php

class Especialidade {

    const TABLE_NAME = "especialidades";
    const ID_FIELD = "especialidade_id";

    private $especialidade_id;
    private $designacao;

    public function __construct(array $attributes)
    {
        $this->especialidade_id = $attributes['especialidade_id'];
        $this->designacao = $attributes['designacao'];
    }

    public function getId()
    {
        return $this->especialidade_id;
    }

    public function getDesignacao()
    {
        return $this->designacao;
    }
}
