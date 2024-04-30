<?php
// Connection details
$host = "localhost";
$user = "root";
$pass = "";
$database = "flightbooking";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if TransactionID is set
if(isset($_REQUEST['reservationid'])) {
    $rid = $_REQUEST['reservationid'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM reservation WHERE reservationid=?");
    $stmt->bind_param("i", $rid);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "reservationid is not set.";
}

$connection->close();
?>
