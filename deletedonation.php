<?php
// Database configuration
require_once 'dbconnection.php';

// Check if delete button is clicked
if (isset($_POST['delete'])) {
    // Perform the deletion
    $stmt = $connection->prepare("DELETE FROM Donations WHERE donation_id = ?");
    $stmt->bind_param("i", $_POST['donation_id']);

    if ($stmt->execute()) {
        // Redirect to a success page or back to the page where the deletion was initiated
        header('Location: donationstable.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error deleting donation: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Donation</title>
</head>
<body>
    <h2>Delete Donation</h2>
    <form method="POST">
        <label for="donation_id">Donation ID:</label>
        <input type="number" name="donation_id" value="">
        <br><br>
        <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure you want to delete this donation?')">
        <input type="reset" name="cancel" value="Cancel">
    </form>
</body>
</html>
