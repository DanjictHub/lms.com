<?php
// Include your connection file (aconny.php)
include 'aconny.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the POST request
    $id = $_POST['id'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Add your password creation logic here (hashing, validation, etc.)
    if ($password !== $confirmPassword) {
        echo "Error: Passwords do not match.";
        exit;
    }

    // Update the database with the hashed password (replace with your actual update query)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $updateQuery = "UPDATE loaneeRecord SET password = '$hashedPassword' WHERE id = $id";

    // Execute the query
    if (mysqli_query($conn, $updateQuery)) {
        // Redirect to thank you page
        header("Location: aconny.php");
        exit;
    } else {
        echo "Error updating password: " . mysqli_error($conn);
    }

} else {
    echo "Error: Form not submitted.";
}

// Close the connection
//$conn->close();
?>
