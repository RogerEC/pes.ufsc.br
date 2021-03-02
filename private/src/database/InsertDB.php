<?php 
namespace Database;

use Database\Database;
Use PDO;

// classe que reúne os métodos para fazer inserts no banco de dados
class InsertDB 
{
    private $database;

    public function __construct()
    {
        $this->database = new Database;
    }
}
