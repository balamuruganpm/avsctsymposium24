<?php
session_start();

// Check if the form is submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the username and password are provided
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Define the admin credentials
        $admin_username = "admin"; // Change this to your desired admin username
        $admin_password = "password"; // Change this to your desired admin password

        // Retrieve the entered username and password from the form
        $entered_username = $_POST['username'];
        $entered_password = $_POST['password'];

        // Verify the credentials
        if ($entered_username === $admin_username && $entered_password === $admin_password) {
            // Authentication successful, set session variables
            $_SESSION['admin_logged_in'] = true;
            // Redirect to the admin dashboard
            header("Location: admin_dashboard.php");
            exit();
        } else {
            // Authentication failed, redirect back to the login page with an error message
            $_SESSION['login_error'] = "Invalid username or password.";
            header("Location: admin_login.php");
            exit();
        }
    } else {
        // If username or password is not provided, redirect back to the login page
        header("Location: admin_login.php");
        exit();
    }
} else {
    // If the form is not submitted with POST method, redirect back to the login page
    header("Location: admin_login.php");
    exit();
}
?>
