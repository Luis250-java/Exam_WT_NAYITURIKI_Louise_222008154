<?php
// Database configuration
require_once 'dbconnection.php';

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $pet_id = $_POST['pet_id'];
    $vaccination_records = $_POST['vaccination_records'];
    $spaying_neutering_status = $_POST['spaying_neutering_status'];
    $medical_conditions = $_POST['medical_conditions'];
    $medications = $_POST['medications'];
    $veterinary_visits = $_POST['veterinary_visits'];

    // Prepare SQL statement
    $sql = "INSERT INTO Medical_Records (pet_id, vaccination_records, spaying_neutering_status, medical_conditions, medications, veterinary_visits)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);

    // Bind parameters and execute statement
    $stmt->bind_param("isssss", $pet_id, $vaccination_records, $spaying_neutering_status, $medical_conditions, $medications, $veterinary_visits);
    if ($stmt->execute()) {
        echo "Medical record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
}

// Close connection
$connection->close();
?>