<?php

class DBO
{
    private static $instances = array();
    
    private $dbh = null;
    
    public static function getInstance($database)
    {
        if(empty(self::$instances[$database])) {
            self::$instances[$database] = new self($database);
        }
        
        return self::$instances[$database];
    }
    
    private function __construct($database)
    {
        $config = Config::getInstance();
        
        try {
            $dsn = 'mysql:host='.$config->db['host'].';dbname='.$database;
            $this->dbh = new PDO($dsn,$config->db['login'],$config->db['password']);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            throw new Exception('Failed to connect to database: '.$e->getMessage());
        }
    }
    
    public function query($sql, $data = null)
    {
        $sth = $this->dbh->prepare($sql);
	$res = $sth->execute($data);
        return $res;
    }
    
    public function lastInsertID()
    {
        return $this->dbh->lastInsertId();
    }
}

class Model 
{
    private $dbo = null;
    
    protected $database = '';
    
    public function __construct()
    {
        $this->dbo = DBO::getInstance($this->database);
    }
    
    public function query($sql, $data = null)
    {
        return $this->dbo->query($sql, $data);
    }
    
    public function lastInsertID()
    {
        return $this->dbo->lastInsertID();
    }
}

?>
