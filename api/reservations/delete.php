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
 
// remove the reservation
if($reservation->delete()){
    $reservation_arr=array(
        "status" => true,
        "message" => "Successfully Removed!"
    );
}
else{
    $reservation_arr=array(
        "status" => false,
        "message" => "Rezeracja nie może zostać usunięta."
    );
}
print_r(json_encode($reservation_arr));
?>