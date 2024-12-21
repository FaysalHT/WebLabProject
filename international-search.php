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

// Retrieve form data
$gpa = isset($_POST['gpa']) ? $_POST['gpa'] : null;
$budget = isset($_POST['budget']) ? $_POST['budget'] : null;
$searchByGPA = isset($_POST['searchByGPA']) && $_POST['searchByGPA'] == '1';
$searchByBudget = isset($_POST['searchByBudget']) && $_POST['searchByBudget'] == '1';

// Build SQL query to exclude Bangladesh universities
$sql = "SELECT * FROM universities WHERE country_code != 'BD'"; // Exclude Bangladesh (BD)
if ($searchByGPA && $gpa) {
    $sql .= " AND gpa_cgpa <= ?";
}
if ($searchByBudget && $budget) {
    $sql .= " AND budget_preferences <= ?";
}
$sql .= " ORDER BY gpa_cgpa DESC, budget_preferences ASC";

$stmt = $conn->prepare($sql);
if ($searchByGPA && $searchByBudget) {
    $stmt->bind_param("dd", $gpa, $budget);
} elseif ($searchByGPA) {
    $stmt->bind_param("d", $gpa);
} elseif ($searchByBudget) {
    $stmt->bind_param("d", $budget);
}

$stmt->execute();
$result = $stmt->get_result();

// Include styles and layout adjustments
echo "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='styles.css'>
    <title>Search Results</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap');

    body {
        background-image: linear-gradient(to bottom, #3498db, #2ecc71);
        background-size: cover;
        background-attachment: fixed;
        font-family: 'Montserrat', sans-serif;
        margin: 0;
        padding: 0;
        color: #fff;
    }
    .container {
        padding: 20px;
    }
    .search-header {
        text-align: center;
        margin-bottom: 50px;
    }
    .search-header h1 {
        font-size: 2.5rem;
    }
    .feature-card {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        margin-bottom: 30px;
        padding: 30px;
        color: #333;
        font-family: 'Montserrat', sans-serif;
        text-align: center;
    }
    .feature-card h5 {
        margin-bottom: 10px;
        font-size: 2rem;
        margin-top: 0;
        font-weight: 700;
    }
    .feature-card p {
        font-size: 1rem;
        font-weight: 400;
    }
    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }
    .grid-item {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        padding: 20px;
        color: #333;
        font-family: 'Montserrat', sans-serif;
    }
    .grid-item h5 {
        margin-top: 0;
        font-weight: bold;
        font-size: 1.25rem;
    }
    .btn {
        display: inline-block;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    }
    .btn-primary {
        background-color: #3498db;
        color: #fff;
    }
    .btn-primary:hover {
        background-color: #2980b9;
    }
    .btn-secondary {
        background-color: #2ecc71;
        color: #fff;
    }
    .btn-secondary:hover {
        background-color: #27ae60;
    }
    .no-results {
        text-align: center;
        margin-top: 50px;
    }
    </style>
</head>
<body>
    <div class='container'>
        <header class='search-header'>
            <h1>Search Results</h1>
            <a href='international-search.html' class='btn btn-secondary'>Back to Search</a>
        </header>
";


// Check for results
if ($result->num_rows > 0) {
    $first = true;
    while ($row = $result->fetch_assoc()) {
        if ($first) {
            echo "<div class='feature-card'>
                    <h5>" . htmlspecialchars($row['university_name']) . "</h5>
                    <p><strong>Program:</strong> " . htmlspecialchars($row['program_type']) . "</p>
                    <p><strong>GPA Requirement:</strong> " . htmlspecialchars($row['gpa_cgpa']) . "</p>
                    <p><strong>Budget:</strong> " . htmlspecialchars($row['budget_preferences']) . " " . htmlspecialchars($row['currency']) . "</p>
                    <a href='" . htmlspecialchars($row['website']) . "' class='btn btn-primary'>Visit Website</a>
                  </div>";
            $first = false;
            echo "<div class='grid-container'>";
        } else {
            echo "<div class='grid-item'>
                    <h5>" . htmlspecialchars($row['university_name']) . "</h5>
                    <p><strong>Program:</strong> " . htmlspecialchars($row['program_type']) . "</p>
                    <p><strong>GPA Requirement:</strong> " . htmlspecialchars($row['gpa_cgpa']) . "</p>
                    <p><strong>Budget:</strong> " . htmlspecialchars($row['budget_preferences']) . " " . htmlspecialchars($row['currency']) . "</p>
                    <a href='" . htmlspecialchars($row['website']) . "' class='btn btn-primary'>Visit Website</a>
                  </div>";
        }
    }
    echo "</div>"; // Close grid-container
} else {
    echo "<div class='no-results'>
            <p>No universities matched your search criteria. Please try again with different filters.</p>
          </div>";
}

echo "
    </div>
</body>
</html>
";

$stmt->close();
$conn->close();
?>
