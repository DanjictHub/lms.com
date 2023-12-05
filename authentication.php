<?php

$servername = "localhost";
$username = "Danjummai";
$password = "Danjummai@1234";
$database = "user_auth";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->select_db($database);

function registerUser($username, $password, $email) {
    global $conn;

    // Check if the user already exists
    $checkUserQuery = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = $conn->query($checkUserQuery);

    if ($result->num_rows > 0) {
        echo "User already exists.";
    } else {
        // Hash the password before storing in the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into the database
        $insertUserQuery = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashedPassword', '$email')";
        if ($conn->query($insertUserQuery) === TRUE) {
            echo "Registration successful.";
        } else {
            echo "Error: " . $insertUserQuery . "<br>" . $conn->error;
        }
    }
}

function loginUser($username, $password) {
    global $conn;

    // Check if the user exists
    $checkUserQuery = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($checkUserQuery);

    if ($result->num_rows > 0) {
        // Verify the password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            echo "Login successful.";
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
}

// Example usage:
// registerUser("john_doe", "password123", "john@example.com");
// loginUser("john_doe", "password123");

//$conn->close();
?>
