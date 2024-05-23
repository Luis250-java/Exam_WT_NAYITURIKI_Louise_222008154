<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Volunteer</title>
</head>
<body>
    <?php
    // Database configuration
    require_once'dbconnection.php';

    // Check if volunteer_id is set
    if (isset($_REQUEST['id'])) {
        $volunteer_id = $_REQUEST['id'];

        // Prepare and execute SELECT statement to retrieve volunteer details
        $stmt = $connection->prepare("SELECT * FROM Volunteers WHERE volunteer_id = ?");
        $stmt->bind_param("i", $volunteer_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $volunteer_id = $row['volunteer_id'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $phone_number = $row['phone_number'];
            $interests = $row['interests'];
        } else {
            echo "Volunteer not found.";
            exit(); // Exit if the volunteer is not found
        }
    }

    // Close the statement
    $stmt->close();
    ?>
    <center>
    <h2>Update Volunteer Details</h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="volunteer_id">Volunteer ID:</label>
        <input type="number" name="volunteer_id" value="<?php echo isset($volunteer_id) ? $volunteer_id : ''; ?>" readonly>

        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" value="<?php echo isset($first_name) ? $first_name : ''; ?>">

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="<?php echo isset($last_name) ? $last_name : ''; ?>">

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" value="<?php echo isset($phone_number) ? $phone_number : ''; ?>">
        <br><br>

        <label for="interests">Interests:</label>
        <input type="text" name="interests" value="<?php echo isset($interests) ? $interests : ''; ?>">
        <br><br>
        <input type="submit" name="update" value="Update">
        <input type="reset" name="cancel" value="Cancel">
    </form>
    </center>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this volunteer?');
        }
    </script>

    <?php
    // Check if update button is clicked
    if (isset($_POST['update'])) {
        // Retrieve updated values from form
        $volunteer_id = $_POST['volunteer_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone_number = $_POST['phone_number'];
        $interests = $_POST['interests'];

        // Prepare and execute UPDATE statement
        $stmt = $connection->prepare("UPDATE Volunteers SET first_name=?, last_name=?, phone_number=?, interests=? WHERE volunteer_id=?");
        $stmt->bind_param("ssssi", $first_name, $last_name, $phone_number, $interests, $volunteer_id);

        if ($stmt->execute()) {
            // Redirect to volunteerstable.php after successful update
            header('Location: volunteerstable.php');
            exit(); // Ensure that no other content is sent after the header redirection
        } else {
            echo "Error updating volunteer details: " . $stmt->error;
        }
    }
    ?>

</body>
</html>

<?php
// Close the database connection
$connection->close();
?>
