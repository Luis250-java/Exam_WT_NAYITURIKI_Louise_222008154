<?php
// Database configuration
require_once 'dbconnection.php';

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $pet_id= $_POST['pet_id'];
    $name = $_POST['name'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $size = $_POST['size'];

    // Prepare SQL statement
    $sql = "INSERT INTO Pets (pet_id, name, species, breed, age, gender, size)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);

    // Bind parameters and execute statement
    $stmt->bind_param("issssss", $pet_id, $name, $species, $breed, $age, $gender, $size);
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
}

// Close connection
$connection->close();
?>