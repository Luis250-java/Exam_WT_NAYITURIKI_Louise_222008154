  <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donations Records</title>
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
            background-color: sandybrown;
            color: white;
            font-size: 15px;
        }

    </style>
</head>
<body> 
<div style="margin-left: 500px;"><form action="donationsearch.php" method="GET">
      <input type="search" name="query" placeholder="Search here">&nbsp;&nbsp;&nbsp;<button type="submit" style="background-color: blue;width: 100px;">Search</button>
    </form></div>
<hr>
    <center>
    <h2><i>Donations Records</i></h2>
    </center>
    <table>
        <tr>
            <th>Donation ID</th>
            <th>Donor Name</th>
            <th>Contact Information</th>
            <th>Donation Type</th>
            <th>Donation Amount</th>
            <th>Donation Date</th>
        </tr>
<?php
    // Establish Database Connection
    $connection = new mysqli("localhost", "root", "", "Adopets database");
    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Check if search query parameter is set
    if(isset($_GET['query']) && !empty($_GET['query'])) {
        // Sanitize the search query to prevent SQL injection
        $search_query = $connection->real_escape_string($_GET['query']);

        // Prepare SQL query to retrieve Donation records matching the search query
        $sql = "SELECT * FROM Donations WHERE donor_name LIKE '%$search_query%' OR donor_contacts LIKE '%$search_query%' OR donation_type LIKE '%$search_query%' OR donation_amount LIKE '%$search_query%' OR donation_date LIKE '%$search_query%'";
    } else {
        // If search query is not provided, retrieve all Donation records
        $sql = "SELECT * FROM Donations";
    }

    $result = $connection->query($sql);

    // Check if there are any records
    if ($result->num_rows > 0) {
        // Output data for each record
        while ($row = $result->fetch_assoc()) {
            $did = $row['donation_id']; // Fetch the donation id
            echo "<tr>
                <td>" . $row['donation_id'] . "</td>
                <td>" . $row['donor_name'] . "</td>
                <td>" . $row['donor_contacts'] . "</td>
                <td>" . $row['donation_type'] . "</td>
                <td>" . $row['donation_amount'] . "</td>
                <td>" . $row['donation_date'] . "</td>
                <td style='background-color:pink'><a style='padding:4px' href='deletedonation.php?id=$did'>Delete</a></td> 
                <td style='background-color:lightskyblue'><a style='padding:4px' href='updatedonation.php?id=$did'>Update</a></td> 
            </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No records found</td></tr>";
    }
    // Close the database connection
    $connection->close();
?>
