        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adoption Process Records</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: lightblue;
            color: black;
            font-size: 15px;
        }
    </style>
</head>
<body> 
<div style="margin-left: 500px;"><form action="adoptionsearch.php" method="GET">
      <input type="search" name="query" placeholder="Search here">&nbsp;&nbsp;&nbsp;<button type="submit" style="background-color: blue;width: 100px;">Search</button>
    </form></div>
<hr>
    <center>
    <h2><i>Adoption Process Records</i></h2>
    </center>
    <table>
        <tr>
            <th>Application id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone </th>
            <th>Address</th>
            <th>Pet Name</th>
            <th>Reason for Adoption</th>
            <th>Submission Date</th>
        </tr>
<?php
// Establish Database Connection
require_once 'dbconnection.php';
// Check if search query parameter is set
if(isset($_GET['query']) && !empty($_GET['query'])) {
    // Sanitize the search query to prevent SQL injection
    $search_query = $connection->real_escape_string($_GET['query']);

    // Prepare SQL query to retrieve Adoption Process records matching the search query
    $sql = "SELECT * FROM adoption_applications WHERE name LIKE '%$search_query%' OR email LIKE '%$search_query%' OR phone LIKE '%$search_query%' OR address LIKE '%$search_query%' OR pet_name LIKE '%$search_query%' OR reason_for_adoption LIKE '%$search_query%' OR submission_date LIKE '%$search_query%'";
} else {
    // If search query is not provided, retrieve all Adoption Process records
    $sql = "SELECT * FROM adoption_applications";
}

$result = $connection->query($sql);

// Check if there are any records
if ($result->num_rows > 0) {
    // Output data for each record
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row['application_id'] . "</td>
            <td>" . $row['name'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['phone'] . "</td>
            <td>" . $row['address'] . "</td>
            <td>" . $row['pet_name'] . "</td>
            <td>" . $row['reason_for_adoption'] . "</td>
            <td>" . $row['submission_date'] . "</td>
            <td style='background-color:pink'><a style='padding:4px' href='deleteadoption.php?id=" . $row['application_id'] . "'>Delete</a></td> 
            <td style='background-color:skyblue;'><a style='padding:4px' href='updateadoption.php?id=" . $row['application_id'] . "'>Update</a></td> 
        </tr>";
    }
} else {
    echo "<tr><td colspan='9'>No records found</td></tr>";
}

// Close the database connection
$connection->close();
?>
