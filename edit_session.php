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
    header("Location: dashboard.php");
    exit();
}

// Fetch session details
$session = mysqli_fetch_assoc($result);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $dive_duration = mysqli_real_escape_string($conn, $_POST['dive_duration']);
    $dive_depth = mysqli_real_escape_string($conn, $_POST['dive_depth']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $notes = mysqli_real_escape_string($conn, $_POST['notes']);

    // Update training session in the database
    $update_sql = "UPDATE training_sessions SET dive_duration = '$dive_duration', dive_depth = '$dive_depth', location = '$location', notes = '$notes' WHERE session_id = '$session_id'";

    if (mysqli_query($conn, $update_sql)) {
        // Redirect back to dashboard with success message
        $_SESSION['success_message'] = "Session updated successfully.";
        header("Location: dashboard.php");
        exit();
    } else {
        // Handle database update error
        echo "Error updating session: " . mysqli_error($conn);
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
    <title>Edit Session - Freediving Training Log</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-blue-500">
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-xl font-bold mb-4">Edit Training Session</h2>
        <form action="update_session.php" method="post">
            <!-- Input fields for editing session details -->
            <div class="mb-4">
                <label for="dive_duration" class="block text-gray-700 text-sm font-bold mb-2">Dive Duration (seconds)</label>
                <input type="number" id="dive_duration" name="dive_duration" value="<?php echo htmlspecialchars($session['dive_duration']); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="dive_depth" class="block text-gray-700 text-sm font-bold mb-2">Dive Depth</label>
                <input type="number" id="dive_depth" name="dive_depth" value="<?php echo htmlspecialchars($session['dive_depth']); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="location" class="block text-gray-700 text-sm font-bold mb-2">Location</label>
                <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($session['location']); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="notes" class="block text-gray-700 text-sm font-bold mb-2">Notes</label>
                <textarea id="notes" name="notes" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo htmlspecialchars($session['notes']); ?></textarea>
            </div>

            <!-- Add session ID as hidden input -->
            <input type="hidden" name="session_id" value="<?php echo htmlspecialchars($session['session_id']); ?>">

            <!-- Submit button for updating session -->
            <button type="submit" class="bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Session</button>
        </form>
    </div>
</body>
</html>