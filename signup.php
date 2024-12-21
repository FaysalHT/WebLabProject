<?php
// Include database connection file
include 'db.php'; // Ensure this file contains your DB connection code

// Check if the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt the password
    $academic_level = mysqli_real_escape_string($conn, $_POST['academic_level']);
    
    // Check if the email already exists
    $email_check = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $email_check);
    if (mysqli_num_rows($result) > 0) {
        echo "Email is already registered. Please log in.";
    } else {
        // Insert data into the users table
        $sql = "INSERT INTO users (fullname, email, password, academic_level) 
                VALUES ('$fullname', '$email', '$password', '$academic_level')";
        
        if (mysqli_query($conn, $sql)) {
            // Success: Show alert
            echo '<script>
                alert("Registration successful! You will be redirected to the login page.");
                window.location.href = "login.html";
            </script>';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // If the form was not submitted using POST, show an error message
    echo "Error: Invalid request method.";
}
?>
