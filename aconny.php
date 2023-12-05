<?php
$servername = "localhost";
$username = "Danjummai";
$password = "Danjummai@1234";
$database = "Book";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->select_db($database);

$passportUploadSuccess = false;
$affirmationUploadSuccess = false;
$databaseInsertSuccess = false;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        
        $checkEmailQuery = "SELECT userID FROM LoaneeRecord WHERE email = '$email'";
        $result = mysqli_query($conn, $checkEmailQuery);

        if (mysqli_num_rows($result) > 0) {
            // Email already exists, redirect to a page indicating that the email is registered
            header("Location: thankyou1.html");
            exit;
        }

        // Your existing code...
        $firstname = $_POST['firstname'];
        $surname = $_POST['surname'];
        $middlename = $_POST['middlename'];
        $email  = $_POST['email'];
        $gender = $_POST['gender'];
        $phoneNumber = $_POST['phoneNumber'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $stateOfRes = $_POST['stateOfRes']; 
        $stateOfOrigin = $_POST['stateOfOrigin'];
        $addressHome = $_POST['addressHome'];
        $addressOffice = $_POST['addressOffice'];
        $loanReason = $_POST['loanReason'];
        $methodOfPayment = $_POST['methodOfPayment'];
        $accountName = $_POST['accountName'];
        $accountNumber = $_POST['accountNumber'];
        $bankName = $_POST['bankName'];

        $passport = isset($_FILES['passport']) ? $_FILES['passport']['name'] : null;
        $affirmation = isset($_FILES['affirmation']) ? $_FILES['affirmation']['name'] : null;

        // Check if file uploads were successful before proceeding
        if (!empty($_FILES['passport']['tmp_name']) && move_uploaded_file($_FILES['passport']['tmp_name'], "ka/images/" . $passport)) {
            // File upload successful
        } else {
            echo "Passport file upload failed.";
        }

        if (!empty($_FILES['affirmation']['tmp_name']) && move_uploaded_file($_FILES['affirmation']['tmp_name'], "ka/images/" . $affirmation)) {
            // File upload successful
        } else {
            echo "Affirmation file upload failed.";
        }

        // Generate a unique username based on the specified format
        $usernamePrefix = "LMS/" . strtoupper(substr($firstname, 0, 3));
        $timestamp = date("Y") . time(); // Concatenate current year with timestamp
        $username = $usernamePrefix . $timestamp;

        // Rest of your code...

        $sql = "INSERT INTO LoaneeRecord (username, firstname, surname, middlename, email, gender, phoneNumber, dateOfBirth, stateOfRes, stateOfOrigin, addressHome, addressOffice, loanReason, methodOfPayment, passport, affirmation, accountName, accountNumber, bankName) VALUES ('$username', '$firstname', '$surname', '$middlename', '$email', '$gender', '$phoneNumber', '$dateOfBirth', '$stateOfRes', '$stateOfOrigin', '$addressHome', '$addressOffice', '$loanReason', '$methodOfPayment', '$passport', '$affirmation', '$accountName', '$accountNumber', '$bankName')";

        if (mysqli_query($conn, $sql)) {
            // Retrieve the ID of the last inserted record
            $lastInsertedId = mysqli_insert_id($conn);

            // Append the ID to the username
            $username .= "/$lastInsertedId";

            // Update the record with the final username
            $updateSql = "UPDATE LoaneeRecord SET username = '$username' WHERE userID = $lastInsertedId";
            if (mysqli_query($conn, $updateSql)) {
                echo "Username updated successfully";
            } else {
                echo "Error updating username: " . mysqli_error($conn);
            }

            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        //echo "Error: Form not submitted.";
    }
}
header("Location: thankyou.html");





// Close the connection
//$conn->close();
?>
