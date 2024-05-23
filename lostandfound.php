<?php
// Database configuration
require_once 'dbconnection.php';
// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $report_id= $_POST['report_id'];
    $pet_description = $_POST['pet_description'];
    $location = $_POST['location'];
    $report_date = $_POST['report_date'];
    $contact_details = $_POST['contact_details'];
    $status = $_POST['status'];

    // Prepare SQL statement
    $sql = "INSERT INTO Lost_and_Found (report_id, pet_description, location, report_date, contact_details, status)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);

    // Bind parameters and execute statement
    $stmt->bind_param("isssss", $report_id, $pet_description, $location, $report_date, $contact_details, $status);
    if ($stmt->execute()) {
        echo "Report submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
}

// Close connection
$connection->close();
?>