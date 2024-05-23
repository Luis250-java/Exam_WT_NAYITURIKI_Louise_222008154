<?php
// Database configuration
require_once'dbconnection.php';
// Initialize variables
$pet_id = $name = $species = $breed = $age = $gender = $size = "";

// Check if pet_id is set
if (isset($_REQUEST['id'])) {
    $pet_id = $_REQUEST['id'];

    // Prepare and execute SELECT statement to retrieve pet details
    $stmt = $connection->prepare("SELECT * FROM pets WHERE pet_id = ?");
    $stmt->bind_param("i", $pet_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $species = $row['species'];
        $breed = $row['breed'];
        $age = $row['age'];
        $gender = $row['gender'];
        $size = $row['size'];
    } else {
        echo "Pet not found.";
        exit(); // Exit if the pet is not found
    }
}

// Close the statement
$stmt->close();

// Check if update button is clicked
if (isset($_POST['update'])) {
    // Retrieve updated values from form
    $pet_id = $_POST['pet_id'];
    $name = $_POST['name'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $size = $_POST['size'];

    // Prepare and execute UPDATE statement
    $stmt = $connection->prepare("UPDATE pets SET name=?, species=?, breed=?, age=?, gender=?, size=? WHERE pet_id=?");
    $stmt->bind_param("sssiisi", $name, $species, $breed, $age, $gender, $size, $pet_id);

    if ($stmt->execute()) {
        // Redirect to petstable.php after successful update
        header('Location: petstable.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating pets: " . $stmt->error;
    }
}

// Close the database connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pet</title>
</head>
<body>
    <center>
    <h2>Update Pet Details</h2>
    <form method="POST">
        <input type="hidden" name="pet_id" value="<?php echo $pet_id; ?>">
        
        <label for="name">Pet Name:</label>
        <input type="text" name="name" value="<?php echo $name; ?>">
        <br><br>
        <label for="species">Species:</label>
        <input type="text" name="species" value="<?php echo $species; ?>">
        <br><br>
        <label for="breed">Breed:</label>
        <input type="text" name="breed" value="<?php echo $breed; ?>">
        <br><br>
        <label for="age">Age:</label>
        <input type="number" name="age" value="<?php echo $age; ?>">
        <br><br>
        <label for="gender">Gender:</label>
        <select name="gender">
            <option value="Male" <?php if ($gender == 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($gender == 'Female') echo 'selected'; ?>>Female</option>
        </select>
        <br><br>
        <label for="size">Size:</label>
        <select name="size">
            <option value="Small" <?php if ($size == 'Small') echo 'selected'; ?>>Small</option>
            <option value="Medium" <?php if ($size == 'Medium') echo 'selected'; ?>>Medium</option>
            <option value="Large" <?php if ($size == 'Large') echo 'selected'; ?>>Large</option>
        </select>
        <br><br>
        <input type="submit" name="update" value="Update">
        <input type="reset" name="cancel" value="Cancel">
    </form>
</center>
</body>
</html>
