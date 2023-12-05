<?php

session_start();

$db = new mysqli("localhost", "root", "", "user_auth");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


include 'authentication.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Call the registerUser function from authentication.php
    registerUser($username, $password, $email);
}




if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            echo "Login successful!";
            header("Location: dashboard.php");
        } else {
            //echo "Invalid email or password";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$db->close();
?>
