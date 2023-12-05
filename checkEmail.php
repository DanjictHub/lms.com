<?php
// Include the database connection file
include("aconny.php");

// Check if the connection is successful
if ($conn === null) {
    die("Database connection failed");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    $email = $_POST["email"];

    // Fetch user record based on the email
    $result = $conn->query("SELECT * FROM LoaneeRecord WHERE email = '$email'");

    if ($result === false) {
        die("Error executing query: " . $conn->error);
    }
}

    /*if ($result->num_rows > 0) {
        // Email already registered, redirect to create username and password page
        header("Location: createAccount.php?email=" . urlencode($email));
        exit();
    } else {
        // Email not registered, display a message
        echo "<html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Email Check</title>
                </head>
                <body>";
                
        echo "<div style='color: red; padding-top: 200px; font-size: 20px; text-align: center; margin-top: 20px;'><strong>Email does not exist. Please register.</strong>";

        // Include a button to link to the registration form
        echo "<a href='form.html' style='display: block; margin-top: 20px; text-align: center; text-decoration: none; color: white; background-color:lightseagreen; padding: 10px 20px; border-radius: 5px;'>Click Here to Enroll</a>";

        echo "</div></body></html>";
    }
} 
elseif ($result->num_rows === 0) {
    // Email not registered, proceed to the registration form
    header("Location: createAccount.html");
    
    exit();
    */
    if ($result->num_rows > 0) {
        // Email already registered, display message
        header("Location: thankyou1.html");
    } else {
        // Email not registered, redirect to create account page
        header("Location: register.html?email=$email");
        // header("Location: createAccount.html?email=$email");
        exit();
}

// Close the database connection
$conn->close();
?>
