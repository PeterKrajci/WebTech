<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection

  
// instantiate record object


include_once 'app/Database.php';
include_once 'objects/Record.php';
include_once 'objects/Day.php';
include_once 'objects/Country.php';
  
$database = new Database();
$db = $database->createConnection();
  
$day = new Day($db);
$record = new Record($db);
$country = new Country($db);


  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->name2) &&
    !empty($data->day2) &&
    !empty($data->month2) &&
    !empty($data->countryAddName5)
){
    $mydate="2021" . "-" . $data->month2 . "-" . $data->day2;

    $dayID=$day->search($mydate);
    var_dump($dayID);

    $countryID=$country->searchID($data->countryAddName5);
  
    // set record property values
    $record->day_id = $dayID;
    $record->country_id = $countryID;
    $record->type = "nameday";
    $record->value = $data->name2;
    
  
    // create the record
    if($record->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "record was created."));
    }
  
    // if unable to create the record, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to add."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    
    echo json_encode(array("message" => "Unable to create record. Data is incomplete."));
}
?>