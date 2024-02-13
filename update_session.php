<?php
// Include database connection
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $session_id = mysqli_real_escape_string($conn, $_POST['session_id']);
    // Retrieve other form data

    // Update training session in the database
    $sql = "UPDATE training_sessions SET dive_duration = '$dive_duration', dive_depth = '$dive_depth', location = '$location', notes = '$notes' WHERE session_id = '$session_id'";
    if (mysqli_query($conn, $sql)) {
        // Redirect back to dashboard with success message
        header("Location: dashboard.php?success=2");
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
    <title>Update Session - Freediving Training Log</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-xl font-bold mb-4">Update Training Session</h2>
        <form action="update_session_process.php" method="post">
            <!-- Hidden input for session ID -->
            <input type="hidden" name="session_id" value="<?php echo htmlspecialchars($session['session_id']); ?>">
            <div class="mb-4">
                <label for="dive_duration" class="block text-gray-700 text-sm font-bold mb-2">Dive Duration
                    (seconds)</label>
                <input type="number" id="dive_duration" name="dive_duration"
                    value="<?php echo htmlspecialchars($session['dive_duration']); ?>"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
            </div>
            <div class="mb-4">
                <label for="dive_depth" class="block text-gray-700 text-sm font-bold mb-2">Dive Depth (meters)</label>
                <input type="number" id="dive_depth" name="dive_depth"
                    value="<?php echo htmlspecialchars($session['dive_depth']); ?>"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
            </div>
            <div class="mb-4">
                <label for="location" class="block text-gray-700 text-sm font-bold mb-2">Location</label>
                <input type="text" id="location" name="location"
                    value="<?php echo htmlspecialchars($session['location']); ?>"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
            </div>
            <div class="mb-4">
                <label for="notes" class="block text-gray-700 text-sm font-bold mb-2">Notes</label>
                <textarea id="notes" name="notes" rows="3"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?php echo htmlspecialchars($session['notes']); ?></textarea>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update
                Session</button>
        </form>
    </div>
</body>

</html>