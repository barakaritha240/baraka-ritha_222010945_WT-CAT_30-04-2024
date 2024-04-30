<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our passengers</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: pink;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */

      padding: 8px;
     
    }
    section{
    padding:71px;
    border-bottom: 1px solid #ddd;
    }
    footer{
    text-align: center;
    padding: 15px;
    background-color:darkgray;
    }

  </style>
  </head>

  <header>

<body bgcolor="blue">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./Images/arsnl.jpg" width="90" height="60" alt="Logo">
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
  </li>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Service.html">SERVICE</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Airline.php">AIRLINE</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Flights.php">FLIGHTS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Passengers.php">PASSENGERS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Payment.php">PAYMENT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Reservation.php">RESERVATION</a>
  </li>
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>

    <h1><u> passengers Form </u></h1>
    <form method="post">
            
        <label for="pid">passengerid:</label>
        <input type="number" id="pid" name="pid"><br><br>

        <label for="fid">flightid:</label>
        <input type="number" id="fid" name="fid"><br><br>

        <label for="pn">passengername:</label>
        <input type="text" id="pn" name="pn" required><br><br>

        <label for="pg">passengergender:</label>
        <input type="text" id="pg" name="pg" required><br><br>

        <label for="em">email:</label>
        <input type="text" id="em" name="em" required><br><br>

        <input type="submit" name="add" value="Insert">
      

    </form>


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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO passengers(passengerid,flightid,passengername,passengergender,email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $pid, $fid ,$pn, $pg, $em);
    // Set parameters and execute
    $pid = $_POST['pid'];
    $fid = $_POST['fid'];
    $pn = $_POST['pn'];
    $pg = $_POST['pg'];
    $em = $_POST['em'];
    
   
    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>

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
// SQL query to fetch data from the passengers table
$sql = "SELECT * FROM passengers";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of passengers</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Table of passengers</h2></center>
    <table border="5">
        <tr>
            <th>passengerid</th>
            <th>flightid</th>
            <th>passengername</th>
            <th>passengergender</th>
            <th>email</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Define connection parameters
        $host = "localhost";
        $user = "root";
        $pass = "";
        $database = "flightbooking";

        // Establish a new connection
        $connection = new mysqli($host, $user, $pass, $database);

        // Check if connection was successful
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Prepare SQL query to retrieve all passengers
        $sql = "SELECT * FROM passengers";
        $result = $connection->query($sql);

        // Check if there are any passengers
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $pid = $row['passengerid']; // Fetch the passengerid
                echo "<tr>
                    <td>" . $row['passengerid'] . "</td>
                    <td>" . $row['flightid'] . "</td>
                    <td>" . $row['passengername'] . "</td>
                    <td>" . $row['passengergender'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td><a style='padding:4px' href='delete_passengers.php?passengerid=$pid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_passengers.php?passenderid=$pid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
</body>

    </section>


  
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by: @Baraka Ritha</h2></b>
  </center>
</footer>
</body>
</html>