<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medical Records</title>
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

        .actions {
            display: flex;
            gap: 10px;
        }

        .actions a {
            padding: 4px;
            text-decoration: none;
            color: black;
        }

        .delete {
            background-color: pink;
        }

        .update {
            background-color: grey;
        }
    </style>
</head>
<body> 
<div style="margin-left: 500px;">
    <form action="" method="GET">
        <input type="search" name="query" placeholder="Search here">
        <button type="submit" style="background-color: blue;width: 100px;">Search</button>
    </form>
</div>
<hr>
    <center>
    <h2><i>Medical Records</i></h2>
    </center>
    <table>
        <tr>
            <th>Pet ID</th>
            <th>Vaccination Records</th>
            <th>Spaying/Neutering Status</th>
            <th>Medical Conditions</th>
            <th>Medications</th>
            <th>Veterinary Visits</th>
            <th>Actions</th>
        </tr>
        <?php
            // Establish Database Connection
            require_once 'dbconnection.php';

            // Handle search query
            if(isset($_GET['query']) && !empty($_GET['query'])) {
                $search_query = $connection->real_escape_string($_GET['query']);
                $sql = "SELECT * FROM medical_records WHERE pet_id LIKE '%$search_query%' OR vaccination_records LIKE '%$search_query%' OR spaying_neutering_status LIKE '%$search_query%' OR medical_conditions LIKE '%$search_query%' OR medications LIKE '%$search_query%' OR veterinary_visits LIKE '%$search_query%'";
            } else {
                // Default SQL query to retrieve all records
                $sql = "SELECT * FROM medical_records";
            }

            $result = $connection->query($sql);

            // Check if there are any records
            if ($result->num_rows > 0) {
                // Output data for each record
                while ($row = $result->fetch_assoc()) {
                    $pet_id = $row['pet_id']; // Fetch the pet id
                    echo "<tr>
                        <td>" . $row['pet_id'] . "</td>
                        <td>" . $row['vaccination_records'] . "</td>
                        <td>" . $row['spaying_neutering_status'] . "</td>
                        <td>" . $row['medical_conditions'] . "</td>
                        <td>" . $row['medications'] . "</td>
                        <td>" . $row['veterinary_visits'] . "</td>
                        <td class='actions'>
                            <a class='delete' href='deletemedicalrecord.php?id=$pet_id'>Delete</a>
                            <a class='update' href='updatemedicalrecord.php?id=$pet_id'>Update</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No records found</td></tr>";
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
