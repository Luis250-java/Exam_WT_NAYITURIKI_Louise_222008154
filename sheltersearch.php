<?php
// Database connection
require_once 'dbconnection.php';
// Check if the form is submitted with a search query
if (isset($_GET["query"])) {
    // Sanitize the search query to prevent SQL injection
    $search_query = mysqli_real_escape_string($connection, $_GET["query"]);

    // Prepare SQL statement to search for shelters
    $sql = "SELECT * FROM Shelters WHERE shelter_id LIKE '%$search_query%' OR name LIKE '%$search_query%' OR contact_info LIKE '%$search_query%'";

    // Execute the SQL query
    $result = $connection->query($sql);

    // Check if there are any matching records
    if ($result->num_rows > 0) {
        // Output data for each matching record
        echo "<table>
                <tr>
                    <th>Shelter ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Contact Information</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['shelter_id'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['address'] . "</td>
                    <td>" . $row['contact_info'] . "</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "No matching records found";
    }
}

// Close the database connection
$connection->close();
?>
