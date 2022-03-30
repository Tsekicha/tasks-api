<?php
class Task{
  
    // database connection and table name
    private $conn;
    public $id_task;
    public $task_name;
    public $tags = [];
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    //Method for reading all the task records with their tag id in database;
    function read(){
        
        // select all query
        $query = "SELECT * FROM `task`
                  JOIN `task_tag`
                  ON task.id_task = task_tag.task_id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    //Method for creating task record/s = his name and his tags;
    function create(){
  
        // query to insert record
        $query = "INSERT INTO `task`
                SET
                    task_name=:task_name";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->task_name=htmlspecialchars(strip_tags($this->task_name));
    
        // bind values
        $stmt->bindParam(":task_name", $this->task_name);
    
        // execute query
        if($stmt->execute()) {
            // Add tags to task
            if (!empty($this->tags)) {
                $task_id = $this->conn->lastInsertId();
                
                foreach($this->tags as $tag_id){

                    $queryAddTags = "INSERT INTO task_tag 
                                     SET task_id=:task_id, 
                                         tag_id=:tag_id";
                    
                    $stmtAddTag = $this->conn->prepare($queryAddTags);
                    $stmtAddTag->bindParam(":task_id", $task_id);
                    $stmtAddTag->bindParam(":tag_id", $tag_id);
                    $stmtAddTag->execute();
                }
            }
            return true;
        }
        return false;  
    }

    //Method for reading only one record from task database by id;
    function readOne(){ 
  
        // query to read single record
        $query = "SELECT * FROM `task`
                    WHERE id_task = ?";
  
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_task);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->task_name = $row['task_name'];
    }

    //Method for updating specific tag record/s by changing his name and tags;
    function update(){
  
        // update task name query
        $query = "UPDATE `task`
                SET
                    task_name=:task_name
                WHERE
                    id_task=:id_task";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_task=htmlspecialchars(strip_tags($this->id_task));
        $this->task_name=htmlspecialchars(strip_tags($this->task_name));

        // bind values
        $stmt->bindParam(':id_task', $this->id_task);
        $stmt->bindParam(':task_name', $this->task_name);

        // execute the query
        if($stmt->execute()) {
            //updating tags

            $queryUpdateTags = "DELETE FROM `task_tag` 
                                WHERE task_id=:task_id ";

            $stmtUpdateTags = $this->conn->prepare($queryUpdateTags);
            $stmtUpdateTags->bindParam(':task_id',  $this->id_task);
            $stmtUpdateTags->execute();
            
            // Updating 
            if (!empty($this->tags)) {

                foreach($this->tags as $tag_id) {
                    $task_id = $this->id_task;
                        
                    $sqlUpdateTags = "INSERT INTO task_tag 
                                      SET  task_id=:task_id,
                                           tag_id=:tag_id";

                    $stmtUpdateTags = $this->conn->prepare($sqlUpdateTags);
                    $stmtUpdateTags->bindParam(":tag_id", $tag_id);
                    $stmtUpdateTags->bindParam(":task_id", $this->id_task);
                    $stmtUpdateTags->execute();
                }
            }
                 return true;
        }
            return false;
    }

    //Method that delete specific task record/s in database by id;
    function delete(){
    
        // delete query
        $query = "DELETE FROM `task`
                    WHERE id_task = ? ";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_task=htmlspecialchars(strip_tags($this->id_task));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_task);
      
        // execute query
        if($stmt->execute()){
            return true;
        }
            return false;
    }
}
?>