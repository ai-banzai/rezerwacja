<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/reservation.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare reservation object
$reservation = new Reservation($db);
 
// query reservation
$stmt = $reservation->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // reservation array
    $reservations_arr=array();
    $reservations_arr["reservations"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $reservation_item=array(
            "id" => $id,
            "person_id" => $person_id,
            "workstation_id" => $workstation_id,
            "date" => $date,
            "time_start" => $time_start,
            "time_end" => $time_end,
            "created" => $created
        );
        array_push($reservations_arr["reservations"], $reservation_item);
    }
 
    echo json_encode($reservations_arr["reservations"]);
}
else{
    echo json_encode(array());
}
?>