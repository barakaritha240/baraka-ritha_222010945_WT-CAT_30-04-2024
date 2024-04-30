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

// Check if flightsid is set
if(isset($_REQUEST['flightid'])) {
    $fid = $_REQUEST['flightid'];
    
    $stmt = $connection->prepare("SELECT * FROM  flights WHERE flightid=?");
    $stmt->bind_param("i", $fid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['flightid'];
        $u = $row['airlineid'];
        $y = $row['ticketprice'];
        $y = $row['availableseats'];
    } else {
        echo "flights not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="fid">flightid:</label>
        <input type="number" name="fid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="aid">airlineid:</label>
        <input type="number" name="aid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <label for="tp">ticketprice:</label>
        <input type="number" name="tp" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <label for="as">availableseats:</label>
        <input type="number" name="as" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $flightid= $_POST['fid'];
    $airlineid = $_POST['aid'];
    $ticketprice = $_POST['tp'];
    $availableseats = $_POST['as'];
    
    
    // Update the flights in the database
    $stmt = $connection->prepare("UPDATE flights SET flightid==?, airlineid =?ticketprice =? availableseats =?  WHERE flightid=?");
    $stmt->bind_param("ssddi", $flightid, $airlineid, $ticketprice,$availableseats,$fid);
    $stmt->execute();
    
    // Redirect to branches.php
    header('Location: flights.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
