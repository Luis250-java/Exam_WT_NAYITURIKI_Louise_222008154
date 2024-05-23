<?php
// Database connection
require_once'dbconnection.php';
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the form is submitted with a search query
if (isset($_GET["query"])) {
    // Sanitize the search query to prevent SQL injection
    $search_query = mysqli_real_escape_string($connection, $_GET["query"]);

    // Prepare SQL statement to search for volunteers
    $sql = "SELECT * FROM Volunteers WHERE volunteer_id LIKE '%$search_query%' OR first_name LIKE '%$search_query%'";

    // Execute the SQL query
    $result = $connection->query($sql);

    // Check if there are any matching records
    if ($result->num_rows > 0) {
        // Output data for each matching record
        echo "<table>
                <tr>
                    <th>Volunteer ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone number</th>
                    <th>Interests</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['volunteer_id'] . "</td>
                    <td>" . $row['first_name'] . "</td>
                    <td>" . $row['last_name'] . "</td>
                    <td>" . $row['phone_number'] . "</td>
                    <td>" . $row['interests'] . "</td>
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
