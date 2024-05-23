<?php
// Database configuration
require_once 'dbconnection.php;'
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $donation_id = $_POST['donation_id'];
    $donor_name = $_POST['donor_name'];
    $donor_contacts = $_POST['donor_contacts'];
    $donation_type = $_POST['donation_type'];
    $donation_amount = $_POST['donation_amount'];
    $donation_date = $_POST['donation_date'];

    // Prepare SQL statement
    $sql = "INSERT INTO Donations (donation_id, donor_name, donor_contacts, donation_type, donation_amount, donation_date)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters and execute statement
    $stmt->bind_param("isssss", $donation_id, $donor_name, $donor_contacts, $donation_type, $donation_amount, $donation_date);
    if ($stmt->execute()) {
        echo "Donation recorded successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
}

// Close connection
$conn->close();
?>