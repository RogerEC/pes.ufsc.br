<?php 
namespace Database;

use Database\Database;
Use PDO;

// classe que reúne os métodos para realizar delete de dados do banco de dados
class DeleteDB extends Database
{
    // deleta o link correspondente ao id informado do banco de dados
    public static function deleteLink($linkId)
    {
        $query = parent::connect()->prepare('DELETE FROM `LINKS` WHERE `idLinks` = :linkId');
        $query->bindValue(':linkId', $linkId, PDO::PARAM_INT);
        $query->execute();
        $result = $query->rowCount();
        parent::disconnect();
        return $result;
    }

    // deleta o usuário da base de dados
    public static function deleteUser($userId)
    {
        $query = parent::connect()->prepare('DELETE FROM `PERSONAL_INFORMATION` WHERE `idUser` = :userId');
        $query->bindValue(':userId', $userId, PDO::PARAM_INT);
        if($query->execute() === true){
            parent::disconnect();
            $query2 = parent::connect()->prepare('DELETE FROM `USER` WHERE `idUser` = :userId');
            $query2->bindValue(':userId', $userId, PDO::PARAM_INT);
            $query2->execute();
            $result = $query->rowCount();
            parent::disconnect();
            return $result;
        };
        parent::disconnect();
        return 0;
    }
}
