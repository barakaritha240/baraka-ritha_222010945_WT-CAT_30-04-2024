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

// Check if reservationid is set
if(isset($_REQUEST['reservationid'])) {
    $rid = $_REQUEST['reservationid'];
    
    $stmt = $connection->prepare("SELECT * FROM reservation WHERE reservationid=?");
    $stmt->bind_param("i", $rid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['reservationid'];
        $u = $row['passengerid'];
        $y = $row['reservationtime'];
        $z = $row['reservationdate']
    } else {
        echo "reservation not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="rid">reservationid:</label>
        <input type="number" name="rid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="pid">passengerid:</label>
        <input type="number" name="pid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        
        <label for="rt">reservationtime:</label>
        <input type="number" name="rt" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="rd">reservationdate:</label>
        <input type="date" name="rd" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $reservationid = $_POST['rid'];
    $passengerid = $_POST['pid'];
    $reservationtime= $_POST['rt'];
    $reservationdate = $_POST['rd'];
    
    // Update the transactions in the database
    $stmt = $connection->prepare("UPDATE reservation SET reservationid=?, passengerid=?, reservationtime=?, reservationdate=? WHERE reservationid=?");
    $stmt->bind_param("ssdii", $reservationid, $passengerid, $reservationtime, $reservationdate;
    $stmt->execute();
    
    // Redirect to reservation.php
    header('Location: reservation.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
