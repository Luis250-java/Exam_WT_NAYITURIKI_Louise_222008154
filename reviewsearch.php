<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "Adopets database";

// Create connection
require_once 'dbconnection.php';

// Check if the form is submitted with a search query
if (isset($_GET["query"])) {
    // Sanitize the search query to prevent SQL injection
    $search_query = mysqli_real_escape_string($connection, $_GET["query"]);

    // Prepare SQL statement to search for reviews
    $sql = "SELECT * FROM reviews WHERE review_id LIKE '%$search_query%' OR reviewer_name LIKE '%$search_query%' OR reviewed_item_id LIKE '%$search_query%' OR reviewed_item_type LIKE '%$search_query%' OR review_date LIKE '%$search_query%'";

    // Execute the SQL query
    $result = $connection->query($sql);

    // Check if there are any matching records
    if ($result->num_rows > 0) {
        // Output data for each matching record
        echo "<table>
                <tr>
                    <th>Review ID</th>
                    <th>Reviewer Name</th>
                    <th>Reviewer Email</th>
                    <th>Reviewed Item ID</th>
                    <th>Reviewed Item Type</th>
                    <th>Review Date</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['review_id'] . "</td>
                    <td>" . $row['reviewer_name'] . "</td>
                    <td>" . $row['reviewer_email'] . "</td>
                    <td>" . $row['reviewed_item_id'] . "</td>
                    <td>" . $row['reviewed_item_type'] . "</td>
                    <td>" . $row['review_date'] . "</td>
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
