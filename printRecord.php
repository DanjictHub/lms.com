<?php
// printRecord.php

// Include the database connection file
include("aconny.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the connection is successful
//if ($conn->connect_error) {
   // die("Connection failed: " . $conn->connect_error);
//}
if ($conn === null) {
    die("Database connection failed");
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["email"])) {
    $email = $_GET["email"];

    // Fetch user record based on the email
    $result = $conn->query("SELECT * FROM LoaneeRecord WHERE email = '$email'");

    if ($result === false) {
        die("Error executing query: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        // Output the record in a printable format (e.g., HTML)
        echo "<html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Print User Record</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                        }
                        h1 {
                            color: #333;
                        }
                        table {
                            border-collapse: collapse;
                            width: 100%;
                            margin-top: 20px;
                            background-color: #fff;
                        }
                        th, td {
                            border: 1px solid #ddd;
                            padding: 10px;
                            text-align: left;
                        }
                        th {
                            background-color: #f2f2f2;
                        }

                        /* Print-specific styles */
                        @media print {
                            body {
                                margin: 0;
                                padding: 10mm; /* Adjust as needed for your layout */
                            }
                            table {
                                width: 100%;
                                page-break-before: always; /* Start a new page for each table */
                            }
                        }
                    </style>
                </head>
                <body>";

        echo "<h1>User Record for Email: $email</h1>";
        echo "<table>
                <tr>
                    <th>User Name</th><th>Password</th><th>First Name</th><th>Surname</th>
                    <th>Middle Name</th><th>Email</th><th>Gender</th><th>Date of Birth</th>
                    <th>State of Resident</th><th>State of Origin</th><th>Address Home</th>
                    <th>Address Office</th><th>Loan Reason</th><th>Method of Payment</th>
                    <th>Passport</th><th>Affirmation</th><th>Account Name</th><th>Account Number</th>
                    <th>Bank Name</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["password"] . "</td>";
            echo "<td>" . $row["firstname"] . "</td>";
            echo "<td>" . $row["surname"] . "</td>";
            echo "<td>" . (isset($row["middlename"]) ? $row["middlename"] : "") . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["gender"] . "</td>";
            echo "<td>" . $row["dateOfBirth"] . "</td>";
            echo "<td>" . $row["stateOfRes"] . "</td>";
            echo "<td>" . $row["stateOfOrigin"] . "</td>";
            echo "<td>" . $row["addressHome"] . "</td>";
            echo "<td>" . $row["addressOffice"] . "</td>";
            echo "<td>" . $row["loanReason"] . "</td>";
            echo "<td>" . $row["methodOfPayment"] . "</td>";
            echo "<td>" . $row["passport"] . "</td>";
            echo "<td>" . $row["affirmation"] . "</td>";
            echo "<td>" . $row["accountName"] . "</td>";
            echo "<td>" . $row["accountNumber"] . "</td>";
            echo "<td>" . $row["bankName"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "</body></html>";
    } else {
        echo "<p>No record found for email: $email</p>";
    }
} else {
    echo "<p>Invalid request</p>";
}

// Close the database connection
$conn->close();
?>
