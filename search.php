<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniPass - Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
/* Card Style */
.search-option-card {
    position: relative;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease, filter 0.3s ease;
    border-radius: 20px;
    overflow: hidden;
    height: 300px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    margin-bottom: 20px;
}

.search-option-card:hover {
    transform: scale(1.05);
    filter: brightness(1);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
}

.card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: opacity 0.3s ease;
}

.search-option-card:hover .card-img {
    opacity: 1; /* Slightly darken image on hover */
}

/* Overlay Text Style */
.card-body {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 20px;
    background: rgba(0, 0, 0, 0.4);
    color: white;
    font-family: 'Roboto', sans-serif;
    text-align: center;
    transition: background 0.3s ease;
    opacity: 0;
}

.search-option-card:hover .card-body {
    opacity: 1;
}

.card-title {
    font-size: 1.3rem;
    font-weight: bold;
}

.card-description {
    padding: 15px;
    text-align: center;
    font-size: 1.1rem;
    color: #fff;
    background: rgba(0, 0, 0, 0.5); /* semi-transparent background */
    border-radius: 10px;
    margin-top: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease;
}

.card-description-local {
    background: rgba(0, 123, 255, 0.8); /* Blue with transparency */
}

.card-description-international {
    background: rgba(103, 117, 119, 0.8); /* Light Blue with transparency */
}

.btn-light {
    background-color: #fff;
    color: #333;
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: bold;
    display: inline-block;
    margin-top: 15px;
    font-size: 1rem;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.btn-light:hover {
    background-color: #f8f9fa;
    color: #007bff;
}

.search-option-card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
    margin-bottom: 50px;
}

.col-md-6 {
    max-width: 500px;
    flex: 1;
}

.card-description p {
    font-size: 1rem;
    font-weight: lighter;
}

/* Additional Responsive Styles */
@media (max-width: 768px) {
    .col-md-6 {
        max-width: 100%;
    }
}


    </style>
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
                <li class="nav-item"><a class="nav-link" href="universities.php">Universities</a></li>
                <li class="nav-item"><a class="nav-link active" href="search.php" style="font-family: 'Montserrat', sans-serif; font-weight:bolder">Search</a></li>
                <li class="nav-item"><a class="nav-link" href="connect.html">Connect</a></li>
                <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Search Section -->
<div class="container my-5">
    <div class="search-option-card-container">
        <!-- Local University Search Option -->
        <div class="col-md-6">
            <div class="search-option-card" id="localSearchCard">
                <img src="Searchlocal.jpg" class="card-img" alt="Local University">
                <div class="card-body">
                    <h5 class="card-title">Local University Search</h5>
                    <p class="card-text">Find universities in your country based on your preferences.</p>
                    <a href="local-search.html" class="btn btn-light">Start Search</a>
                </div>
            </div>
            <div class="card-description card-description-local">
                <p>Looking for a university near you? Explore local options and begin your educational journey!</p>
            </div>
        </div>

        <!-- International University Search Option -->
        <div class="col-md-6">
            <div class="search-option-card" id="internationalSearchCard">
                <img src="searchinternational.jpg" class="card-img" alt="International University">
                <div class="card-body">
                    <h5 class="card-title">International University Search</h5>
                    <p class="card-text">Find universities abroad based on your criteria.</p>
                    <a href="international-search.html" class="btn btn-light">Start Search</a>
                </div>
            </div>
            <div class="card-description card-description-international">
                <p>Ready to study abroad? Discover global universities that fit your goals!</p>
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
<script src="script.js"></script>




</body>
</html>
