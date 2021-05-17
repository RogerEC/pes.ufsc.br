<?php 
namespace Database;

use Database\Database;
Use PDO;

// classe responsável por reunir os métodos para realizar updates no banco de dados
class UpdateDB extends Database
{
    // efetua o update do hash da senha armazenado no banco com base no id do usuário
    public static function updatePasswordHash($userId, $newHash)
    {
        $query = parent::connect()->prepare('UPDATE `USER` SET `passwordHash` = :newHash WHERE `idUser` = :userId LIMIT 1');
        $query->bindValue(':newHash', $newHash, PDO::PARAM_STR);
        $query->bindValue(':userId', $userId, PDO::PARAM_INT);
        $query->execute();
        $result = $query->rowCount();
        parent::disconnect();
        return $result;
    }

    // efetua o update de um link na tabela de links
    public static function updateLinks($data)
    {
        $query = parent::connect()->prepare('UPDATE `LINKS` SET `order` = :newOrder, `name` = :new_name, `url` = :newUrl, `status` = :newStatus, `permanentLink` = :newPermanentLink, `expirationDatetime` = :newExpirationDatetime WHERE `idLinks` = :linkId');
        $query->bindValue(':newOrder', $data->order, PDO::PARAM_INT);
        $query->bindValue(':new_name', $data->name, PDO::PARAM_STR);
        $query->bindValue(':newUrl', $data->url, PDO::PARAM_STR);
        $query->bindValue(':newStatus', $data->status, PDO::PARAM_BOOL);
        $query->bindValue(':newPermanentLink', $data->permanentLink, PDO::PARAM_BOOL);
        $query->bindValue(':newExpirationDatetime', $data->expirationDatetime, PDO::PARAM_STR);
        $query->bindValue(':linkId', $data->idLinks, PDO::PARAM_INT);
        $query->execute();
        $result = $query->rowCount();
        parent::disconnect();
        return $result;
    }

    // realiza o update dos dados do perfil de usuário
    public static function updateUserProfile($data, $fileName = 'default.png')
    {
        $query = parent::connect()->prepare('UPDATE `PERSONAL_INFORMATION` SET `name` = :new_name, `lastName` = :newLastName, `photoFile` = :newPhotoFile WHERE `idUser` = :userId');
        $query->bindValue(':new_name', $data->name, PDO::PARAM_STR);
        $query->bindValue(':newLastName', $data->lastName, PDO::PARAM_STR);
        $query->bindValue(':newPhotoFile', $fileName, PDO::PARAM_STR);
        $query->bindValue(':userId', $data->idUser, PDO::PARAM_INT);
        if($query->execute() === false){
            parent::disconnect();
            return 'ERROR-000';
        }
        parent::disconnect();
        $query = parent::connect()->prepare('UPDATE `USER` SET `email` = :newEmail WHERE `idUser` = :userId');
        $query->bindValue(':newEmail', $data->email, PDO::PARAM_STR);
        $query->bindValue(':userId', $data->idUser, PDO::PARAM_INT);
        if($query->execute() === false){
            parent::disconnect();
            return 'ERROR-001';
        }
        parent::disconnect();
        return true;
    }
}
