<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once 'app/Database.php';
include_once 'objects/Record.php';
include_once 'objects/Day.php';
include_once 'objects/Country.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->createConnection();
  
// initialize object
$day = new Day($db);
$record = new Record($db);
$country = new Country($db);
  
// get keywords
$mydate=isset($_GET["date"]) ? $_GET["date"] : "";
$state=isset($_GET["state"]) ? $_GET["state"] : "";
  
// query 
$countryID=$country->searchID($state);


$day_id = $day->search($mydate);
$stmt = $record->search($day_id,$countryID);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $record_arr=array();
    $record_arr["records"]=array();
  
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        
        
        $record_item=array(
            "name" => $value,
        );
  
        array_push($record_arr["records"], $record_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data
    echo json_encode($record_arr,JSON_UNESCAPED_UNICODE);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No names found.")
    );
}
?>