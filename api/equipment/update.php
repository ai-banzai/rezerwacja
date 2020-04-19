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
$equipment->type = $_POST['type'];
$equipment->model = $_POST['model'];
$equipment->name = $_POST['name'];
$equipment->year_of_purchase = $_POST['year_of_purchase'];
$equipment->value = $_POST['value'];
$equipment->workstation_id = $_POST['workstation_id'];
 
// create the equipment
if($equipment->update()){
    $equipment_arr=array(
        "status" => true,
        "message" => "Successfully Updated!"
    );
}
else{
    $equipment_arr=array(
        "status" => false,
        "message" => "equipment already exists!"
    );
}
print_r(json_encode($equipment_arr));
?>