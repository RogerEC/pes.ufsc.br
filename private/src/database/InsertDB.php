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
}
