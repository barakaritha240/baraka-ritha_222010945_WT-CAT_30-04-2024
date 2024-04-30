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

// Check if transactionid is set
if(isset($_REQUEST['transactionid'])) {
    $tid = $_REQUEST['transactionid'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM payment WHERE transactionid=?");
    $stmt->bind_param("i", tid);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "transactionid is not set.";
}

$connection->close();
?>
