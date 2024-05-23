<?php

// Establish Database Connection
require_once 'dbconnection.php';

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement with a placeholder for the username
    $sql = "SELECT user_id, password FROM users WHERE username=?";
    
    // Prepare the SQL statement to prevent SQL injection
    $stmt = $connection->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $connection->error);
    }

    // Bind the username parameter to the prepared statement
    $stmt->bind_param("s", $username);

    // Execute the prepared statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if a row was returned
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verify the password using password_verify
        if (password_verify($password, $row['password'])) {
            // Set session variable and redirect upon successful login
            session_start();
            $_SESSION['user_id'] = $row['id'];
            header("Location: home.html");
            exit();
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "User not found";
    }

    // Close prepared statement
    $stmt->close();
}

// Close database connection
$connection->close();
?>