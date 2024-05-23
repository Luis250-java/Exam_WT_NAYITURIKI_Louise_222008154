<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Review</title>
</head>
<body>
    <?php
    // Database configuration
    require_once'dbconnection.php';

    // Check if review_id is set
    if (isset($_REQUEST['id'])) {
        $review_id = $_REQUEST['id'];

        // Prepare and execute SELECT statement to retrieve review details
        $stmt = $connection->prepare("SELECT * FROM reviews WHERE review_id = ?");
        $stmt->bind_param("i", $review_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $review_id = $row['review_id'];
            $reviewer_name = $row['reviewer_name'];
            $reviewer_email = $row['reviewer_email'];
            $reviewed_item_id = $row['reviewed_item_id'];
            $reviewed_item_type = $row['reviewed_item_type'];
            $review_date = $row['review_date'];
        } else {
            echo "Review not found.";
            exit(); // Exit if the review is not found
        }
    }

    // Close the statement
    $stmt->close();
    ?>

    <h2>Update Review Details</h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="review_id">Review ID:</label>
        <input type="number" name="review_id" value="<?php echo isset($review_id) ? $review_id : ''; ?>" readonly>

        <label for="reviewer_name">Reviewer Name:</label>
        <input type="text" name="reviewer_name" value="<?php echo isset($reviewer_name) ? $reviewer_name : ''; ?>">

        <label for="reviewer_email">Reviewer Email:</label>
        <input type="email" name="reviewer_email" value="<?php echo isset($reviewer_email) ? $reviewer_email : ''; ?>">

        <label for="reviewed_item_id">Reviewed Item ID:</label>
        <input type="number" name="reviewed_item_id" value="<?php echo isset($reviewed_item_id) ? $reviewed_item_id : ''; ?>">

        <label for="reviewed_item_type">Reviewed Item Type:</label>
        <select name="reviewed_item_type">
            <option value="Pet" <?php if(isset($reviewed_item_type) && $reviewed_item_type == 'Pet') echo 'selected'; ?>>Pet</option>
            <option value="Shelter" <?php if(isset($reviewed_item_type) && $reviewed_item_type == 'Shelter') echo 'selected'; ?>>Shelter</option>
        </select>

        <label for="review_date">Review Date:</label>
        <input type="date" name="review_date" value="<?php echo isset($review_date) ? $review_date : ''; ?>">
        <br><br>

        <input type="submit" name="update" value="Update">
        <input type="reset" name="cancel" value="Cancel">
    </form>

    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this review?');
        }
    </script>

    <?php
    // Check if update button is clicked
    if (isset($_POST['update'])) {
        // Retrieve updated values from form
        $review_id = $_POST['review_id'];
        $reviewer_name = $_POST['reviewer_name'];
        $reviewer_email = $_POST['reviewer_email'];
        $reviewed_item_id = $_POST['reviewed_item_id'];
        $reviewed_item_type = $_POST['reviewed_item_type'];
        $review_date = $_POST['review_date'];

        // Prepare and execute UPDATE statement
        $stmt = $connection->prepare("UPDATE reviews SET reviewer_name=?, reviewer_email=?, reviewed_item_id=?, reviewed_item_type=?, review_date=? WHERE review_id=?");
        $stmt->bind_param("ssisss", $reviewer_name, $reviewer_email, $reviewed_item_id, $reviewed_item_type, $review_date, $review_id);

        if ($stmt->execute()) {
            // Redirect to reviewstable.php after successful update
            header('Location: reviewstable.php');
            exit(); // Ensure that no other content is sent after the header redirection
        } else {
            echo "Error updating review: " . $stmt->error;
        }
    }
    ?>

</body>
</html>

<?php
// Close the database connection
$connection->close();
?>
