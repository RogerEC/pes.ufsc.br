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

    // Construtor da classe, carrega os dados de acesso ao banco na memória
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

    // destrutor da classe, libera a memória das variáveis utilizadas
    public function __destruct() {
        $this->disconnect();
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

    // efetua a conexão com o banco ou exibe uma mensagem de erro
    public function connect()
    {
        try {
            if (is_null(self::$connection)){
                self::$connection = new PDO("$this->databaseType:host=$this->host;port=$this->port;dbname=$this->database", $this->user, $this->password);
                return self::$connection;
            }
        } catch(PDOException $error) {
            echo "erro ".$error->getMessage();
            exit();
        }
    }

    // efetua a desconeção com o banco
    public function disconnect()
    {
        self::$connection = null;
    }

    // efetua um select genérico e retorna o resultado como um vetor de objetos
    public function selectDatabase($sql, $parameters = null)
    {
        $query = $this->connect()->prepare($sql);
        $query->execute($parameters);
        
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        
        $this->__destruct();
        
        return $result;
    }

    // efetua um insert genérico e retorna o id do último elemento inserido
    public function insertDatabase($sql, $parameters = null)
    {
        $connection = $this->connect();
        $query = $connection->prepare($sql);
        $query->execute($parameters);
        
        $result = $connection->lastInsertId() or die(print_r($query->errorInfo(), true));
        
        $this->__destruct();
        
        return $result;
    }

    // efetua um update genérico e retorna o número de linhas afetado
    public function updateDatabase($sql, $parameters = null)
    {
        $query = $this->connect()->prepare($sql);
        $query->execute($parameters);
        
        $result = $query->rowCount() or die(print_r($query->errorInfo(), true));
        
        $this->__destruct();
        
        return $result;
    }
}
