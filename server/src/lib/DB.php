<?php

namespace Moi\App\Lib;

use mysqli;

# For mysqli exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

class DB
{
    private string $hostname;
    private string $dbName;
    private string $username;
    private string $password;

    public function __construct()
    {
        $this->hostname = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->dbName   = 'product_test';
    }

    public function connect(): mysqli
    {
        try {
            $mysqli = new mysqli(
                $this->hostname,
                $this->username,
                $this->password,
                $this->dbName
            );

            return $mysqli;
        } catch (\Throwable $error) {
            print_r($error);
        }
    }
};
