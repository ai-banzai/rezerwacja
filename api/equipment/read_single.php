<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/equipment.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare equipment object
$equipment = new Equipment($db);

// set ID property of equipment to be edited
$equipment->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of equipment to be edited
$stmt = $equipment->read_single();

if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $equipment_arr=array(
        "id" => $row['id'],
        "type" => $row['type'],
        "model" => $row['model'],
        "name" => $row['name'],
        "year_of_purchase" => $row['year_of_purchase'],
        "value" => $row['value'],
        "workstation_id" => $row['workstation_id'],
        "created" => $row['created']
    );
}
// make it json format
print_r(json_encode($equipment_arr));
?>