<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freediving Training Log</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-blue-500">
    <div class="flex justify-between items-center p-4 ocean-bg">
        <h1 class="text-2xl font-bold text-white">Freediving Training Log</h1>
        <a href="register.php" class="text-white text-sm">Register</a>
    </div>
    <div class="flex justify-center items-center h-screen">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 login-card">
                <h2 class="text-xl mb-4 ocean-text">Login</h2>
                <form action="login.php" method="post" class="mb-4">
                    <div class="mb-4">
                        <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                        <input type="text" id="username" name="username"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter your username" required>
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <input type="password" id="password" name="password"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter your password" required>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Login</button>
                        <a href="#"
                            class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Forgot
                            Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="flex justify-center items-center h-20 ocean-bg">
        <p class="text-white">Footer Content</p>
    </footer>
</body>

</html>
