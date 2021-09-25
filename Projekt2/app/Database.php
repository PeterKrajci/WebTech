<?php
    require_once("app/config2.php");

    class Database{
        public $conn = null;

        public function createConnection(){
            try{
                $this->conn = new PDO("mysql:host=" . SERVERNAME .";dbname=" . DBNAME, USERNAME, PASSWORD);

                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->conn;

            } catch(PDOException $e){
                echo "Connection failed: " . $e->getMessage();
            }
        }
    }

?>