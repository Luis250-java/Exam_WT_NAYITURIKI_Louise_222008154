<?php
// Database configuration
require_once'dbconnection.php';
// Check if shelter_id is set
if (isset($_REQUEST['id'])) {
    $shelter_id = $_REQUEST['id'];

    // Prepare and execute SELECT statement to retrieve shelter details
    $stmt = $connection->prepare("SELECT * FROM Shelters WHERE shelter_id = ?");
    $stmt->bind_param("i", $shelter_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $address = $row['address'];
        $contact_info = $row['contact_info'];
    } else {
        echo "Shelter not found.";
        exit(); // Exit if the shelter is not found
    }
}

// Close the statement
$stmt->close();

// Check if update button is clicked
if (isset($_POST['update'])) {
    // Retrieve updated values from form
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact_info = $_POST['contact_info'];

    // Prepare and execute UPDATE statement
    $stmt = $connection->prepare("UPDATE Shelters SET name=?, address=?, contact_info=? WHERE shelter_id=?");
    $stmt->bind_param("sssi", $name, $address, $contact_info, $shelter_id);

    if ($stmt->execute()) {
        // Redirect to shelterstable.php after successful update
        header('Location: shelterstable.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating shelters: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Shelter</title>
</head>
<body>
    <h2>Update Shelter Details</h2>
    <form method="POST" onsubmit="return confirmUpdate()">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>"><br>

        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo isset($address) ? $address : ''; ?>"><br>

        <label for="contact_info">Contact Information:</label>
        <input type="text" name="contact_info" value="<?php echo isset($contact_info) ? $contact_info : ''; ?>"><br>

        <input type="submit" name="update" value="Update">
        <input type="reset" name="cancel" value="Cancel">
    </form>

    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this shelter?');
        }
    </script>
</body>
</html>

<?php
// Close the database connection
$connection->close();
?>
