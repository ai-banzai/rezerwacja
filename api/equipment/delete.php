<?php
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/equipment.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare equipment object
$equipment = new Equipment($db);
 
// set equipment property values
$equipment->id = $_POST['id'];
 
// remove the equipment
if($equipment->delete()){
    $equipment_arr=array(
        "status" => true,
        "message" => "Successfully Removed!"
    );
}
else{
    $equipment_arr=array(
        "status" => false,
        "message" => "Ten element wyposażenia nie może zostac usunięty."
    );
}
print_r(json_encode($equipment_arr));
?>