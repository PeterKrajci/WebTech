<?php
class Record{
  
    // database connection and table name
    private $conn;
    
  
    // object properties
    public $id;
    public $country_id;
    public $day_id;
    public $type;
    public $value;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    public function search($day_id,$countryID){

        
        
        // select all query
        $query = "SELECT * FROM records WHERE day_id=? AND country_id=? AND type='nameday'"; 


    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        //$keywords=htmlspecialchars(strip_tags($keywords));
        //$keywords = "%{$keywords}%";
    
    
        // execute query
        $stmt->execute([$day_id,$countryID]);
        
        return $stmt;
    }

    function searchOne($name,$countryID){

        
        
        // select all quer
        $query = "SELECT * FROM records WHERE value=? AND country_id=? AND type=?"; 


    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        //$keywords=htmlspecialchars(strip_tags($keywords));
        //$keywords = "%{$keywords}%";
    
        $variable="nameday";
        // execute query
        $stmt->execute([$name,$countryID,$variable]);
        
        return $stmt;
    }
    function searchSKHolidays(){

        
        
        // select all quer
        $query = "SELECT * FROM `records` WHERE type='holiday' AND country_id=4";


    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        //$keywords=htmlspecialchars(strip_tags($keywords));
        //$keywords = "%{$keywords}%";
    
        
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    function searchCZHolidays(){

        
        
        // select all quer
        $query = "SELECT * FROM `records` WHERE type='holiday' AND country_id=5";


    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        //$keywords=htmlspecialchars(strip_tags($keywords));
        //$keywords = "%{$keywords}%";
    
        
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    function searchSKMemdays(){

        
        
        // select all quer
        $query = "SELECT * FROM `records` WHERE type='memday' AND country_id=4";


    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        //$keywords=htmlspecialchars(strip_tags($keywords));
        //$keywords = "%{$keywords}%";
    
        
        // execute query
        $stmt->execute();
        
        return $stmt;
    }

    function create(){
  
        // query to insert record
        $queryy="SELECT COUNT(id) FROM `records` WHERE day_id=? AND value=? AND country_id=?";

        $stmt = $this->conn->prepare($queryy);
        
        $stmt->execute([$this->day_id,$this->value,$this->country_id]);
        $num = $stmt->fetch(PDO::FETCH_NUM);
        if($num[0]==0){
            $query = "INSERT INTO records (day_id, country_id, type, value) VALUES (?,?,?,?)";
      
            // prepare query
            $stmt = $this->conn->prepare($query);
        
            // sanitize
            //$this->name=htmlspecialchars(strip_tags($this->name));
            /*$this->price=htmlspecialchars(strip_tags($this->price));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->category_id=htmlspecialchars(strip_tags($this->category_id));
            $this->created=htmlspecialchars(strip_tags($this->created));*/
        
            // bind values
            /*$stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":price", $this->price);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":category_id", $this->category_id);
            $stmt->bindParam(":created", $this->created);*/
        
            // execute query
            if($stmt->execute([$this->day_id,$this->country_id,$this->type,$this->value])){
                return true;
            }
        }
            
      
        return false;
          
    }
}
?>