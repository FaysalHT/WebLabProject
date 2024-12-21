<?php
// Include database connection file
include 'db.php'; // Ensure this file contains your DB connection code

// Start session to manage login state (for later use, e.g., for remembering the user)
session_start();

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password']; // Plain password (will hash compare later)

    // Query to check if the email exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // Fetch user data from the database
        $user = mysqli_fetch_assoc($result);
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Login successful, start session
            $_SESSION['user_id'] = $user['id']; // Store user ID in session
            $_SESSION['user_email'] = $user['email']; // Store email for later use
            
            // Optionally, you can store 'remember me' state in cookies
            if (isset($_POST['remember'])) {
                setcookie('email', $email, time() + (86400 * 30), "/"); // Remember user for 30 days
            }

            // Redirect to a logged-in page (e.g., user dashboard or home)
            header("Location: dashboard.php"); // You can change this to wherever you want users to go after login
            exit();
        } else {
            // Password is incorrect
            echo '<script>alert("Invalid password!"); window.location.href = "login.html";</script>';
        }
    } else {
        // Email not found
        echo '<script>alert("Email not registered! Please sign up."); window.location.href = "signup.html";</script>';
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // If the form wasn't submitted via POST, redirect back to login page
    header("Location: login.html");
    exit();
}
?>
