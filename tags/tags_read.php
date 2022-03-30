<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/db.php';
include_once '../objects/tags_db.php';
  

$database = new Database();
$db = $database->getConnection();
  

$tag = new Tags($db);
  
// read tags will be here
// query products
$stmt = $tag->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // tags array
    $tags_arr["tags"]=array();
  
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);
  
        $tag_item=array(
            "id_tag" => $id_tag,
            "tag_name" => $tag_name,
            "color" => $color
        );
  
        array_push($tags_arr["tags"], $tag_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($tags_arr);
}else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user that no tags found
    echo json_encode(
        array("message" => "No tags found.")
    );
}