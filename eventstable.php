<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Table</title>
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
<div style="margin-left: 500px;"><form action="eventsearch.php" method="GET">
      <input type="search" name="query" placeholder="Search here">&nbsp;&nbsp;&nbsp;<button type="submit" style="background-color: blue;width: 100px;">Search</button>
    </form></div>
<hr>
    <center>
    <h2>Events Table</h2>
    </center>
    <table>
        <tr>
            <th>Event ID</th>
            <th>Event Name</th>
            <th>Event Date</th>
            <th>Event Location</th>
            <th>Event Description</th>
            <th>Event Cost</th>
            <th>Action</th>
        </tr>
        <?php
        // Establish Database Connection
      require_once 'dbconnection.php';

        // Retrieve events data from the database
        $sql = "SELECT * FROM events";
        $result = $connection->query($sql);

        // Check if there are any records
        if ($result->num_rows > 0) {
            // Output data for each record
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row['event_id'] . "</td>
                    <td>" . $row['event_name'] . "</td>
                    <td>" . $row['event_date'] . "</td>
                    <td>" . $row['event_location'] . "</td>
                    <td>" . $row['event_description'] . "</td>
                    <td>" . $row['event_cost'] . "</td>
                    <td style='background-color:pink'><a style='padding:4px' href='deleteevent.php?event_id=" . $row['event_id'] . "'>Delete</a></td> 
                    <td style='background-color:skyblue;'><a style='padding:4px' href='updateevent.php?event_id=" . $row['event_id'] . "'>Update</a></td> 
                </tr>";

            }
        } else {
            echo "<tr><td colspan='7'>No records found</td></tr>";
        }

        // Close the database connection
        $connection->close();
        ?>
    </table>
    <footer style="background-color:grey;text-align: center;width:100%;height:70px; color: white;font-size: 25px;">
    <p> Designed by Louise_NAYITURIKI-222008154 &copy YEAR TWO BIT GROUP A &reg 2024</p>
</footer>
<center>
    <button style="background-color: darkgreen; width: 150px;height: 40px;" >
        <a href="home.html" style=" font-size: 15px;color: white;text-decoration: none" >Back Home</a>
    </button>
</center>
</body>
</html>
