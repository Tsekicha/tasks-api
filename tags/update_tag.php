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
  
// get id of tasks to be edited
$requestData = json_decode(file_get_contents("php://input"));

// set ID property of tasks to be edited
if (!empty($requestData)) {

    foreach($requestData as $tagUpdate){
        if (isset($tagUpdate->id_tag) && isset($tagUpdate->tag_name) && isset($tagUpdate->color)){
            $tag->id_tag = $tagUpdate->id_tag;
            $tag->tag_name = $tagUpdate->tag_name;
            $tag->color = $tagUpdate->color;
            $tag->update();
        }
    }
}
?>