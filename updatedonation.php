<?php
// Database configuration
require_once'dbconnection.php';

// Check if donation_id is set
if (isset($_REQUEST['id'])) {
    $donation_id = $_REQUEST['id'];

    // Prepare and execute SELECT statement to retrieve donation details
    $stmt = $connection->prepare("SELECT * FROM Donations WHERE donation_id = ?");
    $stmt->bind_param("i", $donation_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $donor_name = $row['donor_name'];
        $donor_contacts = $row['donor_contacts']; 
        $donation_type = $row['donation_type'];
        $donation_amount = $row['donation_amount'];
        $donation_date = $row['donation_date'];
    } else {
        echo "Donation not found.";
        exit(); // Exit if the donation is not found
    }
}

// Close the statement
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Donation</title>
</head>
<body>
    <h2>Update Donation Details</h2>
    <form method="POST" onsubmit="return confirmUpdate()">
        <label for="donor_name">Donor Name:</label>
        <input type="text" name="donor_name" value="<?php echo isset($donor_name) ? $donor_name : ''; ?>">

        <label for="donor_contact_information">Contact Information:</label> <!-- Corrected label name -->
        <input type="text" name="donor_contacts" value="<?php echo isset($donor_contacts) ? $donor_contacts : ''; ?>"> <!-- Corrected input name -->
        <br><br>
        <label for="donation_type">Donation Type:</label>
        <select name="donation_type">
            <option value="Monetary" <?php if (isset($donation_type) && $donation_type == 'Monetary') echo 'selected'; ?>>Monetary</option>
            <option value="In-kind" <?php if (isset($donation_type) && $donation_type == 'In-kind') echo 'selected'; ?>>In-kind</option>
            <option value="Sponsorship" <?php if (isset($donation_type) && $donation_type == 'Sponsorship') echo 'selected'; ?>>Sponsorship</option>
        </select>
        <br><br>
        <label for="donation_amount">Donation Amount:</label>
        <input type="text" name="donation_amount" value="<?php echo isset($donation_amount) ? $donation_amount : ''; ?>">
        <br><br>
        <br><br>
        <label for="donation_date">Donation Date:</label>
        <input type="date" name="donation_date" value="<?php echo isset($donation_date) ? $donation_date : ''; ?>">
        <br><br>
        <input type="submit" name="update" value="Update">
        <input type="reset" name="cancel" value="Cancel">

    </form>
     <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this donation?');
        }
    </script>

    <?php
    // Check if update button is clicked
    if (isset($_POST['update'])) {
        // Retrieve updated values from form
        $donor_name = $_POST['donor_name'];
        $donor_contacts = $_POST['donor_contacts'];
        $donation_type = $_POST['donation_type'];
        $donation_amount = $_POST['donation_amount'];
        $donation_date = $_POST['donation_date'];

        // Prepare and execute UPDATE statement
        $stmt = $connection->prepare("UPDATE Donations SET donor_name=?, donor_contacts=?, donation_type=?, donation_amount=?, donation_date=? WHERE donation_id=?");
        $stmt->bind_param("sssssi", $donor_name, $donor_contacts, $donation_type, $donation_amount, $donation_date, $donation_id);

        if ($stmt->execute()) {
            // Redirect to donationstable.php after successful update
            header('Location: donationstable.php');
            exit(); // Ensure that no other content is sent after the header redirection
        } else {
            echo "Error updating donations: " . $stmt->error;
        }
    }
    ?>

</body>
</html>

<?php
// Close the database connection
$connection->close();
?>
