<?php
// Include database connection
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Retrieve user from database
    $sql = "SELECT * FROM users WHERE username='$username' OR email='$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Verify password
    if ($row && password_verify($password, $row['password'])) {
        // Start session
        session_start();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        header("Location: dashboard.php"); // Redirect to dashboard
    } else {
        echo "Invalid username/email or password.";
    }
}

// Close database connection
mysqli_close($conn);
?>
