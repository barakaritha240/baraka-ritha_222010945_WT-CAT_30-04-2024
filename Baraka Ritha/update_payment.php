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
    
    $stmt = $connection->prepare("SELECT * FROM payment WHERE transactionid=?");
    $stmt->bind_param("i", $tid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['transactionid'];
        $u = $row['reservationid'];
        $y = $row['date'];
        $z = $row['amount'];
    } else {
        echo "payment not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="tid">transactionid:</label>
        <input type="number" name="tid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="rid">reservationid:</label>
        <input type="number" name="rid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="dt">date:</label>
        <input type="number" name="dt" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="amt">amount:</label>
        <input type="number" name="amt" value="<?php echo isset($q) ? $q : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $transactionid = $_POST['tid'];
    $reservationid = $_POST['rid'];
    $date = $_POST['dt'];
    $amount = $_POST['amt'];
    
    // Update the payment in the database
    $stmt = $connection->prepare("UPDATE payment SET transactionid=?, reservationid=?, date=?, amount=?, WHERE transactionid=?");
    $stmt->bind_param("ssdii", $transactionid, $reservationid, $date, $amount, $tid);
    $stmt->execute();
    
    // Redirect to payment.php
    header('Location: payment.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
