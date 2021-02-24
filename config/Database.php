<?php 
namespace Webapp\Config\Db;
use PDO;


class Database {

    private $servername = 'localhost';
    private $username = 'root';
    private $password='';
    private $db='webapp';
    public $conn;

    public function __construct() {

        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->db."",$this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
           
          } catch(PDOException $e) {
                throw new Exception($e->getMessage());   
          }

          return $this->conn;
     }
    


    private function executeStatement( $statement = "" , $parameters = [] ){
      try{

          $stmt = $this->conn->prepare($statement);
          $stmt->execute($parameters);
         
          return $stmt;
  
      }catch(Exception $e){
          throw new Exception($e->getMessage());   
      }		
  }

  public function Insert( $statement = "" , $parameters = [] ){

    try{
       
        $this->executeStatement( $statement , $parameters );
        return $this->conn->lastInsertId();
       
    }catch(Exception $e){
        throw new Exception($e->getMessage());   
    }		
}


public function Update( $statement = "" , $parameters = [] ){
    try{
       
        $this->executeStatement( $statement , $parameters );
    
        return $this->conn->lastInsertId();
        
    }catch(Exception $e){
        throw new Exception($e->getMessage());   
    }		
}

public function Remove( $statement = "" , $parameters = [] ){
    try{
        
        $this->executeStatement( $statement , $parameters );
        
    }catch(Exception $e){
        throw new Exception($e->getMessage());   
    }		
}		


    public function Select( $statement = "" , $parameters = [] ){
      try{
  
          $stmt = $this->executeStatement( $statement , $parameters );
          return $stmt->fetch(PDO::FETCH_OBJ);
  
      }catch(Exception $e){
          throw new Exception($e->getMessage());   
      }		
  }

  public function SelectAll( $statement = "" , $parameters = [] ){
    try{

        $stmt = $this->executeStatement( $statement , $parameters );
        return $stmt->fetchAll();

    }catch(Exception $e){
        throw new Exception($e->getMessage());   
    }		
}

   
}



