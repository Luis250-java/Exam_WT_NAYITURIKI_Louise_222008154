<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pets Records</title>
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
            background-color: skyblue;
            color: black;
            font-size: 15px;
        }
    </style>
</head>
<body> 
<div style="margin-left: 500px;"><form action="petsearch.php" method="GET">
      <input type="search" name="query" placeholder="Search here">&nbsp;&nbsp;&nbsp;<button type="submit" style="background-color: blue;width: 100px;">Search</button>
    </form></div>
<hr>
    <center>
    <h2><i>Pets Records</i></h2>
    </center>
    <table>
        <tr>
            <th>Pet ID</th>
            <th>Pet Name</th>
            <th>Species</th>
            <th>Breed</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Size</th>
        </tr>
        <?php
            // Establish Database Connection
            require_once 'dbconnection.php';
            // Prepare SQL query to retrieve all Pets records
            $sql = "SELECT * FROM Pets";
            $result = $connection->query($sql);

            // Check if there are any records
            if ($result->num_rows > 0) {
                // Output data for each record
                while ($row = $result->fetch_assoc()) {
                    $pid = $row['pet_id']; // Fetch the pet id
                    echo "<tr>
                        <td>" . $row['pet_id'] . "</td>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['species'] . "</td>
                        <td>" . $row['breed'] . "</td>
                        <td>" . $row['age'] . "</td>
                        <td>" . $row['gender'] . "</td>
                        <td>" . $row['size'] . "</td>
                        <td style='background-color:pink'><a style='padding:4px' href='deletepet.php?id=$pid'>Delete</a></td> 
                      <td style='background-color:skyblue'><a style='padding:4px' href='updatepet.php?id=$pid'>Update</a></td> 
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No records found</td></tr>";
            }
            // Close the database connection
            $connection->close();
        ?>
    </table>
<footer style="background-color:mediumpurple;text-align: center;width:100%;height:70px; color: white;font-size: 25px;">
    <p> Designed by Louise_NAYITURIKI-222008154 &copy YEAR TWO BIT GROUP A &reg 2024</p>
</footer>
<center>
    <button style="background-color: darkgreen; width: 150px;height: 40px;" >
        <a href="home.html" style=" font-size: 15px;color: white;text-decoration: none" >Back Home</a>
    </button>
</center>
</body>
</html>
