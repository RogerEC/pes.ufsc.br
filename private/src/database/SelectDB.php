<?php 
namespace Database;

use Database\Database;
use PDO;

class SelectDB
{
    private $database;

    public function __construct()
    {
        $this->database = new Database;
    }

    public function getActiveLinks()
    {
        $querySql = "SELECT `name`, `url` FROM `LINKS` WHERE `status` = true AND (`permanentLink` = true OR (`permanentLink` = false AND `expirationDatetime` > NOW()))";
        $result = $this->database->selectDatabase($querySql);
        return $result;
    }

    public function getUserLoginData($user)
    {
        $connection = $this->database->connect();
        $query = $connection->prepare('SELECT `idUser`, `passwordHash`, `type`, `status` FROM `USER` WHERE `username` = :user LIMIT 1');
        $query->bindValue(':user', $user, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        $this->database->__destruct();
        return $result;
    }
}
