<?php
// Establish Database Connection
require_once'dbconnection.php';

// Check if event ID is provided in the URL query string
if(isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    // Retrieve event details from the database
    $sql = "SELECT * FROM events WHERE event_id = $event_id";
    $result = $connection->query($sql);

    // Check if the event exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch event details
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event</title>
</head>
<body>
    <center>
    <h2>Update Event</h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="event_id" value="<?php echo $row['event_id']; ?>">

        <label for="event_name">Event Name:</label><br>
        <input type="text" id="event_name" name="event_name" value="<?php echo $row['event_name']; ?>" required><br>
        
        <label for="event_date">Event Date:</label><br>
        <input type="date" id="event_date" name="event_date" value="<?php echo $row['event_date']; ?>" required><br>
        
        <label for="event_location">Event Location:</label><br>
        <input type="text" id="event_location" name="event_location" value="<?php echo $row['event_location']; ?>" required><br>
        
        <label for="event_description">Event Description:</label><br>
        <textarea id="event_description" name="event_description" rows="4" cols="50" required><?php echo $row['event_description']; ?></textarea><br>
        
        <label for="event_cost">Event Cost:</label><br>
        <input type="number" id="event_cost" name="event_cost" min="0" step="0.01" value="<?php echo $row['event_cost']; ?>"><br><br>

        <input type="submit" name="submit" value="Update">
        <input type="reset" name="cancel" value="Cancel">
    </form>
    </center>

    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this event?');
        }
    </script>
</body>
</html>
<?php
    } else {
        echo "Event not found.";
    }
}

// Handle form submission
if(isset($_POST['submit'])) {
    // Retrieve form data
    $event_id = $_POST['event_id'];
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $event_location = $_POST['event_location'];
    $event_description = $_POST['event_description'];
    $event_cost = $_POST['event_cost'];

    // Prepare and execute SQL statement to update event details
    $stmt = $connection->prepare("UPDATE events SET event_name=?, event_date=?, event_location=?, event_description=?, event_cost=? WHERE event_id=?");
    $stmt->bind_param("ssssdi", $event_name, $event_date, $event_location, $event_description, $event_cost, $event_id);

    if ($stmt->execute()) {
        echo "<p>Event updated successfully.</p>";
        // Redirect to events table page after successful update
        header('Location: eventstable.php');
        exit();
    } else {
        echo "Error updating event: " . $stmt->error;
    }
    
    // Close prepared statement
    $stmt->close();
}

// Close the database connection
$connection->close();
?>
