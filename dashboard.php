<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Fetch user data from the database based on the logged-in user's user_id
$db = new mysqli("localhost", "root", "", "user_auth");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$user_id = $_SESSION['user_id'];
$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Display user information on the dashboard
        ?>
        <html lang="en">
        <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="icon" type="image/png" href="favicon.png">
  <link rel="shortcut icon" type="image/x-icon" href="/adminTheme/img/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    /* Basic styles for the side navigation bar */
    body {
      margin: 5px;
      padding: 0;
      font-size: 16px;
      font-family: Arial, sans-serif;
      background-color: lightseagreen;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* Tablet styles */
@media only screen and (max-width: 768px) {
    body {
        font-size: 14px;
    }
}

/* Phone styles */
@media only screen and (max-width: 480px) {
    body {
        font-size: 12px;
    }
}
/* Styles for the side navigation bar */
.sidenav {
      height: 100%;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      background-color: whitesmoke;
      padding-top: 15px;
      display: flex;
      flex-direction: column;
    }

    .sidenav a {
      padding: 20px;
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

    /* Content container */
    .content {
      margin-left: 250px;
      padding: 20px;
    }

 form {
        max-width: 800px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 10px;
        background-color: #f8f8f8;
        padding: 20px;
        border-radius: 5px;
    }

    form div {
        display: grid;
        grid-template-columns: 100px 1fr;
        align-items: center;
    }

    form label {
        font-weight: bold;
    }

    form input[type="submit"] {
        grid-column: span 2;
        padding: 10px;
        background-color: darkorange;
        color: purple;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    /* Footer styles */
    footer {
      /*background-color: gainsboro;*/
       background-image: url('main2.jpeg') ;
/*background-image: url(download.jpg);*/
            height: 10vh;
            background-position: top;
            background-size: auto;

font-weight: bold;
font-family: monospace;
      padding: 10px;
      padding-bottom: 100px;
      margin: 5px;
      text-align: center; /* Adjusted positioning */
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

#dr{
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

#rea {
        max-width: 800px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 10px;
        background-color: #f8f8f8;
        padding: 20px;
        border-radius: 5px;
    }

 
.cta {
    background-color: lightseagreen;
    color: white;
    text-align: center;
    padding: 60px 0;
}
.btn {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    text-decoration: none;
    color: white;
    background-color: #333;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #555;
}

</style>
            <!-- Add your head content here -->
        </head>
        <body>
            <div class="sidenav">
                <!--<div class="sidenav"> -->
   <img src="main2.jpeg"width="240" height="50" alt="image">
    <a href="landingPage.html"><i class="fas fa-home"></i> Home</a>
    <a href="form.html"><i class="fas fa-tachometer-alt"></i>Loan Form</a>
    <a href="updateRecord.html"><i class="fas fa-user"></i>Edit Profile</a>
    <a href="#print"> <i class="fas fa-print"></i> Print Loan Slip </a>
    <a href="getUser.html"><i class="fas fa-check"></i> Check loan Status</a>
    <a href="#"><i class="fas fa-envelope"></i> My Documents</a>
    <a href="#settings"><i class="fas fa-cog"></i> Settings</a>
  </div>
            </div>

            <h1 style="padding-left: 500px; color: darkred;">Welcome, <?php echo htmlspecialchars($user["username"]); ?>!</h1>
            <p>Email: <?php echo htmlspecialchars($user["email"]); ?></p>


            <section class="cta">
                <div class="container">
                    <div class="container">

 
                    </div>
                    <h2>End Session</h2>
                    <a href="logout.php" class="btn">LogOut</a>
                </div>
            </section>
         


            <!-- Footer -->
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
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            
            <footer>
                <p>&copy; Group 2 2023</p>
                <p>Contact us: <a href="mailto:danjict.info.ng">Email Us</a></p>
            </footer>
        </body>
        </html>
        <?php
    } else {
        echo "Error fetching user data.";
    }
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and database connection
$stmt->close();
$db->close();
?>
