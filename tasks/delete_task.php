<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  

include_once '../config/db.php';
include_once '../objects/tasks_db.php';
  

$database = new Database();
$db = $database->getConnection();
  

$task = new Task($db);
  
// get tasks id to be deleted
$requestData = json_decode(file_get_contents("php://input"));

if (!empty($requestData)) {

    foreach($requestData as $taskDelete){
        if (isset($taskDelete->id_task)){

            $task->id_task = $taskDelete->id_task;
            $task->delete();

        }
    }
}
?>