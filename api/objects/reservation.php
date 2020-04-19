<?php
class Reservation{
 
    // database connection and table name
    private $conn;
    private $table_name = "reservations";
 
    // object properties
    public $id;
    public $person_id;
    public $workstaion_id;
    public $date;
    public $time_start;
    public $time_end;
    public $created;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all reservations
    function read(){
    
        // select all query
        $query = "SELECT
                    `id`, `person_id`, `workstation_id`, `date`, `time_start`, `time_end`, `created`
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    id DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // get single reservation data
    function read_single(){
    
        // select all query
        $query = "SELECT
                    `id`, `person_id`, `workstation_id`, `date`, `time_start`, `time_end`, `created`
                FROM
                    " . $this->table_name . " 
                WHERE
                    id= '".$this->id."'";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create reservation
    function create(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        
        // query to insert record
        $query = "INSERT INTO  ". $this->table_name ." 
                        (`person_id`, `workstation_id`, `date`, `time_start`, `time_end`, `created`)
                  VALUES
                        ('".$this->person_id."', '".$this->workstation_id."', '".$this->date."', '".$this->time_start."', '".$this->time_end."', '".$this->created."')";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update reservation 
    function update(){
    
        // query to insert record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    person_id='".$this->person_id."', workstation_id='".$this->workstation_id."', date='".$this->date."', time_start='".$this->time_start."', time_end='".$this->time_end."'
                WHERE
                    id='".$this->id."'";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // delete reservation
    function delete(){
        
        // query to insert record
        $query = "DELETE FROM
                    " . $this->table_name . "
                WHERE
                    id= '".$this->id."'";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    //TODO
    //CHECKING IF TIME RESERVED is already taken
    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                workstation_id='".$this->workstation_id."' AND date='".$this->date."' AND time_start<'".$this->time_end."' AND time_end>'".$this->time_start."'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}