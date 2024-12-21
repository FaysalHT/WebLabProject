<?php
// Include the database connection file
require_once 'db.php';

// Start the session
session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Fetch user data from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT fullname, email, academic_level FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - UniPass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="logo.png" alt="UniPass Logo" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="universities.php">Universities</a></li>
                <li class="nav-item"><a class="nav-link" href="search.php">Search</a></li>
                <li class="nav-item"><a class="nav-link" href="connect.html">Connect</a></li>
                <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
            </ul>
            <div class="nav-auth-buttons">
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</nav>

<!-- Dashboard Section -->
<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-body text-center">
                    <h3>Welcome, <?php echo htmlspecialchars($user['fullname']); ?>!</h3>
                    <p class="text-muted">Email: <?php echo htmlspecialchars($user['email']); ?></p>
                    <p class="text-muted">Academic Level: <?php echo htmlspecialchars($user['academic_level']); ?></p>
                    <hr>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h3>Your Dashboard</h3>
                    <p class="text-muted">Manage your account here.</p>
                    <!-- You can add additional features, charts, etc. -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h4>Profile Settings</h4>
                                    <p>Update your profile information.</p>
                                    <a href="update-profile.php" class="btn btn-light">Update</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h4>User Information</h4>
                                    <p>Check your recent notifications.</p>
                                    <a href="user-info.php" class="btn btn-light">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4>Recent Activity</h4>
                    <ul class="list-group">
                        <li class="list-group-item">Logged in at <?php echo date('Y-m-d H:i:s'); ?></li>
                        <li class="list-group-item">Profile updated on <?php echo date('Y-m-d'); ?></li>
                        <!-- Add more activity data if you track it -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
<footer class="bg-dark text-white py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>UniPass</h5>
                <p>Your gateway to university discovery and student networking</p>
            </div>
            <div class="col-md-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#contactModal">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Contact</h5>
                <p>Email: support@unipass.com</p>
                <p>Phone: +880 1123578653</p>
            </div>
        </div>
    </div>
</footer>

<!-- Modal for Contact Us -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Contact Us</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Your Message</label>
                        <textarea class="form-control" id="message" rows="4" placeholder="Enter your message" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // JavaScript to toggle content between Notifications and Your Information
    const notificationsButton = document.getElementById('notificationsButton');
    const dashboardContent = document.getElementById('dashboardContent');
    const recentActivity = document.getElementById('recentActivity');

    // Create the "Your Information" button
    const yourInformationButton = document.createElement('h4');
    yourInformationButton.textContent = 'Your Information';

    // Event listener to toggle content
    notificationsButton.addEventListener('click', function () {
        // Hide notifications content
        recentActivity.style.display = 'none';

        // Show user information
        const userInformation = `
            <h4>User Information</h4>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Full Name:</strong> <?php echo htmlspecialchars($user['fullname']); ?></li>
                <li class="list-group-item"><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></li>
                <li class="list-group-item"><strong>Academic Level:</strong> <?php echo htmlspecialchars($user['academic_level']); ?></li>
            </ul>
        `;

        dashboardContent.innerHTML = userInformation;

        // Replace "Notifications" button with "Your Information"
        notificationsButton.replaceWith(yourInformationButton);
    });

    // Event listener for "Your Information" button to go back to notifications
    yourInformationButton.addEventListener('click', function () {
        // Show notifications content again
        recentActivity.style.display = 'block';

        // Replace "Your Information" button with "Notifications"
        yourInformationButton.replaceWith(notificationsButton);
    });
</script>

</body>
</html>
