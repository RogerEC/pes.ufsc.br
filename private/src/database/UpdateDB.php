<?php 
namespace Database;

use Database\Database;
Use PDO;

// classe responsável por reunir os métodos para realizar updates no banco de dados
class UpdateDB 
{
    private $database;

    public function __construct()
    {
        $this->database = new Database;
    }

    // efetua o update do hash da senha armazenado no banco com base no id do usuário
    public function updatePasswordHash($userId, $newHash)
    {
        $connection = $this->database->connect();
        $query = $connection->prepare('UPDATE `USER` SET `passwordHash` = :newHash WHERE `idUser` = :userId LIMIT 1');
        $query->bindValue(':newHash', $newHash, PDO::PARAM_STR);
        $query->bindValue(':userId', $userId, PDO::PARAM_INT);
        $query->execute();
        $result = $query->rowCount();
        $this->database->__destruct();
        return $result;
    }
}
