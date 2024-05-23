<?php

// Establish Database Connection
require_once'dbconnection.php';

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $pet_name = $_POST["pet_name"];
    $reason_for_adoption = $_POST["reason_for_adoption"];

    // You can perform further validation and processing here
    
    // For demonstration purposes, let's just display the submitted data
    echo "<h2>Thank You for Submitting Your Application!</h2>";
    echo "<p><strong>Full Name:</strong> $name</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Phone Number:</strong> $phone</p>";
    echo "<p><strong>Address:</strong> $address</p>";
    echo "<p><strong>Pet Name:</strong> $pet_name</p>";
    echo "<p><strong>Reason for Adoption:</strong> $reason_for_adoption</p>";
} else {
    // If the form is not submitted, you can redirect or display a message
    echo "<h2>Error: Form not submitted.</h2>";
}
?>
