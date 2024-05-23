<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Volunteer</title>
</head>
<body>
    <h2>Delete Volunteer</h2>
    <form method="POST">
        <label for="volunteer_id">Volunteer ID:</label>
        <input type="number" name="volunteer_id" required>
        <br><br>
        <br><br>
        <input type="submit" name="delete" value="Delete">
        <input type="reset" name="cancel" value="Cancel">
    </form>

    <?php
    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "Adopets database";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Check if delete button is clicked
    if (isset($_POST['delete'])) {
        // Retrieve volunteer_id and interests from form
        $volunteer_id = $_POST['volunteer_id'];

        // Prepare and execute DELETE statement
        $stmt = $connection->prepare("DELETE FROM Volunteers WHERE volunteer_id = ?");
        $stmt->bind_param("i", $volunteer_id);

    if ($stmt->execute()) {
        // Redirect to a success page or back to the page where the deletion was initiated
        header('Location: volunteerstable.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error deletingvolunteer: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}


    // Close the database connection
    $connection->close();
    ?>
</body>
</html>
