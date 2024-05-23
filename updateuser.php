<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>
    <?php
    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "Adopets database";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if user_id is set
    if (isset($_REQUEST['id'])) {
        $user_id = $_REQUEST['id'];

        // Prepare and execute SELECT statement to retrieve user details
        $stmt = $conn->prepare("SELECT * FROM Users WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];
            $username = $row['username'];
            $email = $row['email'];
            // Add other attributes here
        } else {
            echo "User not found.";
            exit(); // Exit if the user is not found
        }
    }

    // Close the statement
    $stmt->close();
    ?>

    <h2>Update User Details</h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>" readonly>

        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo isset($username) ? $username : ''; ?>">
        <br><br>
        <input type="submit" name="update" value="Update">
        <input type="reset" name="cancel" value="Cancel">
    </form>

    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this user?');
        }
    </script>

    <?php
    // Check if update button is clicked
    if (isset($_POST['update'])) {
        // Retrieve updated values from form
        $user_id = $_POST['user_id'];
        $username = $_POST['username'];
        // Retrieve other updated attributes here

        // Prepare and execute UPDATE statement
        $stmt = $conn->prepare("UPDATE Users SET username=? WHERE user_id=?");
        $stmt->bind_param("si", $username, $user_id);

        if ($stmt->execute()) {
            // Redirect to userstable.php after successful update
            header('Location: userstable.php');
            exit(); // Ensure that no other content is sent after the header redirection
        } else {
            echo "Error updating user details: " . $stmt->error;
        }
    }
    ?>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
