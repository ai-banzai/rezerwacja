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
$equipment->workstation_id = isset($_GET['workstation_id']) ? $_GET['workstation_id'] : die();

// query equipment
$stmt = $equipment->read_for_workstation();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // equipment array
    $equipment_arr=array();
    $equipment_arr["equipment"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $equipment_item=array(
            "id" => $id,
            "type" => $type,
            "model" => $model,
            "name" => $name,
            "year_of_purchase" => $year_of_purchase,
            "value" => $value,
            "workstation_id" => $workstation_id,
            "created" => $created
        );
        array_push($equipment_arr["equipment"], $equipment_item);
    }
 
    echo json_encode($equipment_arr["equipment"]);
}
else{
    echo json_encode(array());
}
?>