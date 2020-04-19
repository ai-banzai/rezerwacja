<?php
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/reservation.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare reservation object
$reservation = new Reservation($db);
 
// set reservation property values
$reservation->id = $_POST['id'];
$reservation->person_id = $_POST['person_id'];
$reservation->workstation_id = $_POST['workstation_id'];
$reservation->date = $_POST['date'];
$reservation->time_start = $_POST['time_start'];
$reservation->time_end = $_POST['time_end'];
 
// create the reservation
if($reservation->update()){
    $reservation_arr=array(
        "status" => true,
        "message" => "Successfully Updated!"
    );
}
else{
    $reservation_arr=array(
        "status" => false,
        "message" => "Reservation already exists!"
    );
}
print_r(json_encode($reservation_arr));
?>