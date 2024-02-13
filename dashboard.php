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

// Fetch training sessions for the logged-in user
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM training_sessions WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Freediving Training Log</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-xl font-bold mb-4">My Training Sessions</h2>
        <a href="add_session.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Add New Session</a>
        
        <?php
        // Check if there are any training sessions
        if (mysqli_num_rows($result) > 0) {
            // Loop through each training session and display them
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='bg-white shadow-md rounded p-4 mb-4'>";
                echo "<p><strong>Date:</strong> " . $row['session_date'] . "</p>";
                echo "<p><strong>Dive Duration:</strong> " . $row['dive_duration'] . " seconds</p>";
                echo "<p><strong>Dive Depth:</strong> " . $row['dive_depth'] . " meters</p>";
                echo "<p><strong>Location:</strong> " . $row['location'] . "</p>";
                echo "<p><strong>Notes:</strong> " . $row['notes'] . "</p>";
                
                // Edit and delete buttons
                echo "<div class='mt-4'>";
                echo "<a href='edit_session.php?id=" . $row['session_id'] . "' class='bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2'>Edit</a>";
                echo "<a href='delete_session.php?id=" . $row['session_id'] . "' class='bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded'>Delete</a>";
                echo "</div>";
                
                echo "</div>";
            }
        } else {
            echo "<p>No training sessions found.</p>";
        }
        ?>
    </div>
</body>
</html>
