<?php


interface Repository {

    public function findAll() : array;
    public function findByID(int $id) : object;
    public function save(object $obj) :bool;
    public function delete(int $id) :bool;
}