<?php
require_once '../flag_saude_php/repositorios/mysql/BaseRepository.php';
require_once 'Database.php';
require_once '../flag_saude_php/models/Especialidade.php';

class EspecialidadesRepository extends MysqlBaseRepository
{

    public function __construct()
    {
        parent::__construct();
        $this-> model = Especialidade::class;
    }


    public function save(object $especialidade) :bool{

        if(!($especialidade instanceof Especialidade)){
            return false;
        }


        return $especialidade->getID() > 0 ? $this->update($especialidade) : $this->insert($especialidade);
    }

    public function update($especialidade) : bool {
        echo "update";
        $array = $especialidade-> toArray();
        $statement= $this-> connection -> prepare( "UPDATE " .$this->model::TABLE_NAME . " SET especialidade_id= ?, designacao= ? WHERE " .  $this->model::ID_FIELD . "=?");
        $statement->bind_param("isi", $array['especialidade_id'], $array['designacao'], $array['especialidade_id']);
        return $statement->execute();
    }

    public function insert($especialidade) : bool {
        echo "boas";
        $array = $especialidade-> toArray();
        $statement= $this-> connection -> prepare( "INSERT INTO " .$this->model::TABLE_NAME . "(designacao) VALUES (?)");
        $statement->bind_param("s", $array['designacao']);
        return $statement->execute();
    }

    public function delete($id) : bool{
        $statement= $this->connection-> prepare("DELETE FROM ". $this->model::TABLE_NAME ." WHERE ". $this->model::ID_FIELD ." = ?");
        $statement->bind_param('i', $id);
        return $statement->execute();
    }
} 

?>