<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Admin</title>
</head>
<body>
    <h2>Delete Admin</h2>
    <form method="POST" onsubmit="return confirmDelete();">
        <label for="admin_id">Admin ID:</label>
        <input type="number" name="admin_id" required>
        <br><br>
        <input type="submit" name="delete" value="Delete">
        <input type="reset" name="cancel" value="Cancel">
    </form>

    <?php
    // Establish Database Connection
    require_once 'dbconnection.php';

    // Check if delete button is clicked
    if (isset($_POST['delete'])) {
        // Retrieve admin_id from form
        $admin_id = $_POST['admin_id'];

        // Prepare and execute DELETE statement
        $stmt = $connection->prepare("DELETE FROM admins WHERE admin_id = ?");
        $stmt->bind_param("i", $admin_id);

        if ($stmt->execute()) {
            // Redirect to a success page or back to the page where the deletion was initiated
            header('Location: adminstable.php');
            exit(); // Ensure that no other content is sent after the header redirection
        } else {
            echo "Error deleting admin: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Close the database connection
    $connection->close();
    ?>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this admin?');
        }
    </script>
</body>
</html>
