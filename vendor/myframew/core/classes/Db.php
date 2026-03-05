<?php 


namespace myframew;

use PDO;
use PDOException;
use PDOStatement;


class Db {

    private $connect;
    private PDOStatement $stmt;
    private static $instance = null;

    private function __construct()
    {}

    private function __clone()
    {} 
    
    private function __wakeup()
    {}


    public static function getInstance()
    {
        if(self::$instance ===null){
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection(array $db_config) {

        if($this->connect instanceof PDO){
            return $this;
        }

        $dsn = "mysql:host={$db_config['hostname']};dbname={$db_config['dbname']};charset={$db_config['charset']}";

        try{
           
            $this->connect = new PDO($dsn, $db_config['username'], $db_config['password'], $db_config['options']);
            return $this;
        }
        catch(PDOException $e){

          abort(500);

        }
    }

    public function query($query,$params =[]){

        try{
                $this->stmt = $this->connect->prepare($query);
                $this->stmt->execute($params);
                
        }catch(PDOException $e){

        error_log("[" . date("Y-m-d, H:i:s"). "] Db Error:{$e->getMessage()} ". PHP_EOL, 3, ERRORS_FILE);


            return false;

        }
  
        return $this;
    }



    public function findAll(){

        return $this->stmt->fetchAll();
    }

    public function find(){

        return $this->stmt->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();
        if(!$result){
                abort();
        }else{
            return $result;
        }
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
    public function getColumn()
    {
        return $this->stmt->fetchColumn();
    }


    public function get_user_id()
    {

       return $this->connect->lastInsertId();


    }


}