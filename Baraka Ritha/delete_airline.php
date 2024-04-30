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

// Check if AirlineID is set
if(isset($_REQUEST['AirlineID'])) {
    $aid = $_REQUEST['AirlineID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM airline WHERE AirlineID=?");
    $stmt->bind_param("i", $ali);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "AirlineID is not set.";
}

$connection->close();
?>
