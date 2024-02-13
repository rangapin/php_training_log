<?php
// Include database connection
include 'db_connection.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $user_id = $_SESSION['user_id']; // Retrieve user ID from the session
    $dive_duration = mysqli_real_escape_string($conn, $_POST['dive_duration']);
    $dive_depth = mysqli_real_escape_string($conn, $_POST['dive_depth']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $notes = mysqli_real_escape_string($conn, $_POST['notes']);
    $session_date = date("Y-m-d"); // Get current date in YYYY-MM-DD format

    // Insert training session into database
    $sql = "INSERT INTO training_sessions (user_id, dive_duration, dive_depth, location, notes, session_date) VALUES ('$user_id', '$dive_duration', '$dive_depth', '$location', '$notes', '$session_date')";
    if (mysqli_query($conn, $sql)) {
        // Set success message
        $_SESSION['success_message'] = "Session added successfully.";

        // Redirect back to dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close database connection
mysqli_close($conn);
?>