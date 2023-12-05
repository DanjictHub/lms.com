<?php
$servername = "localhost";
$username = "Danjummai";
$password = "Danjummai@1234";
$database = "Book";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assume you have a way to get the userID, for example from the URL parameter
$userID = isset($_GET['userID']) ? $_GET['userID'] : null; // Ensure to sanitize and validate this input

if (!$userID) {
    echo "User ID not provided";
    exit; // You may want to handle this case differently based on your application's logic
}

// Fetch the user data from the database
$sql = "SELECT * FROM LoaneeRecord WHERE userID = '$userID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    echo "User not found";
    exit; // You may want to handle this case differently based on your application's logic
}

//$conn->close();
?>

<!-- Now render the HTML form -->
<form method="post" action="updateRecord1.php" enctype="multipart/form-data">
    <?php
    // Check if the user ID is set in the URL
    if (isset($_GET['userID'])) {
        $userID = $_GET['userID'];
        echo '<input type="hidden" name="userID" value="' . $userID . '">';
        
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
    echo "User ID: " . $userID; // Add this line for debugging

    ?>

    <!-- Populate other form fields with user data -->
    <div>
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" id="firstname" value="<?php echo $userData['firstname']; ?>">
    </div>
    <!-- Repeat for other fields -->

    <input style="color: purple; background-color: darkorange; font-family: monospace; font-weight: bold;" type="submit" name="submit" value="Submit Application">
</form>
