<?php
// Database configuration
require_once 'dbconnection.php';

// Check if delete button is clicked
if (isset($_POST['up'])) {
    // Perform the deletion
    $stmt = $connection->prepare("DELETE FROM Lost_and_Found WHERE report_id = ?");
    $stmt->bind_param("i", $_POST['report_id']);

    if ($stmt->execute()) {
        // Redirect to lostandfoundtable.php after successful deletion
        header('Location: lostandfoundtable.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error deleting report: " . $stmt->error;
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
    <title>Delete Lost and Found Report</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <form method="POST">
        <label for="report_id">Report ID:</label>
        <input type="number" name="report_id" value="">
        <br><br>
        <input type="submit" name="up" value="Delete" onclick="return confirm('Are you sure you want to delete this report?')">
        <input type="reset" name="cn" value="Cancel">
    </form>
</body>
</html>
