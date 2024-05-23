<?php
// Database configuration
require_once'dbconnection.php';

// Check if report_id is set
if (isset($_REQUEST['id'])) {
    $report_id = $_REQUEST['id'];

    // Prepare and execute SELECT statement to retrieve report details
    $stmt = $connection->prepare("SELECT * FROM Lost_and_Found WHERE report_id = ?");
    $stmt->bind_param("i", $report_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $report_id = $row['report_id'];
        $pet_description = $row['pet_description'];
        $location = $row['location'];
        $report_date = $row['report_date'];
        $contact_details = $row['contact_details'];
        $status = $row['status'];
    } else {
        echo "Report not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="report_id">Report ID:</label>
        <input type="number" name="report_id" value="<?php echo isset($report_id) ? $report_id : ''; ?>">
        <br><br>
        <label for="pet_description">Pet Description:</label>
        <textarea name="pet_description"><?php echo isset($pet_description) ? $pet_description : ''; ?></textarea>
        <br><br>
        <label for="location">Location:</label>
        <input type="text" name="location" value="<?php echo isset($location) ? $location : ''; ?>">
        <br><br>
        <label for="report_date">Report Date:</label>
        <input type="datetime-local" name="report_date" value="<?php echo isset($report_date) ? date('Y-m-d\TH:i', strtotime($report_date)) : ''; ?>">
        <br><br>
        <label for="contact_details">Contact Details:</label>
        <input type="text" name="contact_details" value="<?php echo isset($contact_details) ? $contact_details : ''; ?>">
        <br><br>
        <label for="status">Status:</label>
        <select name="status">
            <option value="Lost" <?php if (isset($status) && $status == 'Lost') echo 'selected'; ?>>Lost</option>
            <option value="Found" <?php if (isset($status) && $status == 'Found') echo 'selected'; ?>>Found</option>
        </select>
        <br><br>
        <input type="submit" name="up" value="Update" onclick="return confirm('Are you sure you want to update this report?')">
        <input type="reset" name="cn" value="Cancel">
    </form>
</body>
</html>

<?php
if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $report_id = $_POST['report_id'];
    $pet_description = $_POST['pet_description'];
    $location = $_POST['location'];
    $report_date = $_POST['report_date'];
    $contact_details = $_POST['contact_details'];
    $status = $_POST['status'];

    // Update report in the database
    $stmt = $connection->prepare("UPDATE Lost_and_Found SET pet_description=?, location=?, report_date=?, contact_details=?, status=? WHERE report_id=?");
    $stmt->bind_param("sssssi", $pet_description, $location, $report_date, $contact_details, $status, $report_id);

    if ($stmt->execute()) {
        // Redirect to lostandfoundtable.php after successful update
        header('Location: lostandfoundtable.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating report: " . $stmt->error;
    }
}
?>
