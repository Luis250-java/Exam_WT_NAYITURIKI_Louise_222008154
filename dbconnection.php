<?php  
$servername = "localhost";
$username = "louise";
$password = "222008154";
$dbname = "Adopets database";  // Ensure the database name is correct

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
