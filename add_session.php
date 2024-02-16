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
        // Redirect back to dashboard with success message
        header("Location: dashboard.php?success=1");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add New Session - Freediving Training Log</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <body class="bg-blue-500">
        <div class="container mx-auto px-4 py-8">
            <h2 class="text-xl font-bold mb-4">Add New Session</h2>
            <form action="add_session_process.php" method="post">
                <div class="mb-4">
                    <label for="dive_duration" class="block text-gray-700 text-sm font-bold mb-2">Dive Duration
                        (seconds)</label>
                    <input type="number" step="0.01" id="dive_duration" name="dive_duration"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required>
                </div>
                <div class="mb-4">
                    <label for="dive_depth" class="block text-gray-700 text-sm font-bold mb-2">Dive Depth
                        (meters)</label>
                    <input type="number" step="0.01" id="dive_depth" name="dive_depth"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required>
                </div>
                <div class="mb-4">
                    <label for="location" class="block text-gray-700 text-sm font-bold mb-2">Location</label>
                    <input type="text" id="location" name="location"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required>
                </div>
                <div class="mb-4">
                    <label for="notes" class="block text-gray-700 text-sm font-bold mb-2">Notes</label>
                    <textarea id="notes" name="notes" rows="3"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
                <button type="submit" class="bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add
                    Session</button>
            </form>
        </div>
    </body>

    </html>