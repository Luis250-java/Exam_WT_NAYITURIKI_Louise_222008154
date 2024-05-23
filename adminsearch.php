<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admins Table</title>
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
<div style="margin-left: 500px;">
    <form action="" method="GET">
        <input type="search" name="query" placeholder="Search here">
        <button type="submit" style="background-color: blue;width: 100px;">Search</button>
    </form>
</div>
<hr>
    <center>
    <h2><i>Admins Table</i></h2>
    </center>
    <table>
        <tr>
            <th>Admin ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Gender</th>
        </tr>
        <?php
            // Establish Database Connection
            require_once 'dbconnection.php';

            // Handle search query
            if(isset($_GET['query']) && !empty($_GET['query'])) {
                $search_query = $connection->real_escape_string($_GET['query']);
                // Modify SQL query to filter records based on search query
                $sql = "SELECT * FROM admins WHERE admin_id LIKE '%$search_query%' OR username LIKE '%$search_query%' OR first_name LIKE '%$search_query%' OR last_name LIKE '%$search_query%' OR email LIKE '%$search_query%' OR gender LIKE '%$search_query%'";
            } else {
                // Default SQL query to retrieve all Admins
                $sql = "SELECT * FROM admins";
            }

            $result = $connection->query($sql);

            // Check if there are any records
            if ($result->num_rows > 0) {
                // Output data for each record
                while ($row = $result->fetch_assoc()) {
                    $admin_id = $row['admin_id']; // Fetch the admin id
                    echo "<tr>
                        <td>" . $row['admin_id'] . "</td>
                        <td>" . $row['username'] . "</td>
                        <td>" . $row['first_name'] . "</td>
                        <td>" . $row['last_name'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['gender'] . "</td>
                        <td style='background-color:pink'><a style='padding:4px' href='deleteadmin.php?admin_id=$admin_id'>Delete</a></td> 
                        <td style='background-color:skyblue;'><a style='padding:4px' href='updateadmin.php?admin_id=$admin_id'>Update</a></td> 
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No records found</td></tr>";
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
