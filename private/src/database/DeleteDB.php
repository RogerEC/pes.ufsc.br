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

    public function deleteLink($linkId)
    {
        $connection = $this->database->connect();
        $query = $connection->prepare('DELETE FROM `LINKS` WHERE `idLinks` = :linkId');
        $query->bindValue(':linkId', $linkId, PDO::PARAM_INT);
        $query->execute();
        $result = $query->rowCount();
        $this->database->__destruct();
        return $result;
    }
}
