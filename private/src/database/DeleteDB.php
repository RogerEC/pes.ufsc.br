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
}
