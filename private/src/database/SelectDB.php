<?php 
namespace Database;

use Database\Database;
use PDO;

// classe responsável por fazer os selects e retornar os resultados das consultas
class SelectDB
{
    private $database;

    public function __construct()
    {
        $this->database = new Database;
    }

    // retorna a lista de links ativos e não expirados para página de links
    public function getActiveLinks()
    {
        $querySql = "SELECT `name`, `url` FROM `LINKS` WHERE `status` = true AND (`permanentLink` = true OR (`permanentLink` = false AND `expirationDatetime` > NOW()))";
        $result = $this->database->selectDatabase($querySql);
        return $result;
    }

    public function getAllLinks()
    {
        $querySql = "SELECT * FROM `LINKS`";
        $result = $this->database->selectDatabase($querySql);
        return $result;
    }

    // retorna os dados do usuário consultado
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
