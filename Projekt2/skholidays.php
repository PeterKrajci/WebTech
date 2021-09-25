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

  
  
// query 

$stmt = $record->searchSKHolidays();

$num = $stmt->rowCount();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

//var_dump($rows);
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $skHoliday_arr=array();
    $skHoliday_arr["records"]=array();
  
    
    foreach($rows as $row){
        // extract row
        // this will make $row['name'] to
        // just $name only
        //extract($row);
        //var_dump($row);
        $datee=$day->searchDay($row['day_id']);
        
        //extract($datee);
       
        
        
        $skHoliday_item=array(
            "value" => $row['value'],
            "day" => $datee['day'],
            "month" => $datee['month'],
            "year" => "2021",
        );
  
        array_push($skHoliday_arr["records"], $skHoliday_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data
    echo json_encode($skHoliday_arr,JSON_UNESCAPED_UNICODE);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>