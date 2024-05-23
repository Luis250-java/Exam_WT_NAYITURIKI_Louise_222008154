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
<div style="margin-left: 500px;">
    <form action="donationsearch.php" method="GET">
        <input type="search" name="query" placeholder="Search here">&nbsp;&nbsp;&nbsp;
        <button type="submit" style="background-color: blue;width: 100px;">Search</button>
    </form>
</div>
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
        <th>Actions</th>
    </tr>
    <?php
        // Establish Database Connection
        require_once 'dbconnection.php';

        // Query to select all records from the donations table
        $sql = "SELECT * FROM donations";
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
                    <td style='background-color:pink'>
                        <a style='padding:4px' href='deletedonation.php?id=$did'>Delete</a>
                    </td> 
                    <td style='background-color:lightskyblue'>
                        <a style='padding:4px' href='updatedonation.php?id=$did'>Update</a>
                    </td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No records found</td></tr>";
        }

        // Close the database connection
        $connection->close();
    ?>
</table>
<footer style="background-color:lightskyblue;text-align: center;width:100%;height:70px; color: white;font-size: 25px;">
    <p> Designed by Louise_NAYITURIKI-222008154 &copy YEAR TWO BIT GROUP A &reg 2024</p>
</footer>
<center>
    <button style="background-color: darkgreen; width: 150px;height: 40px;">
        <a href="home.html" style="font-size: 15px;color: white;text-decoration: none">Back Home</a>
    </button>
</center>
</body>
</html>
