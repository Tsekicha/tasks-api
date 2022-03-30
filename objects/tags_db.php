<?php
class Tags{

    // database connection and table name
    private $conn;
    public $id_tag;
    public $tag_name;
    public $color;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    //Method for reading all the tag records in database;
    function read(){

        // select all query
        $query = "SELECT * FROM `tag`";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
    //Method for reading only one record from tag database by id;
    function readOne(){

        // query to read single record
        $query = "SELECT * FROM `tag`
                    WHERE id_tag = ?";
  
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id_tag);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->tag_name = $row['tag_name'];
        $this->color = $row['color'];
    }
    //Method for creating tag record/s = his name and color;
    function create(){

        // query to insert record
        $query = "INSERT INTO `tag`
                    SET tag_name=:tag_name,
                        color=:color";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->tag_name=htmlspecialchars(strip_tags($this->tag_name));
        $this->color=htmlspecialchars(strip_tags($this->color));
        
        // bind values
        $stmt->bindParam(":tag_name", $this->tag_name);
        $stmt->bindParam(":color", $this->color);

        // execute query
        if($stmt->execute()){
            return true;
        }
            return false;

    }
    //Method for updating specific tag record/s by changing his name and color;
    function update(){

        // update query
        $query = "UPDATE `tag`
        SET
            tag_name=:tag_name,
            color=:color
        WHERE
            id_tag=:id_tag";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id_tag=htmlspecialchars(strip_tags($this->id_tag));
        $this->tag_name=htmlspecialchars(strip_tags($this->tag_name));
        $this->color=htmlspecialchars(strip_tags($this->color));

        // bind values
        $stmt->bindParam(':id_tag', $this->id_tag);
        $stmt->bindParam(':tag_name', $this->tag_name);
        $stmt->bindParam(':color', $this->color);

        if($stmt->execute()){
            return true;
        }
            return false;
    }
    //Method that delete specific tag record/s in database by id;
    function delete(){
        // delete query
        $query = "DELETE FROM `tag`
                    WHERE id_tag = ? ";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id_tag=htmlspecialchars(strip_tags($this->id_tag));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id_tag);
      
        // execute query
        if($stmt->execute()){
            return true;
        }  
            return false;
    }       
}
?>