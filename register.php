<?php
$db = new mysqli("localhost", "root", "", "user_auth");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


include 'authentication.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Call the registerUser function from authentication.php
    registerUser($username, $password, $email);
}





if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST['submit'])) {
        
        $checkEmailQuery = "SELECT userID FROM LoaneeRecord WHERE email = '$email'";
        $result = mysqli_query($conn, $checkEmailQuery);

        if (mysqli_num_rows($result) > 0) {
            // Email already exists, redirect to a page indicating that the email is registered
            header("Location: thankyou1.html");
            exit;
        }
    }

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "Registration successful!";
        header("Location: accountSuccess.html");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

//$db->close();
?>
