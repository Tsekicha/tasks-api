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
  
// get id of taasks to be edited
$requestData = json_decode(file_get_contents("php://input"));

// set ID property of tasks to be edited
if (!empty($requestData)) {

    foreach($requestData as $taskUpdate){
        if (isset($taskUpdate->id_task) && isset($taskUpdate->task_name)){
            $task->id_task = $taskUpdate->id_task;
            $task->task_name = $taskUpdate->task_name;
            $task->tags = [];

            if (isset($taskUpdate->task_name)){
                $task->tags = $taskUpdate->tags;

            }
                $task->update();
        }
    }
}
?>