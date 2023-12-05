<?php
// register1.php
$servername = "localhost";
$username = "Danjummai";
$password = "Danjummai@1234";
$database = "Book";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->select_db($database);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Include your database connection file
   // include("aconny.php");

    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($checkEmailQuery);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        die("Error checking email: " . $stmt->error);
    }

    if ($result->num_rows > 0) {
        // Email already registered
        // Redirect or display an error message
        header("Location: emailExist.html");

       // header("Location: login.html?error=email_exist");
        exit();
    }

    // Check if the username already exists
    $checkUsernameQuery = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($checkUsernameQuery);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        die("Error checking username: " . $stmt->error);
    }

    if ($result->num_rows > 0) {
        // Username already registered
        // Redirect or display an error message
        header("Location: usernameExist.html");

        //header("Location: login.html?error=username_exist");
        exit();
    }

    // If neither email nor username exists, proceed to insert into the database
    $insertQuery = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bind_param("sss", $username, $hashedPassword, $email);

    if ($stmt->execute()) {
        // Insert successful
        // Redirect to login.html or any other page
        header("Location: login.html");
        exit();
    } else {
        // Insert failed
        die("Error inserting data: " . $stmt->error);
    }

    // Close the statement
    $stmt->close();
} else {
    // Invalid request
    echo "Invalid request";
}

// Close the database connection
$conn->close();
?>
