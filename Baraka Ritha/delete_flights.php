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

// Check if flightsID is set
if(isset($_REQUEST['FlightsID'])) {
    $aid = $_REQUEST['FlightsID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM branches WHERE flightsID=?");
    $stmt->bind_param("i", $bid);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "flightsID is not set.";
}

$connection->close();
?>
