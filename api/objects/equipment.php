<?php
class Equipment{
 
    // database connection and table name
    private $conn;
    private $table_name = "equipment";
 
    // object properties
    public $id;
    public $type;
    public $model;
    public $name;
    public $year_of_purchase;
    public $value;
    public $workstation_id;
    public $created;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all equipments
    function read(){
    
        // select all query
        $query = "SELECT
                    `id`, `type`, `model`, `name`, `year_of_purchase`, `value`, `workstation_id`, `created`
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
    // read some equipments
    function read_for_workstation(){
    
        // select all query
        $query = "SELECT
                    `id`, `type`, `model`, `name`, `year_of_purchase`, `value`, `workstation_id`, `created`
                FROM
                    " . $this->table_name . " 
                WHERE 
                    workstation_id = '".$this->workstation_id."'
                ORDER BY
                    id DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // get single equipment data
    function read_single(){
    
        // select all query
        $query = "SELECT
                     `id`, `type`, `model`, `name`, `year_of_purchase`, `value`, `workstation_id`, `created`
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

    // create equipment
    function create(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        
        // query to insert record
        $query = "INSERT INTO  ". $this->table_name ." 
                        (`type`, `model`, `name`, `year_of_purchase`, `value`, `workstation_id`, `created`)
                  VALUES
                        ('".$this->type."', '".$this->model."', '".$this->name."', '".$this->year_of_purchase."', '".$this->value."', '".$this->workstation_id."', '".$this->created."')";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update equipment 
    function update(){
    
        // query to insert record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    type='".$this->type."', model='".$this->model."', name='".$this->name."', year_of_purchase='".$this->year_of_purchase."', value='".$this->value."', workstation_id='".$this->workstation_id."'
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

    // delete equipment
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
    //CHECKING IF TIME RESERVED SHOULD GO HERE
    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                name='".$this->name."'";

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