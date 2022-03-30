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
 

// get posted data
$requestData = json_decode(file_get_contents("php://input"));

if (!empty($requestData)) {

    foreach($requestData as $taskData){

        if (isset($taskData->task_name)) {

                $task->task_name = $taskData->task_name;
                $task->tags = [];

            if(isset($taskData->tags)){
                $task->tags = $taskData->tags;
            }
                $task->create();
        }
    }
}
?>