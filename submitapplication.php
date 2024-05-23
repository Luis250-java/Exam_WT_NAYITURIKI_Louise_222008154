<?php

// Database credentials
require_once 'dbconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
    $id= $_POST["application_id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $pet_name = $_POST["pet_name"];
    $reason_for_adoption = $_POST["reason_for_adoption"];
    $submission_date = $_POST["submission_date"];
{
        // Prepare SQL statement
        $stmt = $connection->prepare("INSERT INTO adoption_applications (application_id, name, email, phone, address, pet_name, reason_for_adoption, submission_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssi",  $application_id, $name, $email, $phone, $address, $pet_name, $reason_for_adoption, $submission_date);

        // Execute SQL statement
        if ($stmt->execute()) {
            echo "<h2>Thank You for Submitting Your Application!</h2>";
            echo "<p>Your application has been successfully submitted.</p>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement and database connection
        $stmt->close();
        $connection->close();
    }
}
?>
