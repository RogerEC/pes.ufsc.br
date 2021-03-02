<?php 
namespace Database;

use Database\Database;
Use PDO;

// classe que reúne os métodos para realizar delete de dados do banco de dados
class DeleteDB 
{
    private $database;

    public function __construct()
    {
        $this->database = new Database;
    }
}
