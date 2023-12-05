<?php
    // Check if the user ID is set in the URL
    if (isset($_GET['username'])) {
        $userID = $_GET['username'];
        echo '<input type="hidden" name="username" value="' . $username . '">';
        
        // Fetch the user data from the database
        $sql = "SELECT * FROM LoaneeRecord WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $userData = $result->fetch_assoc();

        } else {
        echo "User ID not provided";
        header("Location: dashboard.php");

        
        exit; // You may want to handle this case differently based on your application's logic
    }
    echo "User Name: " . $username; // Add this line for debugging
}

    ?>
