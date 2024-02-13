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
        <h2 class="text-xl font-bold mb-4">Edit Training Session</h2>
        <form action="edit_session.php" method="post">
            <!-- Input fields for editing session details -->
            <!-- Example: -->
            <!-- <div class="mb-4">
                <label for="dive_duration" class="block text-gray-700 text-sm font-bold mb-2">Dive Duration (seconds)</label>
                <input type="number" id="dive_duration" name="dive_duration" value="<?php echo htmlspecialchars($session['dive_duration']); ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div> -->

            <!-- Add session ID as hidden input -->
            <!-- Example: -->
            <!-- <input type="hidden" name="session_id" value="<?php echo htmlspecialchars($session['session_id']); ?>"> -->

            <!-- Submit button for updating session -->
            <!-- Example: -->
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Session</button>
        </form>
    </div>
</body>
</html>
