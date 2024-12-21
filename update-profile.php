<?php
// Include database connection
require_once 'db.php';

// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Initialize variables
$new_name = $new_password = $confirm_password = $new_academic_level = "";
$name_err = $password_err = $confirm_password_err = $academic_level_err = "";
$update_success = "";

// Fetch current user data (optional, for prefilling if needed)
$user_id = $_SESSION['user_id'];
$query = "SELECT fullname, academic_level FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$current_name = $user['fullname'];
$current_academic_level = $user['academic_level'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate name
    if (empty(trim($_POST["new_name"]))) {
        $name_err = "Name cannot be empty.";
    } else {
        $new_name = trim($_POST["new_name"]);
    }

    // Validate password
    if (!empty(trim($_POST["new_password"]))) {
        $new_password = trim($_POST["new_password"]);
        if ($new_password !== trim($_POST["confirm_password"])) {
            $confirm_password_err = "Passwords do not match.";
        }
    }

    // Validate academic level
    if (!in_array($_POST["new_academic_level"], ["High School", "Undergraduate", "Graduate"])) {
        $academic_level_err = "Please select a valid academic level.";
    } else {
        $new_academic_level = $_POST["new_academic_level"];
    }

    // Update database if no errors
    if (empty($name_err) && empty($password_err) && empty($confirm_password_err) && empty($academic_level_err)) {
        $update_query = "UPDATE users SET fullname = ?, academic_level = ? " . (!empty($new_password) ? ", password = ?" : "") . " WHERE id = ?";
        $stmt = $conn->prepare($update_query);

        if (!empty($new_password)) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt->bind_param("sssi", $new_name, $new_academic_level, $hashed_password, $user_id);
        } else {
            $stmt->bind_param("ssi", $new_name, $new_academic_level, $user_id);
        }

        if ($stmt->execute()) {
            $update_success = "Profile updated successfully!";
        } else {
            echo "Error updating profile: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile - UniPass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <style>

        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #3498db, #2ecc71);
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background: #ffffff;
            color: #333333;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            padding: 30px;
            max-width: 500px;
        }

        h2 {
            font-weight: 700;
            color: #3498db;
        }

        .form-label {
            font-weight: 500;
            color: #333333;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3498db);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2ecc71);
        }

        .btn-secondary {
            color: #ffffff;
            background-color: #333333;
        }

        .btn-secondary:hover {
            background-color: #555555;
        }

        .invalid-feedback {
            color: #e63946;
        }

        .alert-success {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
            color: #ffffff;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center">Update Profile</h2>
    <form action="update-profile.php" method="post">
        <?php if (!empty($update_success)) : ?>
            <div class="alert alert-success">
                <?php echo $update_success; ?>
                <div class="d-grid gap-2 mt-3">
                    <a href="dashboard.php" class="btn btn-primary">Return to Dashboard</a>
                </div>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="new_name" class="form-label">New Name</label>
            <input type="text" name="new_name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($new_name); ?>">
            <div class="invalid-feedback"><?php echo $name_err; ?></div>
        </div>
        <div class="mb-3">
            <label for="new_password" class="form-label">New Password</label>
            <input type="password" name="new_password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback"><?php echo $password_err; ?></div>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
            <div class="invalid-feedback"><?php echo $confirm_password_err; ?></div>
        </div>
        <div class="mb-3">
            <label for="new_academic_level" class="form-label">Academic Level</label>
            <select name="new_academic_level" class="form-select <?php echo (!empty($academic_level_err)) ? 'is-invalid' : ''; ?>">
                <option value="">Select an academic level</option>
                <option value="High School" <?php echo ($new_academic_level === "High School") ? 'selected' : ''; ?>>High School</option>
                <option value="Undergraduate" <?php echo ($new_academic_level === "Undergraduate") ? 'selected' : ''; ?>>Undergraduate</option>
                <option value="Graduate" <?php echo ($new_academic_level === "Graduate") ? 'selected' : ''; ?>>Graduate</option>
            </select>
            <div class="invalid-feedback"><?php echo $academic_level_err; ?></div>
        </div>
        <?php if (empty($update_success)) : ?>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Update Profile</button>
                <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
            </div>
        <?php endif; ?>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
