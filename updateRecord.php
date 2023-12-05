<?php
$servername = "localhost";
$username = "Danjummai";
$password = "Danjummai@1234";
$database = "Book";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_POST['userID']; // Assuming you have a unique identifier for each record, adjust accordingly

    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $middlename = $_POST['middlename'];
    $email = $_POST['email'];
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

    // Assuming your table name is LoaneeRecord, adjust accordingly
    $sql = "UPDATE LoaneeRecord 
            SET firstname = '$firstname', surname = '$surname', middlename = '$middlename', 
            email = '$email', gender = '$gender', phoneNumber = '$phoneNumber', 
            dateOfBirth = '$dateOfBirth', stateOfRes = '$stateOfRes', 
            stateOfOrigin = '$stateOfOrigin', addressHome = '$addressHome', 
            addressOffice = '$addressOffice', loanReason = '$loanReason', 
            methodOfPayment = '$methodOfPayment', accountName = '$accountName', 
            accountNumber = '$accountNumber', bankName = '$bankName' 
            WHERE userID = '$userID'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: dashboard.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
