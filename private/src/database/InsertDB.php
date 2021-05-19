<?php 
namespace Database;

use Database\Database;
Use PDO;

// classe que reúne os métodos para fazer inserts no banco de dados
class InsertDB extends Database
{

    public static function addNewLink($data)
    {
        $connection = parent::connect();
        $query = $connection->prepare('INSERT INTO LINKS(`order`, `name`, `url`, `status`, `permanentLink`, `expirationDatetime`) VALUES (:order, :name, :url, :status, :permanentLink, :expirationDatetime)');
        $query->bindValue(':order', $data->order, PDO::PARAM_INT);
        $query->bindValue(':name', $data->name, PDO::PARAM_STR);
        $query->bindValue(':url', $data->url, PDO::PARAM_STR);
        $query->bindValue(':status', $data->status, PDO::PARAM_BOOL);
        $query->bindValue(':permanentLink', $data->permanentLink, PDO::PARAM_BOOL);
        $query->bindValue(':expirationDatetime', $data->expirationDatetime, PDO::PARAM_STR);
        $query->execute();
        $result = $connection->lastInsertId() or die(print_r($query->errorInfo(), true));
        parent::disconnect();
        return $result;
    }

    // adição de um novo usuário
    public static function addNewUser($data)
    {
        $connection = parent::connect();
        $query = $connection->prepare("INSERT INTO USER(`cpf`, `email`, `username`, `type`, `status`, `passwordHash`) VALUES (:cpf, :email, :username, :type, 1, '$2y$10$7uU5kRQjONNPG5MeCMgVwe0pgqQrspKVx2uhhgmvgUB5Fj7vzWSv6')");
        $query->bindValue(':cpf', $data->cpf, PDO::PARAM_STR);
        $query->bindValue(':email', $data->email, PDO::PARAM_STR);
        $query->bindValue(':username', $data->username, PDO::PARAM_STR);
        $query->bindValue(':type', $data->userType, PDO::PARAM_STR);
        if($query->execute() == true){

            $userId = $connection->lastInsertId();
            $query = $connection->prepare("INSERT INTO PERSONAL_INFORMATION(`name`, `lastName`, `idUser`, `photoFile`) VALUES (:name, :lastName, :idUser, 'default.png')");
            $query->bindValue(':name', $data->name, PDO::PARAM_STR);
            $query->bindValue(':lastName', $data->lastName, PDO::PARAM_STR);
            $query->bindValue(':idUser', $userId, PDO::PARAM_INT);
            if($query->execute() == true){
                parent::disconnect();
                return true;
            }else{
                return $connection->errorCode();
                parent::disconnect();
            }
        }
        return $connection->errorCode();
        parent::disconnect();
    }
}
