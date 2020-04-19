<?php
class Person{
 
    // database connection and table name
    private $conn;
    private $table_name = "persons";
 
    // object properties
    public $id;
    public $name;
    public $surname;
    public $phone;
    public $email;
    public $description;
    public $created;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all persons
    function read(){
    
        // select all query
        $query = "SELECT
                    `id`, `name`, `surname`, `phone`, `email`, `description`, `created`
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
}