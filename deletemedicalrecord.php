<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update/Delete Medical Record</title>
</head>
<body>
    <center>
    <h2>Delete Medical Record</h2>
    <form method="POST" onsubmit="return confirmAction()">
        <label for="pet_id">Pet ID:</label><br>
        <input type="number" id="pet_id" name="pet_id" required><br>

        <label for="vaccination_records">Vaccination Records:</label><br>
        <textarea id="vaccination_records" name="vaccination_records" rows="4" cols="50"></textarea><br>

        <label for="spaying_neutering_status">Spaying/Neutering Status:</label><br>
        <select id="spaying_neutering_status" name="spaying_neutering_status" required>
            <option value="Spayed">Spayed</option>
            <option value="Neutered">Neutered</option>
            <option value="Not applicable">Not Applicable</option>
        </select><br>

        <label for="medical_conditions">Medical Conditions:</label><br>
        <textarea id="medical_conditions" name="medical_conditions" rows="4" cols="50"></textarea><br>

        <label for="medications">Medications:</label><br>
        <textarea id="medications" name="medications" rows="4" cols="50"></textarea><br>

        <label for="veterinary_visits">Veterinary Visits:</label><br>
        <textarea id="veterinary_visits" name="veterinary_visits" rows="4" cols="50"></textarea><br><br>

        <input type="submit" name="delete" value="Delete" onclick="return confirmAction()">
        <input type="reset" name="cancel" value="Cancel">
    </form>
    </center>

    <script>
        function confirmAction() {
            return confirm('Are you sure you want to perform this action?');
        }
    </script>

<?php
    // Establish Database Connection
require_once 'dbconnection.php';
    // Check if update button is clicked
    if (isset($_POST['update'])) {
        // Retrieve updated values from form
        $pet_id = $_POST['pet_id'];
        $vaccination_records = $_POST['vaccination_records'];
        $spaying_neutering_status = $_POST['spaying_neutering_status'];
        $medical_conditions = $_POST['medical_conditions'];
        $medications = $_POST['medications'];
        $veterinary_visits = $_POST['veterinary_visits'];

        // Prepare and execute UPDATE statement
        $stmt = $connection->prepare("UPDATE medical_records SET vaccination_records=?, spaying_neutering_status=?, medical_conditions=?, medications=?, veterinary_visits=? WHERE pet_id=?");
        $stmt->bind_param("sssssi", $vaccination_records, $spaying_neutering_status, $medical_conditions, $medications, $veterinary_visits, $pet_id);

        if ($stmt->execute()) {
            echo "<p>Medical record updated successfully.</p>";
        } else {
            echo "Error updating medical record: " . $stmt->error;
        }
    }

    // Check if delete button is clicked
    if (isset($_POST['delete'])) {
        // Retrieve pet_id from form
        $pet_id = $_POST['pet_id'];

        // Prepare and execute DELETE statement
        $stmt = $connection->prepare("DELETE FROM medical_records WHERE pet_id=?");
        $stmt->bind_param("i", $pet_id);

        if ($stmt->execute()) {
            echo "<p>medical record deleted successfully.</p>";
            // Redirect to adoption_application_records.php after successful deletion
            header('Location: medicalrecordstable.php');
            exit(); // Ensure that no other content is sent after the header redirection
        } else {
            echo "Error deleting application: " . $stmt->error;
        }
    }

    // Close the database connection
    $connection->close();
?>
</body>
</html>
