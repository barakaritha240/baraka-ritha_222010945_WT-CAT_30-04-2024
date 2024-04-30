<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Customer</title>
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
    <li style="display: inline; margin-right: 10px;"><a href="./Accounts.php">ACCOUNTS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Branches.php">BRANCHES</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Customer.php">CUSTOMERS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Employees.php">EMPLOYEES</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Loan.php">LOAN</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Payments.php">PAYMENTS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Transactions.php">TRANSACTIONS</a>
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

    <h1><u> Payment Form </u></h1>
    <form method="post">
            
        <label for="Pid">PaymentID:</label>
        <input type="number" id="Pid" name="Pid"><br><br>

        <label for="Lid">LoanID:</label>
        <input type="number" id="Lid" name="Lid"><br><br>

        <label for="Amnt">Amount:</label>
        <input type="number" id="Amnt" name="Amnt" required><br><br>

        <label for=Paydt>PaymentDate:</label>
        <input type="Date" id="Paydt" name="Paydt" required><br><br>

        <input type="submit" name="add" value="Insert">
      

    </form>


<?php
// Connection details
$host = "localhost";
$user = "root";
$pass = "";
$database = "bank_system";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO payments(LoanID, Amount, PaymentDate) VALUES (?, ?, ?)");
    $stmt->bind_param("ssssss", $Lid, $Amnt, $Paydt);
    // Set parameters and execute
    $Pid = $_POST['Pid'];
    $Lid = $_POST['Lid'];
    $Amnt = $_POST['Amnt'];
    $Paydt = $_POST['Paydt'];
   
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
$database = "bank_system";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
// SQL query to fetch data from the Customer table
$sql = "SELECT * FROM payments";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of Payments</title>
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
    <center><h2>Table of Payments</h2></center>
    <table border="5">
        <tr>
            <th>PaymentID</th>
            <th>LoanID</th>
            <th>Amount</th>
            <th>PaymentDate</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Define connection parameters
        $host = "localhost";
        $user = "root";
        $pass = "";
        $database = "bank_system";

        // Establish a new connection
        $connection = new mysqli($host, $user, $pass, $database);

        // Check if connection was successful
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Prepare SQL query to retrieve all Payment
        $sql = "SELECT * FROM payments";
        $result = $connection->query($sql);

        // Check if there are any Payment
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $pid = $row['PaymentID']; // Fetch the PaymentID
                echo "<tr>
                    <td>" . $row['PaymentID'] . "</td>
                    <td>" . $row['LoanID'] . "</td>
                    <td>" . $row['Amount'] . "</td>
                    <td>" . $row['PaymentDate'] . "</td>
                    <td><a style='padding:4px' href='delete_payments.php?PaymentID=$Pid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_payments.php?PaymentID=$Pid'>Update</a></td> 
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
    <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by: @Aline UMUHOZA</h2></b>
  </center>
</footer>
</body>
</html>