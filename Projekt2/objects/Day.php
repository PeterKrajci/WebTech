<?php
class Day{
  
    // database connection and table name
    private $conn;
   
  
    // object properties
    public $id;

  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // search products
    function search($mydate){

        //parse date 
        $parsed_date=date_parse($mydate);
        
        // select all query
        $query = "SELECT id FROM days WHERE day=? AND month =?"; 


    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        //$keywords=htmlspecialchars(strip_tags($keywords));
        //$keywords = "%{$keywords}%";
    
    
        // execute query
        $stmt->execute([$parsed_date['day'],$parsed_date['month']]);
        $id = $stmt->fetch(PDO::FETCH_NUM);
        return $id[0];
    }

    function searchDay($day_id){

        
        
        // select all query
        $query = "SELECT * FROM days WHERE id=?"; 


    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        //$keywords=htmlspecialchars(strip_tags($keywords));
        //$keywords = "%{$keywords}%";
    
    
        // execute query
        $stmt->execute([$day_id]);
        $date_row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $date_row;
    }
}
?>

    