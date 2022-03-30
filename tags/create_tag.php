<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  

include_once '../config/db.php';
include_once '../objects/tags_db.php';
  
$database = new Database();
$db = $database->getConnection();
  
$tag = new Tags($db);
 

// get posted data
$requestData = json_decode(file_get_contents("php://input"));

if( !empty($requestData)){
    
    foreach($requestData as $tagData){

        if(isset($tagData->tag_name) && isset($tagData->color)){

            $tag->tag_name = $tagData->tag_name;
            $tag->color = $tagData->color;
            $tag->create();
        }
        
    }
}
?>