<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/person.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare person object
$person = new Person($db);
 
// query person
$stmt = $person->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // person array
    $person_arr=array();
    $person_arr["person"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $person_item=array(
            "id" => $id,
            "name" => $name,
            "surname" => $surname,
            "phone" => $phone,
            "email" => $email,
            "description" => $description,
            "created" => $created
        );
        array_push($person_arr["person"], $person_item);
    }
 
    echo json_encode($person_arr["person"]);
}
else{
    echo json_encode(array());
}
?>