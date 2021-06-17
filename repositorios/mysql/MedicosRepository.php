<?php
require_once '../flag_saude_php/repositorios/mysql/BaseRepository.php';
require_once 'Database.php';
require_once '../flag_saude_php/models/Medico.php';
require_once '../flag_saude_php/models/Especialidade.php';
require_once '../flag_saude_php/models/Servico.php';


class MedicosRepository extends MysqlBaseRepository
{

    public function __construct()
    {
        parent::__construct();
        $this->model = Medico::class;
    }

    public function findAll(): array
    {
        $stmt = $this->connection->prepare("Select medicos.*, especialidades.designacao as e_designacao, servicos.designacao as s_designacao FROM " . Medico::TABLE_NAME .
        " LEFT JOIN " . Especialidade::TABLE_NAME . " ON medicos.id_especialidade = especialidades." . Especialidade::ID_FIELD .
        " LEFT JOIN " . Servico::TABLE_NAME . " ON medicos.id_servico = servicos." . Servico::ID_FIELD);
        $stmt->execute();
        $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        $results = [];
        foreach ($rows as $attributes) {
            $attributes["especialidade"] = new Especialidade([
                "especialidade_id" => $attributes["id_especialidade"], 
                "designacao" => $attributes["e_designacao"]
            ]);
            $attributes["servico"] = new Servico([
                "id_servico" => $attributes["id_servico"],
                "designacao" => $attributes["s_designacao"]
            ]);
            array_push($results, new Medico($attributes));
        }

        return $results;
    }

    public function findById(int $id) : object
    {
        $stmt = $this->connection->prepare("Select medicos.*, especialidades.designacao as e_designacao, servicos.designacao as s_designacao FROM " . Medico::TABLE_NAME .
        " LEFT JOIN " . Especialidade::TABLE_NAME . " ON medicos.id_especialidade = especialidades." . Especialidade::ID_FIELD .
        " LEFT JOIN " . Servico::TABLE_NAME . " ON medicos.id_servico = servicos." . Servico::ID_FIELD . 
        " WHERE ". $this->model::ID_FIELD ." = ? ;");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $attributes = $stmt->get_result()->fetch_assoc();
        $attributes["especialidade"] = new Especialidade([
            "especialidade_id" => $attributes["id_especialidade"], 
            "designacao" => $attributes["e_designacao"]
        ]);
        $attributes["servico"] = new Servico([
            "id_servico" => $attributes["id_servico"],
            "designacao" => $attributes["s_designacao"]
        ]);
        return new $this->model($attributes);
    }

    public function save(object $medico): bool
    {
        if (!($medico instanceof Medico)) {
            return false;
        }

        return $medico->getId() > 0 ? $this->update($medico) : $this->insert($medico); 
    }

    private function insert(Medico $medico): bool
    {
        $array = $medico->toArray();
        $stmt = $this->connection->prepare("INSERT INTO " . Medico::TABLE_NAME . "(nome, morada, telefone, id_especialidade, id_servico, foto) values(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssiis', $array["nome"], $array["morada"], $array["telefone"], $array["especialidade_id"], $array["servico_id"], $array["foto"]);      
        return $stmt->execute();
    }

    private function update(Medico $medico): bool
    {
        $array = $medico->toArray();
        $stmt = $this->connection->prepare("UPDATE ". Medico::TABLE_NAME ." set nome = ?, morada = ?, telefone = ?, id_especialidade = ?, id_servico = ?, foto = ?  WHERE ". Medico::ID_FIELD ." = ?" );
        $stmt->bind_param('sssiisi', $array["nome"], $array["morada"], $array["telefone"], $array["especialidade_id"], $array["servico_id"], $array["foto"], $array['id_medico']);
        return $stmt->execute();
    }

    public function delete(int $id) : bool
    {
        $stmt = $this->connection->prepare("DELETE FROM ". Medico::TABLE_NAME ." WHERE ". Medico::ID_FIELD ." = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
