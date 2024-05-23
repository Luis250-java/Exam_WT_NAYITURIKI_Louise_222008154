<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Update Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: grey;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
            font-size: 24px;
        }

        form {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            width: 300px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="number"],
        input[type="radio"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        button:hover {
            background-color: #45a049;
        }

        .radio-group {
            display: flex;
            justify-content: space-between;
        }

        .radio-group label {
            margin-right: 10px;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

    </style>
</head>
<body>
    <div class="container">
        <?php
        // Database configuration
        require_once 'dbconnection.php';

        // Check if admin_id is set in URL parameters
        if (isset($_GET['admin_id'])) {
            $admin_id = $_GET['admin_id']; // Get the admin ID from URL parameter

            // Fetch admin data to populate the form fields
            $sql = "SELECT * FROM admins WHERE admin_id=$admin_id";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
        <form id="updateForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return confirmUpdate();">
            <h2>Update Admin</h2>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>" required>
            
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
            
            <label for="gender">Gender:</label>
            <div class="radio-group">
                <label for="male"><input type="radio" id="male" name="gender" value="Male" <?php if ($row['gender'] == 'Male') echo 'checked'; ?>> Male</label>
                <label for="female"><input type="radio" id="female" name="gender" value="Female" <?php if ($row['gender'] == 'Female') echo 'checked'; ?>> Female</label>
            </div>
            
            <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>"> <!-- Hidden input field to store admin ID -->

            <button type="submit">Update Admin</button>
        </form>
        <?php
            } else {
                echo "Admin not found!";
            }
        } else {
            echo "Admin ID not provided!";
        }

        // Close the database connection
        $connection->close();
        ?>
    </div>

    <script>
        function confirmUpdate() {
            return confirm("Are you sure you want to update this admin?");
        }
    </script>

    <?php
    // PHP code for updating the admin record in the database
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Establish Database Connection
        $connection = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Retrieve updated admin details from the form
        $admin_id = $_POST['admin_id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Update the admin record in the database
        $sql = "UPDATE admins SET username='$username', password='$hashed_password', first_name='$first_name', last_name='$last_name', email='$email', gender='$gender' WHERE admin_id=$admin_id";

        if ($connection->query($sql) === TRUE) {
            echo '<script>alert("Admin updated successfully.");</script>';
            // Redirect the user to adminstable.php after successful update
            echo '<script>window.location.href = "adminstable.php";</script>';
            exit(); // Ensure no further code execution after redirection
        } else {
            echo "Error updating admin: " . $connection->error;
        }

        // Close the database connection
        $connection->close();
    }
    ?>
</body>
</html>
