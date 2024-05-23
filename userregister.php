<?php
// Database configuration
require_once'dbconnection.php';

// Initialize variables to hold the registration status and login form HTML
$registration_message = "";
$login_form = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    // Validate password match
    if ($password != $confirm_password) {
        $registration_message = "Error: Passwords do not match";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute SQL query to insert user data into the database
        $stmt = $connection->prepare("INSERT INTO users (user_id, username, email, password, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $user_id, $username, $email, $hashed_password, $role);
        
        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error:" . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close connection
$connection->close();
?>
