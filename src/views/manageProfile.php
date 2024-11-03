<?php $title = "Manage Profile";  include "../partials/header.php"; ?>

<?php  
require_once "../config/db.php";
require_once "../models/userInfo.php";

$database = new Database();
$db = $database->connect();
$userInfoModel = new UserInfo($db);
$user_id = $_SESSION['user_id'];

// Fetch user information from the database
$userInfo = $userInfoModel->getByUserId($user_id);

if (!$userInfo) {
    echo "User information not found.";
    exit();
}
?>
<div class="bg-gray-100">
    <div class="container mx-auto  py-12 px-4">
        <div class="max-w-lg mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
            <form id="updateProfileForm" class="p-8">
                <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Update Profile</h2>

                <div class="mb-4">
                    <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">First Name</label>
                    <input type="text" id="first_name" name="first_name"
                        value="<?php echo htmlspecialchars($userInfo['first_name']); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2">Last Name</label>
                    <input type="text" id="last_name" name="last_name"
                        value="<?php echo htmlspecialchars($userInfo['last_name']); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="email" id="email" name="email"
                        value="<?php echo htmlspecialchars($userInfo['email']); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                    <input type="text" id="address" name="address"
                        value="<?php echo htmlspecialchars($userInfo['address']); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="contact_number" class="block text-gray-700 text-sm font-bold mb-2">Contact
                        Number</label>
                    <input type="text" id="contact_number" name="contact_number"
                        value="<?php echo htmlspecialchars($userInfo['contact_number']); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-6">
                    <label for="birthday" class="block text-gray-700 text-sm font-bold mb-2">Birthday</label>
                    <input type="date" id="birthday" name="birthday"
                        value="<?php echo htmlspecialchars($userInfo['birthday']); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex gap-4 justify-between">
                    <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
                        Update Profile
                    </button>
                    <a href="<?php echo ($_SESSION["role"] === 'admin') ? '../views/dashboard.php' : '../views/studentDashboard.php'; ?>"
                        class="w-full text-center bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 rounded focus:outline-none focus:ring-2 focus:ring-gray-600">
                        Go Back
                    </a>
                </div>

                <div id="updateErrorMessage" class="text-red-500 text-xs text-center hidden mt-4"></div>
            </form>
        </div>
    </div>
</div>



<?php include "../partials/footer.php" ?>