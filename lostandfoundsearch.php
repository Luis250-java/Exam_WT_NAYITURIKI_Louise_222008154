<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lost and Found Records</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: indigo;
            color: white;
            font-size: 15px;
        }
    </style>
</head>
<body> 
<div style="margin-left: 500px;"><form action="lostandfoundsearch.php" method="GET">
      <input type="search" name="query" placeholder="search here!!!!!!!">&nbsp;&nbsp;&nbsp;<button type="submit" style="background-color: blue;width: 100px;">search</button>
    </form></div>
<hr>
    <center>
    <h2><i>Lost and Found Records</i></h2>
    </center>
    <table>
        <tr>
            <th>Report ID</th>
            <th>Pet Description</th>
            <th>Location</th>
            <th>Report Date</th>
            <th>Contact Details</th>
            <th>Status</th>
        </tr><?php
    // Establish Database Connection
   require_once 'dbconnection.php';

    // Check if search query parameter is set
    if(isset($_GET['query']) && !empty($_GET['query'])) {
        // Sanitize the search query to prevent SQL injection
        $search_query = $connection->real_escape_string($_GET['query']);

        // Prepare SQL query to retrieve Lost and Found records matching the search query
        $sql = "SELECT * FROM Lost_and_Found WHERE report_id LIKE '%$search_query%' OR location LIKE '%$search_query%' OR report_date LIKE '%$search_query%' OR contact_details LIKE '%$search_query%' OR status LIKE '%$search_query%'";
    } else {
        // If search query is not provided, retrieve all Lost and Found records
        $sql = "SELECT * FROM Lost_and_Found";
    }

    $result = $connection->query($sql);

    // Check if there are any records
    if ($result->num_rows > 0) {
        // Output data for each record
        while ($row = $result->fetch_assoc()) {
            $pid = $row['report_id']; // Fetch the report id
            echo "<tr>
                <td>" . $row['report_id'] . "</td>
                <td>" . $row['pet_description'] . "</td>
                <td>" . $row['location'] . "</td>
                <td>" . $row['report_date'] . "</td>
                <td>" . $row['contact_details'] . "</td>
                <td>" . $row['status'] . "</td>
                <td style='background-color:pink'><a style='padding:4px' href='deletelostandfound.php?id=$pid'>Delete</a></td> 
                <td style='background-color:grey'><a style='padding:4px' href='updatelostandfound.php?id=$pid'>Update</a></td> 
            </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No records found</td></tr>";
    }
    // Close the database connection
    $connection->close();
?>
