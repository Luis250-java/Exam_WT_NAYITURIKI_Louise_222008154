<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Volunteers Records</title>
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
            background-color: lightgreen;
            color: black;
            font-size: 15px;
        }
    </style>
</head>
<body> 
<div style="margin-left: 500px;"><form action="volunteersearch.php" method="GET">
      <input type="search" name="query" placeholder="Search here">&nbsp;&nbsp;&nbsp;<button type="submit" style="background-color: blue;width: 100px;">Search</button>
    </form></div>
<hr>
    <center>
    <h2><i>Volunteers Records</i></h2>
    </center>
    <table>
        <tr>
            <th>Volunteer ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone number</th>
            <th>Interests</th>
        </tr>
        <?php
            // Establish Database Connection
            require_once'dbconnection.php';
            // Prepare SQL query to retrieve all Volunteers records
            $sql = "SELECT * FROM Volunteers";
            $result = $connection->query($sql);

            // Check if there are any records
            if ($result->num_rows > 0) {
                // Output data for each record
                while ($row = $result->fetch_assoc()) {
                    $vid = $row['volunteer_id']; // Fetch the volunteer id
                    echo "<tr>
                        <td>" . $row['volunteer_id'] . "</td>
                        <td>" . $row['first_name'] . "</td>
                        <td>" . $row['last_name'] . "</td>
                        <td>" . $row['phone_number'] . "</td>
                        <td>" . $row['interests'] . "</td>
                        <td style='background-color:pink'><a style='padding:4px' href='deletevolunteer.php?id=$vid'>Delete</a></td> 
                        <td style='background-color:grey'><a style='padding:4px' href='updatevolunteer.php?id=$vid'>Update</a></td> 
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No records found</td></tr>";
            }
            // Close the database connection
            $connection->close();
        ?>
    </table>
<footer style="background-color:lightskyblue;text-align: center;width:100%;height:70px; color: black;font-size: 25px;">
    <p> Designed by Louise_NAYITURIKI-222008154 &copy YEAR TWO BIT GROUP A &reg 2024</p>
</footer>
<center>
    <button style="background-color: darkgreen; width: 150px;height: 40px;" >
        <a href="home.html" style=" font-size: 15px;color: black;text-decoration: none" >Back Home</a>
    </button>
</center>
</body>
</html>
