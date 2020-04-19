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
$reservation->person_id = $_POST['person_id'];
$reservation->workstation_id = $_POST['workstation_id'];
$reservation->date = $_POST['date'];
$reservation->time_start = $_POST['time_start'];
$reservation->time_end = $_POST['time_end'];
$reservation->created = date('Y-m-d H:i:s');

// create the reservation
if($reservation->create()){
    $reservation_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "id" => $reservation->id,
        "person_id" => $reservation->person_id,
        "workstation_id" => $reservation->workstation_id,
        "date" => $reservation->date,
        "time_start" => $reservation->time_start,
        "time_end" => $reservation->time_end
    );
}
else{
    $reservation_arr=array(
        "status" => false,
        "message" => "Dane miejsce jest już zajęte. Spróbuj wybrac inny termin lub miejsce."
    );
}
print_r(json_encode($reservation_arr));
?>