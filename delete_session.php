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

// Check if session ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect to the dashboard or display an error message
    $_SESSION['error_message'] = "Invalid session ID.";
    header("Location: dashboard.php");
    exit();
}

// Get the session ID
$session_id = $_GET['id'];

// Query to fetch session details
$sql = "SELECT * FROM training_sessions WHERE session_id = '$session_id' AND user_id = '{$_SESSION['user_id']}'";
$result = mysqli_query($conn, $sql);

// Check if the session exists
if (mysqli_num_rows($result) == 0) {
    // Redirect to the dashboard or display an error message
    $_SESSION['error_message'] = "Session not found.";
    header("Location: dashboard.php");
    exit();
}

// Delete the session
$delete_sql = "DELETE FROM training_sessions WHERE session_id = '$session_id'";
if (mysqli_query($conn, $delete_sql)) {
    // Set success message
    $_SESSION['success_message'] = "Session deleted successfully.";
} else {
    // Set error message
    $_SESSION['error_message'] = "Error deleting session: " . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);

// Redirect back to the dashboard
header("Location: dashboard.php");
exit();
?>

