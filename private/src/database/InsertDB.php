<?php 
namespace Database;

use Database\Database;
Use PDO;

class InsertDB 
{
    private $database;

    public function __construct()
    {
        $this->database = new Database;
    }
}
