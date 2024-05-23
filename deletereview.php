<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Review</title>
</head>
<body>
    <h2>Delete Review</h2>
    <form method="POST" onsubmit="return confirmDelete();">
        <label for="review_id">Review ID:</label>
        <input type="number" name="review_id" required>
        <br><br>
        <input type="submit" name="delete" value="Delete">
        <input type="reset" name="cancel" value="Cancel">
    </form>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this review?');
        }
    </script>

    <?php
    // Database configuration
    require_once 'dbconnection.php';
    // Check if delete button is clicked
    if (isset($_POST['delete'])) {
        // Retrieve review_id from form
        $review_id = $_POST['review_id'];

        // Prepare and execute DELETE statement
        $stmt = $connection->prepare("DELETE FROM reviews WHERE review_id = ?");
        $stmt->bind_param("i", $review_id);

    if ($stmt->execute()) {
        // Redirect to a success page or back to the page where the deletion was initiated
        header('Location: reviewstable.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error deleting review: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

    ?>
</body>
</html>
