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
    $dive_duration = floatval($_POST['dive_duration']);
    $dive_depth = floatval($_POST['dive_depth']);    
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
    <title>Edit Session</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-4">
    <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Edit Session</h1>
        <form action="update_session.php" method="post">
            <input type="hidden" name="session_id" value="<?php echo $session_id; ?>">
            <div class="mb-4">
                <label for="dive_duration" class="block text-sm font-medium text-gray-700">Dive Duration:</label>
                <input type="number" id="dive_duration" name="dive_duration" step="0.01" value="<?php echo $session['dive_duration']; ?>" class="mt-1 p-2 border rounded w-full">
            </div>
            <div class="mb-4">
                <label for="dive_depth" class="block text-sm font-medium text-gray-700">Dive Depth:</label>
                <input type="number" id="dive_depth" name="dive_depth" step="0.01" value="<?php echo $session['dive_depth']; ?>" class="mt-1 p-2 border rounded w-full">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Session</button>
        </form>
    </div>
</body>
</html>

