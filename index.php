<?php
// Start the session at the beginning of the file
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniPass - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>
<body>
    <!-- Navigation -->
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
                    <li class="nav-item"><a class="nav-link active" href="index.php" style="font-family: 'Montserrat', sans-serif; font-weight:bolder;">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="universities.php">Universities</a></li>
                    <li class="nav-item"><a class="nav-link" href="search.php">Search</a></li>
                    <li class="nav-item"><a class="nav-link" href="connect.html">Connect</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                </ul>
                <div class="nav-auth-buttons">
                    <!-- Check if the user is logged in using session -->
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <!-- Show Dashboard link only when the user is logged in -->
                        <a href="dashboard.php" class="btn btn-outline-primary me-2">Dashboard</a>
                    <?php else: ?>
                        <!-- Show Login and Sign Up buttons only when the user is not logged in -->
                        <a href="login.html" class="btn btn-outline-primary me-2">Login</a>
                        <a href="signup.html" class="btn btn-primary">Sign Up</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="hero-container">
            <h1 class="display-3 animate__animated animate__fadeInDown" style="font-weight: bold">Welcome to UniPass</h1>
            <p class="lead animate__animated animate__fadeInUp">Your Ultimate University Discovery and Networking Platform</p>
            <a href="search.php" class="btn btn-primary btn-lg mt-3 animate__animated animate__fadeInUp">Start Your Search</a>
        </div>
    </header>

    <!-- Features Section -->
    <section id="features" class="container py-5">
        <h2 class="text-center mb-5" style="font-weight: bold; color:white;">Explore Our Features</h2>
        <div class="feature-list">
            <div class="feature-item">
                <div class="feature-image">
                    <img src="search.jpg" alt="Search Functionality">
                </div>
                <div class="feature-info">
                    <h3>Search Functionality</h3>
                    <ul>
                        <li>Filter by location, program type, and more</li>
                        <li>Compare universities side-by-side</li>
                        <li>Get personalized recommendations</li>
                    </ul>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-image">
                    <img src="connection.jpg" alt="Student Connection">
                </div>
                <div class="feature-info">
                    <h3>Student Connection</h3>
                    <ul>
                        <li>Collaborate with others exploring universities</li>
                        <li>Get guidance from peers already enrolled</li>
                        <li>Share insights and experiences</li>
                    </ul>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-image">
                    <img src="studentsgraduation.jpg" alt="University Listing">
                </div>
                <div class="feature-info">
                    <h3>University Listing</h3>
                    <ul>
                        <li>Universities can apply to be listed</li>
                        <li>Admin-managed verification process</li>
                        <li>Only credible institutions listed</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Ready to Start Your Journey Section -->
    <section id="call-to-action" style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: white;">
        <div class="container text-center py-5">
            <h2 class="animate__animated animate__fadeInUp">Ready to Start Your Journey?</h2>
            <p class="animate__animated animate__fadeInUp">Let UniPass guide you toward achieving your educational goals.</p>
            <a href="login.html" class="btn btn-primary btn-lg animate__animated animate__pulse animate__infinite">Get Started</a>
        </div>
    </section>

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
    <script src="script.js"></script>
</body>
</html>
