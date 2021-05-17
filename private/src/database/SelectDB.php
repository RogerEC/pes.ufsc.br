<?php 
namespace Database;

use Database\Database;
use PDO;

// classe responsável por fazer os selects e retornar os resultados das consultas
class SelectDB extends Database
{
    // retorna a lista de links ativos e não expirados para página de links
    public static function getActiveLinks()
    {
        $querySql = "SELECT `name`, `url` FROM `LINKS` WHERE `status` = true AND (`permanentLink` = true OR (`permanentLink` = false AND `expirationDatetime` > NOW()))";
        $result = parent::selectDatabase($querySql);
        return $result;
    }

    public static function getAllLinks()
    {
        $querySql = "SELECT `idLinks`, `order`, `name`, `url`, `status`, `permanentLink`, date_format(`expirationDatetime`, '%Y-%m-%dT%H:%i') as `expirationDatetime` FROM `LINKS`";
        $result = parent::selectDatabase($querySql);
        return $result;
    }

    // retorna os dados do usuário consultado
    public static function getUserLoginData($user)
    {
        $query = parent::connect()->prepare('SELECT `idUser`, `passwordHash`, `type`, `status` FROM `USER` WHERE `username` = :user LIMIT 1');
        $query->bindValue(':user', $user, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        parent::disconnect();
        return $result;
    }

    // retorna os dados do perfil do usuário
    public static function getUserProfileData($userId)
    {
        $query = parent::connect()->prepare('SELECT a.`idUser`, a.`username`, a.`cpf`, a.`email`, b.`name`, b.`lastName`, b.`photoFile`  FROM `USER` a, `PERSONAL_INFORMATION` b WHERE a.`idUser` = :userId AND a.`idUser` = b.`idUser` LIMIT 1');
        $query->bindValue(':userId', $userId, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        parent::disconnect();
        return $result;
    }
}
