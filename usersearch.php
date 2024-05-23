<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users Records</title>
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
<div style="margin-left: 500px;"><form action="usersearch.php" method="GET">
      <input type="search" name="query" placeholder="Search here">&nbsp;&nbsp;&nbsp;<button type="submit" style="background-color: blue;width: 100px;">Search</button>
    </form></div>
<hr>
    <center>
    <h2><i>Users Records</i></h2>
    </center>
    <table>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Role</th>
        </tr>
        <?php<?php
// Database connection
require_once'dbconnection.php';

// Check if the form is submitted with a search query
if (isset($_GET["query"])) {
    // Sanitize the search query to prevent SQL injection
    $search_query = mysqli_real_escape_string($connection, $_GET["query"]);

    // Prepare SQL statement to search for users
    $sql = "SELECT * FROM Users WHERE user_id LIKE '%$search_query%' OR username LIKE '%$search_query%'";

    // Execute the SQL query
    $result = $connection->query($sql);

    // Check if there are any matching records
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['user_id'] . "</td>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['password'] . "</td>
                    <td>" . $row['role'] . "</td>
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
