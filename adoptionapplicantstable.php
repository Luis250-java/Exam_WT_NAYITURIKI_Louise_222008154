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
            require_once 'dbconnection.php';
            // Prepare SQL query to retrieve all Adoption Process records
            $sql = "SELECT * FROM adoption_applications";
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
                        <td>
                        <td style='background-color:pink'><a style='padding:4px' href='deleteadoption.php?id=" . $row['application_id'] . "'>Delete</a>
                        <td style='background-color:skyblue;'><a style='padding:4px' href='updateadoption.php?id=" . $row['application_id'] . "'>Update</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No records found</td></tr>";
            }
            // Close the database connection
            $connection->close();
        ?>
    </table>
<footer style="background-color:lightcoral;text-align: center;width:100%;height:70px; color: black;font-size: 25px;">
    <p> Designed by Louise_NAYITURIKI-222008154 &copy YEAR TWO BIT GROUP A &reg 2024</p>
</footer>
<center>
    <button style="background-color: darkgreen; width: 150px;height: 40px;" >
        <a href="home.html" style=" font-size: 15px;color: black;text-decoration: none" >Back Home</a>
    </button>
</center>
</body>
</html>
