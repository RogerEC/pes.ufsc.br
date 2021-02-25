<?php 
namespace Database;

use PDO;
use PDOException;

require_once DIR_PASSWORDS . 'database.php';

class Database
{
    private $databaseType;
    private $host;
    private $port;
    private $user;
    private $password;
    private $database;
    private static $connection;

    public function __construct($dbtype = null, $host = null,
     $port = null, $user = null, $password = null, $db = null)
    {
        require_once DIR_PASSWORDS . '/database.php';

        $this->databaseType = (is_null($dbtype))? DB_DATABASE_TYPE:$dbtype;
        $this->host = (is_null($host))? DB_HOST:$host;
        $this->port = (is_null($port))? DB_PORT:$port;
        $this->user = (is_null($user))? DB_USER:$user;
        $this->password = (is_null($password))? DB_PASSWORD:$password;
        $this->database = (is_null($db))? DB_DATABASE:$db;
    }

    public function __destruct() {
        $this->disconnect();
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    public function connect()
    {
        try {
            if (is_null(self::$connection)){
                self::$connection = new PDO("$this->databaseType:host=$this->host;port=$this->port;dbname=$this->database", $this->user, $this->password);
            }
            echo "conectou";
        } catch(PDOException $error) {
            echo "erro ".$error->getMessage();
        }
    }

    public function disconnect()
    {
        self::$connection = null;
    }
}
