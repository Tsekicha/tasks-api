<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  

include_once '../config/db.php';
include_once '../objects/tasks_db.php';
  

$database = new Database();
$db = $database->getConnection();
  

$task = new Task($db);
  
// set ID property of record to read
$task->id_task = isset($_GET['id_task']) ? $_GET['id_task'] : die("Bug is here");
  
// read the details of task
$task->readOne();

  
if($task->task_name!=null){
    // create array to display
    $task_arr = array(
        "id_task" =>  $task->id_task,
        "task_name" => $task->task_name
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($task_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user task does not exist
    echo json_encode(array("message" => "Task does not exist."));
}
?>