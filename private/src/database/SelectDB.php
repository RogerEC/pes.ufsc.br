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
}
