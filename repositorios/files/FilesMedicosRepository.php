<?php

require_once "../flag_saude_php/repositorios/mysql/BaseRepository.php";

class FilesMedicosRepository extends MysqlBaseRepository{

    public function findAll() : array {
        echo "falta implementacao... mas devia implementar array de medicos";
        return [];
    }

    public function findByID(int $id): object
    {
        echo "falta implementacao...";
        return new object;
    }

    public function save($medico) : bool {
        return true;
    }

    public function delete($medico) : bool {
        return true;
    }


}


?>