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

// Check if airlineid is set
if(isset($_REQUEST['airlineid'])) {
    $ali = $_REQUEST['airlineid'];
    
    $stmt = $connection->prepare("SELECT * FROM airline WHERE airlineid=?");
    $stmt->bind_param("i", $ali);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['airlineid'];
        $u = $row['airlinecode'];
        $y = $row['airlinename'];
    } else {
        echo "airline not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="ali">airlineid:</label>
        <input type="number" name="ali" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="alc">airlineCode:</label>
        <input type="number" name="alc" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="aln">airlinename:</label>
        <input type="text" name="aln" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $airlineid= $_POST['ali'];
    $airlinecode = $_POST['alc'];
    $airline = $_POST['aln'];
    
    // Update the product in the database
    $stmt = $connection->prepare("UPDATE airline SET Airlineid=?, airlinecode=?, airlinename=?,  WHERE airlineid=?");
    $stmt->bind_param("ssdi", $airlineid, $airlinecode, $airlinename, $ali);
    $stmt->execute();
    
    // Redirect to Accounts.php
    header('Location: airline.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
