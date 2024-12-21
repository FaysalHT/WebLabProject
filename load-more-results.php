<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "unipass"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data from the AJAX request
$location = "%" . $_POST['location'] . "%"; // Adding wildcard for partial matches
$gpa = $_POST['gpa'];
$universityType = $_POST['universityType'];
$programType = $_POST['programType'];
$budget = $_POST['budget'];
$currency = $_POST['currency'];
$limit = $_POST['limit']; // Number of results to load
$offset = $_POST['offset']; // Number of results already loaded

// Prepare and execute the query to fetch more results based on limit and offset
$sql = "SELECT * FROM universities 
        WHERE preferred_country LIKE ? 
        OR gpa_cgpa <= ? 
        OR program_type = ? 
        OR budget_preferences <= ? 
        OR currency = ?
        LIMIT $limit OFFSET $offset";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sdsds", $location, $gpa, $programType, $budget, $currency);
$stmt->execute();
$result = $stmt->get_result();

// Display more results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['university_name']) . "</td>
                <td><a href='" . htmlspecialchars($row['website']) . "' target='_blank'>" . htmlspecialchars($row['website']) . "</a></td>
                <td>" . htmlspecialchars($row['preferred_country']) . "</td>
                <td>" . htmlspecialchars($row['program_type']) . "</td>
                <td>" . htmlspecialchars($row['gpa_cgpa']) . "</td>
                <td>" . htmlspecialchars($row['budget_preferences']) . "</td>
                <td>" . htmlspecialchars($row['currency']) . "</td>
              </tr>";
    }
} else {
    // No more results available
    echo "";
}

// Close connection
$conn->close();
?>
