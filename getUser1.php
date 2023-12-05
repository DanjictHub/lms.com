<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Applicant Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="shortcut icon" type="image/x-icon" href="/adminTheme/img/favicon.png">

    <style>
        body {
            margin: 5px;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: lightseagreen;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #333;
            color: whitesmoke;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }

        .navbar a {
            text-decoration: none;
            color: rebeccapurple;
            font-size: 15px;
            display: flex;
            align-items: center;
        }

        .navbar a i {
            margin-right: 5px;
        }

        .navbar a:hover {
            text-decoration: underline;
            color: darkred;
        }

        .sidenav {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: whitesmoke;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
        }

        .sidenav a {
            padding: 15px;
            text-decoration: none;
            color: lightseagreen;
            font-family: monospace;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .sidenav a:hover {
            background-color: #555;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        footer {
            background-image: url('main2.jpeg');
            height: 10vh;
            background-position: top;
            background-size: auto;
            font-weight: bold;
            font-family: monospace;
            padding: 10px;
            margin: 5px;
            text-align: center;
        }

        footer p {
            color: black;
            font-size: 20;
            font-style: italic;
        }

        footer a {
            color: darkorange;
            text-decoration: none;
            font-size: 15px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            font-size: 12px;
        }
        .table-container {
    overflow-x: auto;
}
h1{
    position: center;
}
        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 100px;
            max-height: 100px;
        }

        .error-message {
    color: red;
    font-size: 35px;
    font: 1em sans-serif;
}
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Loan Management System</a>
    <img src="main2.jpeg" width="150" height="50" alt="image">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="landingPage.html">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="form.html">Apply Loan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#lms">Request Result</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="getUser.html">Login Page</a>
            </li>
        </ul>
    </div>
</nav>
<!--

<div class="sidenav">
    <img src="main2.jpeg" width="240" height="50" alt="image">
    <a href="#home"><i class="fas fa-home"></i> Home</a>
    <a href="#dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="#profile"><i class="fas fa-user"></i> Profile</a>
    <a href="#print"> <i class="fas fa-print"></i> Print Loan Slip </a>
    <a href="getUser.html"><i class="fas fa-check"></i> Check loan Status</a>
    <a href="#"><i class="fas fa-envelope"></i> My Documents</a>
    <a href="#settings"><i class="fas fa-cog"></i> Settings</a>
</div>
-->
<div class="table-container">
   
    <?php
    // Your PHP code for fetching and displaying records goes here
    $servername = "localhost";
    $username = "Danjummai";
    $password = "Danjummai@1234";
    $database = "Book";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Check if the email is provided
    if (isset($_GET['email']) && isset($_GET['username'])) {
        $email = $_GET['email'];
        $username = $_GET['username'];
        
        $result = $conn->query("SELECT * FROM LoaneeRecord WHERE email = '$email' AND username = '$username'");
    
        if ($result->num_rows > 0) {
            
            echo "<center>";
            echo "<h1>Loanee Record</h1>";
            echo "</center>";

           // echo "<h2>Loanee Record</h2>";
            echo "<table>";
            echo "<tr><th>User Name</th><th>Password</th><th>First Name</th><th>Surname</th><th>Middle Name</th><th>Email</th><th>Gender</th><th>Phone Number</th><th>Date of Birth</th><th>State of Resident</th><th>State of Origin</th><th>Address Home</th><th>Address Office</th><th>Loan Reason</th><th>Method of Payment</th><th>Passport</th><th>Affirmation</th><th>Account Name</th><th>Account Number</th><th>Bank Name</th></tr>";
    
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["password"] . "</td>";
                echo "<td>" . $row["firstname"] . "</td>";
                echo "<td>" . $row["surname"] . "</td>";
                echo "<td>" . (isset($row["middlename"]) ? $row["middlename"] : "") . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["gender"] . "</td>";
                echo "<td>" . $row["phoneNumber"] . "</td>";
                echo "<td>" . $row["dateOfBirth"] . "</td>";
                echo "<td>" . $row["stateOfRes"] . "</td>";
                echo "<td>" . $row["stateOfOrigin"] . "</td>";
                echo "<td>" . $row["addressHome"] . "</td>";
                echo "<td>" . $row["addressOffice"] . "</td>";
                echo "<td>" . $row["loanReason"] . "</td>";
                echo "<td>" . $row["methodOfPayment"] . "</td>";
                echo "<td>";
                if (isset($row["passport"])) {
                    echo "<img src='ka/images/" . $row["passport"] . "' alt='Passport'>";
                }
                echo "</td>";
                echo "<td>";
                if (isset($row["affirmation"])) {
                    echo "<img src='ka/images/" . $row["affirmation"] . "' alt='Affirmation'>";
                }
                echo "</td>";
                echo "<td>" . $row["accountName"] . "</td>";
                echo "<td>" . $row["accountNumber"] . "</td>";
                echo "<td>" . $row["bankName"] . "</td>";
                echo "</tr>";
            }
    
            echo "</table>";

        } else {
            echo "<center>";
            echo "<p class='error-message'>No record found for email:  $email</p>";           
             echo "</center>";

           
        }
    } else {
        echo "<p>Please provide an email to display records.</p>";
    }

    //Add this link in getUser.php, where appropriate
    //echo "<a href='printRecord.php?email=$email' target='_blank' style='display: inline-block; padding: 10px 20px; background-color: red; color: white; text-decoration: none; border-radius: 5px;'>Print Record</a>";
//echo"<button onclick='window.print()' class='btn btn-primary'>Print this page</button>";



// Assuming $email is the variable containing the email address

// Echo a link with a target='_blank' attribute to open in a new tab/window
echo "<a href='#?email=$email' target='_blank' style='display: inline-block; padding: 10px 20px; background-color: red; color: white; text-decoration: none; border-radius: 5px;'>Print Record</a>";

// Echo a button that triggers the window.print() function
echo "<button onclick='printRecord()' class='btn btn-primary'>Print this page</button>";


    $conn->close();
    ?>

<script>
// JavaScript function to open the printRecord.php in a new tab/window
function printRecord() {
    window.open('#?email=<?php echo $email; ?>', '_blank');
}
</script>

<br>
<br>
<br>
<br>
  <br>
  <br>
  <br>
  <br>
<br>
<br>
<br>
<br>


    <footer>
        <p>&copy; DanjummaiTech2023</p>
        
        <p>Contact us: <a href="mailto:danjict.info.ng">Email Us</a></p>
    </footer>
</div>

</body>
</html>
