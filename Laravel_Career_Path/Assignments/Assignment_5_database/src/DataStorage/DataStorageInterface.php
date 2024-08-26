<?php

namespace App\DataStorage;

interface DataStorageInterface
{
    public function getAll($table);
    public function select($table, $conditions);
    public function insert($table, $data);
}
