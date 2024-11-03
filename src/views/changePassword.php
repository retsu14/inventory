<?php $title = "Change Password"; include "../partials/header.php"; ?>

<div class="flex items-center justify-center h-screen bg-gray-100">
    <form id="changePasswordForm" class="w-full max-w-md bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-2xl font-semibold text-center mb-6 text-gray-800">Change Password</h2>

        <div class="mb-4">
            <label for="current_password" class="block text-gray-700 text-sm font-bold mb-2">Current Password</label>
            <input type="password" name="current_password" id="current_password" required
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <div class="mb-6">
            <label for="new_password" class="block text-gray-700 text-sm font-bold mb-2">New Password</label>
            <input type="password" name="new_password" id="new_password" required minlength="6"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <div class="flex flex-col gap-5"><button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
                Change Password
            </button>
            <a href="<?php echo ($_SESSION["role"] === 'admin') ? '../views/dashboard.php' : '../views/studentDashboard.php'; ?>"
                class="text-center w-full bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
                Go Back
            </a>
        </div>


        <div id="changePasswordError" class="text-red-500 text-center mt-4 hidden"></div>
    </form>
</div>

<?php include "../partials/footer.php"; ?>