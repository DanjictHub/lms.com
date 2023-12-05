<?php
// Output the URL parameters for debugging
echo '<pre>';
print_r($_GET);
echo '</pre>';

$servername = "localhost";
$username = "Danjummai";
$password = "Danjummai@1234";
$database = "Book";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if userID is set in the URL
if (isset($_GET['userID'])) {
    // Assume you have a way to get the userID, for example from the URL parameter
    $userID = $_GET['userID']; // Ensure to sanitize and validate this input

    // Fetch the user data from the database
    $sql = "SELECT * FROM LoaneeRecord WHERE userID = '$userID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
    } else {
        echo "User not found";
        exit; // You may want to handle this case differently based on your application's logic
    }
} else {
    echo "User ID not provided";
    exit; // You may want to handle this case differently based on your application's logic
}

$conn->close();
?>

<!-- Now render the HTML form -->
<form method="post" action="updateRecord1.php" enctype="multipart/form-data">
    <input type="hidden" name="userID" value="<?php echo $userID; ?>">

    <!-- Populate other form fields with user data -->
    <div>
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" id="firstname" value="<?php echo $userData['firstname']; ?>">
    </div>
    <!-- Repeat for other fields -->

    <input style="color: purple; background-color: darkorange; font-family: monospace; font-weight: bold;" type="submit" name="submit" value="Submit Application">
</form>
