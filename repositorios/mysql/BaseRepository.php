<?php

require_once '../flag_saude_php/repositorios/RepositoryInterface.php';
require_once '../flag_saude_php/models/Medico.php';

abstract class MysqlBaseRepository implements Repository{

    protected $model;

    public function __construct()
    {
        $this->connection = Database::db_connect();
    }


    public function findAll() : array
    {

        $connection = Database::db_connect();
        $statement = $connection -> prepare("SELECT * FROM " . $this->model::TABLE_NAME);
        $statement-> execute();
        $rows = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
        $results= [];

        foreach ($rows as $attributes) {
            $results[] = new $this->model($attributes);
        }
        return $results;
    }
/*
    public function findByID(int $id): object
    {
        
        $connection = Database::db_connect();
        $statement = $connection->prepare("Select * FROM " . $this->model::TABLE_NAME . " where ". $this->model::ID_FIELD ." = ? ;");
        $statement->bind_param('i', $id);
        $statement->execute();
        $attributes = $statement->get_result()->fetch_assoc();

        return new $this->model($attributes);
    }
*/
    public function findById(int $id) : object
    {
        $stmt = $this->connection->prepare("Select * FROM " . $this->model::TABLE_NAME . " where ". $this->model::ID_FIELD ." = ? ;");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $attributes = $stmt->get_result()->fetch_assoc();
        return new $this->model($attributes);
    }
    /*
    public function save($keys, $values, $id): bool{
        $b= "";
        $i=0;
        foreach ($values as $value){
            if($value===NULL){
                $b=$b;
            }
            else if($keys[$i][0]!=="i"){
                $b.= " '". $value ."',";
            }
            else{
                $b.= " ". $value .",";
            }
            $i++;
        }
        $b= substr($b,0,-1);

        $connection = Database::db_connect();
        if($this->model::TABLE_NAME!=="medicos"){
            $query = $connection-> prepare("INSERT INTO " . $this->model::TABLE_NAME . " VALUES (" . $b . "); " );
        }
        else{
            $query = $connection-> prepare("INSERT INTO " . $this->model::TABLE_NAME . " VALUES (". $id ."," . $b . "); " );
        }
        $query->execute();
        return true;
        /*
        if($query){
            $query->execute();
            return true;  
        }
        else{
            echo "Erro: falha na query ou na ligação à base de dados";
            return false;
        }
        */
        

}