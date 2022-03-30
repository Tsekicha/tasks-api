<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  

include_once '../config/db.php';
include_once '../objects/tags_db.php';
  

$database = new Database();
$db = $database->getConnection();
  

$tag = new Tags($db);
  
// set ID property of record to read
$tag->id_tag = isset($_GET['id_tag']) ? $_GET['id_tag'] : die('Bug is here');
  
// read the details of product
$tag->readOne();

  
if($tag->tag_name!=null){
    // create array to display
    $tag_arr = array(
        "id_tag" =>  $tag->id_tag,
        "tag_name" => $tag->tag_name,
        "color" => $tag->color
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($tag_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user that tag does not exist
    echo json_encode(array("message" => "Tag does not exist."));
}
?>