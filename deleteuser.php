<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Volunteer</title>
</head>
<body>
    <h2>Delete User</h2>
    <form method="POST">
        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" required>
        <br><br>
        <br><br>
        <input type="submit" name="delete" value="Delete">
        <input type="reset" name="cancel" value="Cancel">
    </form>

    <?php
    // Database configuration
   require_once 'dbconnection.php';

    // Check if delete button is clicked
    if (isset($_POST['delete'])) {
        // Retrieve volunteer_id and interests from form
        $user_id = $_POST['user_id'];

        // Prepare and execute DELETE statement
        $stmt = $connection->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            echo "Volunteer deleted successfully";
        } else {
            echo "Error deleting volunteer: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Close the database connection
    $connection->close();
    ?>
</body>
</html>
