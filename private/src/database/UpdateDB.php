<?php 
namespace Database;

use Database\Database;
Use PDO;

class UpdateDB 
{
    private $database;

    public function __construct()
    {
        $this->database = new Database;
    }

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
