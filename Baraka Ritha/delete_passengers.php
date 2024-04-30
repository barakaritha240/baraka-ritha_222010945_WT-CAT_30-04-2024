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

// Check if passengers is set
if(isset($_REQUEST['passengerid'])) {
    $pid = $_REQUEST['passengerid'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM passengers WHERE passengerid=?");
    $stmt->bind_param("i", $pid);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "passengerid is not set.";
}

$connection->close();
?>
