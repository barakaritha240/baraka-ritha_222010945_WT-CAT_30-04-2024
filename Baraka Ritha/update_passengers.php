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
    
    $stmt = $connection->prepare("SELECT * FROM passengers WHERE passengerid=?");
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['passengerid'];
        $u = $row['flightid'];
        $y = $row['passengername'];
        $z = $row['passengergender'];
        $w = $row['email'];
    } else {
        echo "passengers not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="pid">passengerid:</label>
        <input type="number" name="pid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="fid">flightid:</label>
        <input type="number" name="fid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="pn">passengername:</label>
        <input type="text" name="pn" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="pg">passengergender:</label>
        <input type="text" name="pg" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="em">em:</label>
        <input type="text" name="em" value="<?php echo isset($q) ? $q : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $passengerid = $_POST['pid'];
    $flightid= $_POST['fid'];
    $pasengername = $_POST['pn'];
    $passengergender= $_POST['pg'];
    $email = $_POST['email'];
    
    // Update the passengers in the database
    $stmt = $connection->prepare("UPDATE passengers SET passengerid=?, flightid=?, passengername=?, passengergender=?, email=? WHERE passengerid=?");
    $stmt->bind_param("ssdii", $passengerid, $flightid, $passengername, $passengergender,$email, $pid);
    $stmt->execute();
    
    // Redirect to loan.php
    header('Location: passengers .php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
