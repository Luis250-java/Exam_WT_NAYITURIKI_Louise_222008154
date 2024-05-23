<?php
// Database configuration
require_once 'dbconnection.php';

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

// Check if delete button is clicked
if (isset($_POST['delete'])) {
    // Prepare and execute DELETE statement
    $stmt = $conn->prepare("DELETE FROM Shelters WHERE shelter_id = ?");
    $stmt->bind_param("i", $shelter_id);

    if ($stmt->execute()) {
        // Redirect to shelterstable.php after successful deletion
        header('Location: shelterstable.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error deleting shelter: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Shelter</title>
</head>
<body>
    <h2>Delete Shelter</h2>
    <p>Are you sure you want to delete the shelter "<?php echo $name; ?>"?</p>
    <form method="POST">
        <input type="submit" name="delete" value="Delete">
        <a href="shelterstable.php">Cancel</a>
    </form>
</body>
</html>

<?php
// Close the database connection
$connection->close();
?>
