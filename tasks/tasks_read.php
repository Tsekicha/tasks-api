<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/db.php';
include_once '../objects/tasks_db.php';
  

$database = new Database();
$db = $database->getConnection();
  

$tasks = new Task($db);
  
// read products will be here
// query products
$stmt = $tasks->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $tasks_arr["tasks"]=array();
  
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
       
        extract($row);
  
        $task_item=array(
            "id_task" => $id_task,
            "task_name" => $task_name,
            "tag_id" => $tag_id
        );
  
        array_push($tasks_arr["tasks"], $task_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($tasks_arr);
}else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no tasks found
    echo json_encode(
        array("message" => "No tasks found.")
    );
}