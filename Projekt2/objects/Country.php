<?php
class Country{
  
    // database connection and table name
    private $conn;
    
  
    // object properties
    public $id;
    public $title;
    public $code;
    
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function search($country_id){

        
        
        // select all query
        $query = "SELECT title FROM countries WHERE id=?"; 


    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        //$keywords=htmlspecialchars(strip_tags($keywords));
        //$keywords = "%{$keywords}%";
    
    
        // execute query
        $stmt->execute([$country_id]);
        $country=$stmt->fetch(PDO::FETCH_NUM);
        
        return $country[0];
    }

    function searchID($state){

        
        
        // select all query
        $query = "SELECT id FROM countries WHERE title=?"; 


    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        //$keywords=htmlspecialchars(strip_tags($keywords));
        //$keywords = "%{$keywords}%";
    
    
        // execute query
        $stmt->execute([$state]);
        $id=$stmt->fetch(PDO::FETCH_NUM);
        
        
        return $id[0];
    }
}
?>