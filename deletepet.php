<?php
// Database configuration
require_once 'dbconnection.php';

// Check if delete button is clicked
if (isset($_POST['delete'])) {
    // Perform the deletion
    $stmt = $connection->prepare("DELETE FROM pets WHERE pet_id = ?");
    $stmt->bind_param("i", $_POST['pet_id']);

    if ($stmt->execute()) {
        // Redirect to petstable.php after successful deletion
        header('Location: petstable.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error deleting pet: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Pet</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <form method="POST">
        <label for="pet_id">Pet ID:</label>
        <input type="number" name="pet_id" value="">
        <br><br>
        <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure you want to delete this pet?')">
        <input type="reset" name="cancel" value="Cancel">
    </form>
</body>
</html>
