<?php

namespace Moi\App\Lib;

use Moi\App\Lib\DB;
use mysqli_result;

class Model
{
    private DB $database;

    public function __construct()
    {
        $this->database = new DB();
    }

    public function query(string $query): mysqli_result|bool
    {
        return $this->database->connect()->query($query);
    }

    public function getData(mysqli_result $queryResult): array|false|null
    {
        return $queryResult->fetch_all(MYSQLI_ASSOC);
    }
};
