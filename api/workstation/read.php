<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/workstation.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare workstation object
$workstation = new Workstation($db);
 
// query workstation
$stmt = $workstation->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // workstation array
    $workstation_arr=array();
    $workstation_arr["workstation"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $workstation_item=array(
            "id" => $id,
            "name" => $name,
            "description" => $description,
            "created" => $created
        );
        array_push($workstation_arr["workstation"], $workstation_item);
    }
 
    echo json_encode($workstation_arr["workstation"]);
}
else{
    echo json_encode(array());
}
?>