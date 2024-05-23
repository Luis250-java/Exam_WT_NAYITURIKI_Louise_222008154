<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {
    // Connection details
    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "Adopets database";

    // Creating connection
    $connection = new mysqli($host, $user, $pass, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'admins' => "SELECT admin_id FROM admins WHERE admin_id LIKE '%$searchTerm%'",
        'students' => "SELECT first_name FROM students WHERE first_nameLIKE '%$searchTerm%'",
        'attendance' => "SELECT id  FROM attendance WHERE id LIKE '%$searchTerm%'",
        'teachers' => "SELECT teacher_id FROM teachers WHERE teachers_id LIKE '%$searchTerm%'",
        'classes' => "SELECT class_name FROM classes WHERE class_name LIKE '%$searchTerm%'",
        'department' => "SELECT name FROM department WHERE name LIKE '%$searchTerm%'",
        'courses' => "SELECT course_id FROM courses WHERE course_id LIKE '%$searchTerm%'",
        'useraccounts' => "SELECT username FROM useraccounts WHERE username LIKE '%$searchTerm%'"
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
