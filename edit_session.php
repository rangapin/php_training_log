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
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6">Edit Training Session</h2>
        <a href="dashboard.php" class="bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Dashboard</a>
        <form action="update_session.php" method="post">
            <!-- Hidden input for session ID -->
            <input type="hidden" name="session_id" value="<?php echo htmlspecialchars($session['session_id']); ?>">
            
            <!-- Dive Duration Input -->
            <div class="mb-6">
                <label for="dive_duration" class="block text-gray-700 text-sm font-bold mb-2">Dive Duration (minutes)</label>
                <input type="number" step="0.01" id="dive_duration" name="dive_duration"
                    class="w-full px-3 py-2 leading-tight border rounded-md text-gray-700 shadow-sm focus:outline-none focus:shadow-outline"
                    value="<?php echo htmlspecialchars($session['dive_duration']); ?>" required>
            </div>
            
            <!-- Dive Depth Input -->
            <div class="mb-6">
                <label for="dive_depth" class="block text-gray-700 text-sm font-bold mb-2">Dive Depth (meters)</label>
                <input type="number" step="0.01" id="dive_depth" name="dive_depth"
                    class="w-full px-3 py-2 leading-tight border rounded-md text-gray-700 shadow-sm focus:outline-none focus:shadow-outline"
                    value="<?php echo htmlspecialchars($session['dive_depth']); ?>" required>
            </div>
            
            <!-- Location Input -->
            <div class="mb-6">
                <label for="location" class="block text-gray-700 text-sm font-bold mb-2">Location</label>
                <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($session['location']); ?>"
                    class="w-full px-3 py-2 leading-tight border rounded-md text-gray-700 shadow-sm focus:outline-none focus:shadow-outline"
                    required>
            </div>
            
            <!-- Notes Input -->
            <div class="mb-6">
                <label for="notes" class="block text-gray-700 text-sm font-bold mb-2">Notes</label>
                <textarea id="notes" name="notes" rows="3"
                    class="w-full px-3 py-2 leading-tight border rounded-md text-gray-700 shadow-sm focus:outline-none focus:shadow-outline"><?php echo htmlspecialchars($session['notes']); ?></textarea>
            </div>
            
            <!-- Submit Button -->
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Session</button>
        </form>
    </div>
</body>
</html>
