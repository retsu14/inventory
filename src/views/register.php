<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Register</title>
</head>

<body class="flex items-center justify-center h-screen bg-gradient-to-r from-blue-50 to-blue-100">
    <div class="w-full max-w-sm p-6 bg-white rounded-lg shadow-lg">
        <div class="flex justify-center items-center mb-5"> <img src="../img/cpc.jpg" alt="" class="h-20 w-20">
        </div>
        <form id="registerForm" class="space-y-5">
            <!-- Username Input -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter your username" class="w-full mt-2 p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500 
                    focus:border-blue-500 placeholder-gray-400" />
            </div>
            <div id="errorMessageUser" class="hidden text-red-600 text-sm font-medium"></div>

            <!-- Password Input -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" class="w-full mt-2 p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500 
                    focus:border-blue-500 placeholder-gray-400" />
            </div>

            <!-- Error Message Placeholder -->
            <div id="errorMessage" class="hidden text-red-600 text-sm font-medium"></div>

            <!-- Register Button -->
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg 
                focus:ring-2 focus:ring-blue-500 focus:outline-none transition">Register</button>
        </form>

        <p class="mt-4 text-sm text-center text-gray-600">
            Already have an account?
            <a href="login.php" class="text-blue-600 hover:text-blue-500 font-medium">Login</a>
        </p>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../public/js/app.js"></script>
</body>

</html>