<?php
// Database configuration
require_once 'dbconnection.php';
// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_id = $_POST['admin_id'];
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name']; // Fix here: Use 'last_name' instead of 'username'
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    
    // SQL query for inserting data into the admins table
    $sql = "INSERT INTO admins (admin_id, username, password, first_name, last_name, email, gender) 
            VALUES ('$admin_id', '$username', '$hashed_password', '$first_name', '$last_name', '$email', '$gender')";

    if ($connection->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

$connection->close();
?>
