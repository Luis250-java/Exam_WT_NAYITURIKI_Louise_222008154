<?php
// Database configuration
require_once 'dbconnection.php';

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $reviewer_name = $_POST['reviewer_name'];
    $reviewer_email = $_POST['reviewer_email'];
    $reviewed_item_id = $_POST['reviewed_item_id'];
    $reviewed_item_type = $_POST['reviewed_item_type'];
    $review_date = $_POST['review_date'];

    // Prepare SQL statement
    $sql = "INSERT INTO Reviews (reviewer_name, reviewer_email, reviewed_item_id, reviewed_item_type, review_date)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);

    // Bind parameters and execute statement
    $stmt->bind_param("ssiss", $reviewer_name, $reviewer_email, $reviewed_item_id, $reviewed_item_type, $review_date);
    if ($stmt->execute()) {
        echo "Review submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
}

// Close connection
?>