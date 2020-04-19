<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/reservation.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare reservation object
$reservation = new Reservation($db);

// set ID property of reservation to be edited
$reservation->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of reservation to be edited
$stmt = $reservation->read_single();

if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $reservation_arr=array(
        "id" => $row['id'],
        "person_id" => $row['person_id'],
        "workstation_id" => $row['workstation_id'],
        "date" => $row['date'],
        "time_start" => $row['time_start'],
        "time_end" => $row['time_end'],
        "created" => $row['created']
    );
}
// make it json format
print_r(json_encode($reservation_arr));
?>