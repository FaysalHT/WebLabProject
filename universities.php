<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universities - UniPass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
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
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link active" href="universities.php" style="font-weight:bold">Universities</a></li>
                <li class="nav-item"><a class="nav-link" href="search.php">Search</a></li>
                <li class="nav-item"><a class="nav-link" href="connect.html">Connect</a></li>
                <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
            </ul>
            <?php
            session_start();
            $isLoggedIn = isset($_SESSION['user_id']);
            ?>
            
        </div>
    </div>
</nav>


    <!-- Search Section -->
    <section id="searchSection" class="container py-5">
      <h2 class="text-center mb-4">Search Universities</h2>
      <div class="mb-4">
          <input type="text" id="countrySearch" class="form-control" placeholder="Search by Country Short Name (e.g., BD for Bangladesh)">
      </div>
      <div class="mb-4">
          <input type="text" id="universitySearch" class="form-control" placeholder="Search by University Name">
      </div>
  </section>

     <!-- Universities Section -->
     <section id="universities" class="container py-5">
      <h2 class="text-center mb-4">Top Universities</h2>
      <div id="universityList" class="row"></div>
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