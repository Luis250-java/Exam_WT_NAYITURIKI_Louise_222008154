<?php
// Database configuration
require_once 'dbconnection.php';

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $event_id = $_POST['event_id'];
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $event_location = $_POST['event_location'];
    $event_description = $_POST['event_description'];
    $event_cost = isset($_POST['event_cost']) ? $_POST['event_cost'] : null;

    // Prepare SQL statement
    $sql = "INSERT INTO Events (event_id, event_name, event_date, event_location, event_description, event_cost)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);

    // Bind parameters and execute statement
    $stmt->bind_param("sssssi", $event_id, $event_name, $event_date, $event_location, $event_description, $event_cost);
    if ($stmt->execute()) {
        echo "Event added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
}

// Close connection
$connection->close();
?>