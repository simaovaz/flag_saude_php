<?php

require_once 'Database.php';
require_once '../flag_saude_php/models/Servico.php';
require_once '../flag_saude_php/repositorios/mysql/BaseRepository.php';

class ServicosRepository extends MysqlBaseRepository
{

    public function __construct()
    {
        parent::__construct();
        $this->model = Servico::class;
    }

    public function save(object $model) : bool
    {
        echo "falta implementacao... mas devia retornar um boleano";
        return false;
    }

    public function delete(int $id) : bool
    {
        echo "falta implementacao... mas devia retornar um boleano";
        return false;
    }
}