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
$equipment->type = $_POST['type'];
$equipment->model = $_POST['model'];
$equipment->name = $_POST['name'];
$equipment->year_of_purchase = $_POST['year_of_purchase'];
$equipment->value = $_POST['value'];
$equipment->workstation_id = $_POST['workstation_id'];
$equipment->created = date('Y-m-d H:i:s');

// create the equipment
if($equipment->create()){
    $equipment_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "id" => $equipment->id,
        "type" => $equipment->type,
        "model" => $equipment->model,
        "name" => $equipment->name,
        "year_of_purchase" => $equipment->year_of_purchase,
        "value" => $equipment->value,
        "workstation_id" => $equipment->workstation_id,
    );
}
else{
    $equipment_arr=array(
        "status" => false,
        "message" => "Element wyposażenia o tej nazwie juz istnieje."
    );
}
print_r(json_encode($equipment_arr));
?>