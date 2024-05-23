<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Adoption Application</title>
</head>
<body>
    <?php
    // Database configuration
    require_once 'dbconnection.php';

    // Check if application_id is set
    if (isset($_REQUEST['id'])) {
        $application_id = $_REQUEST['id'];

        // Prepare and execute SELECT statement to retrieve application details
        $stmt = $connection->prepare("SELECT * FROM adoption_applications WHERE application_id = ?");
        $stmt->bind_param("i", $application_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $email = $row['email'];
            $phone = $row['phone'];
            $address = $row['address'];
            $pet_name = $row['pet_name'];
            $reason_for_adoption = $row['reason_for_adoption'];
            $submission_date = $row['submission_date'];
        } else {
            echo "Application not found.";
            exit(); // Exit if the application is not found
        }
    }

    // Close the statement
    $stmt->close();
    ?>
    <center>
    <h2>Update Adoption Application</h2>
    <form method="POST" onsubmit="return confirmUpdate()">
        <label for="application_id">Application ID:</label><br>
        <input type="number" name="application_id" value="<?php echo isset($application_id) ? $application_id : ''; ?>" readonly><br>

        <label for="full_name">Full Name:</label><br>
        <input type="text" name="full_name" value="<?php echo isset($name) ? $name : ''; ?>"><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>"><br>

        <label for="phone_number">Phone Number:</label><br>
        <input type="tel" name="phone_number" value="<?php echo isset($phone) ? $phone : ''; ?>"><br>

        <label for="address">Address:</label><br>
        <textarea name="address" rows="4" cols="50"><?php echo isset($address) ? $address : ''; ?></textarea><br>

        <label for="pet_name">Pet Name:</label><br>
        <input type="text" name="pet_name" value="<?php echo isset($pet_name) ? $pet_name : ''; ?>"><br>

        <label for="reason_for_adoption">Reason for Adoption:</label><br>
        <textarea name="reason_for_adoption" rows="4" cols="50"><?php echo isset($reason_for_adoption) ? $reason_for_adoption : ''; ?></textarea><br>

        <label for="submission_date">Submission Date:</label><br>
        <input type="date" name="submission_date" value="<?php echo isset($submission_date) ? $submission_date : ''; ?>"><br><br>

        <input type="submit" name="update" value="Update">
        <input type="reset" name="cancel" value="Cancel">
    </form>
    </center>

    <?php
    // Check if update button is clicked
    if (isset($_POST['update'])) {
        // Retrieve updated values from form
        $application_id = $_POST['application_id'];
        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];
        $pet_name = $_POST['pet_name'];
        $reason_for_adoption = $_POST['reason_for_adoption'];
        $submission_date = $_POST['submission_date'];

        // Prepare and execute UPDATE statement
        $stmt = $conn->prepare("UPDATE adoption_applications SET name=?, email=?, phone=?, address=?, pet_name=?, reason_for_adoption=?, submission_date=? WHERE application_id=?");
        $stmt->bind_param("sssssssi", $full_name, $email, $phone_number, $address, $pet_name, $reason_for_adoption, $submission_date, $application_id);

        if ($stmt->execute()) {
            echo "<p>Application updated successfully.</p>";
            // Redirect to adoption_application_records.php after successful update
            header('Location: adoptionapplicantstable.php');
            exit(); // Ensure that no other content is sent after the header redirection
        } else {
            echo "Error updating application details: " . $stmt->error;
        }
    }
    ?>

    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this volunteer?');
        }
    </script>

    <?php
    // Close the database connection
    $connection->close();
    ?>
</body>
</html>
