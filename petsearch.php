<?php
// Database connection
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

// Check if the form is submitted with a search query
if (isset($_GET["query"])) {
    // Sanitize the search query to prevent SQL injection
    $search_query = mysqli_real_escape_string($conn, $_GET["query"]);

    // Prepare SQL statement to search for pets
    $sql = "SELECT * FROM Pets WHERE name LIKE '%$search_query%' OR species LIKE '%$search_query%' OR breed LIKE '%$search_query%' OR age LIKE '%$search_query%' OR gender LIKE '%$search_query%' OR size LIKE '%$search_query%'";

    // Execute the SQL query
    $result = $conn->query($sql);

    // Check if there are any matching records
    if ($result->num_rows > 0) {
        // Output data for each matching record
        echo "<table>
                <tr>
                    <th>Pet ID</th>
                    <th>Pet Name</th>
                    <th>Species</th>
                    <th>Breed</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Size</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['pet_id'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['species'] . "</td>
                    <td>" . $row['breed'] . "</td>
                    <td>" . $row['age'] . "</td>
                    <td>" . $row['gender'] . "</td>
                    <td>" . $row['size'] . "</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No matching records found";
    }
}

// Close the database connection
$conn->close();
?>
