<?php  
require_once "../config/db.php";
require_once "../models/userInfo.php";

$database = new Database();
$db = $database->connect();
$userInfoModel = new UserInfo($db);
$user_id = $_SESSION['user_id'];

$userInfo = $userInfoModel->getByUserId($user_id);


?>
<nav class="bg-blue-600 shadow-lg fixed inset-x-0 z-50" role="navigation" aria-label="Main navigation">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center gap-2">
                <img src="../img/cpc2.png" alt="Logo" class="bg-white rounded-full h-12 w-12">
                <a href="#" class="text-xl font-bold text-white">Cordova Public College</a>
            </div>

            <!-- Links (Desktop) -->
            <div class="hidden md:flex space-x-6 text-white flex items-center gap-2">

                <?php echo "Welcome, " . $userInfo["first_name"];?>
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                    class="text-white focus:outline-none font-medium rounded-lg text-sm  py-2.5 text-center inline-flex items-center"
                    type="button" aria-expanded="false" aria-controls="dropdown">
                    <div class="relative w-9 h-9 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                        <svg class="absolute w-11 h-11 text-gray-400 -left-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>

                </button>

                <!-- Dropdown menu -->
                <div id="dropdown"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700" role="menu" aria-labelledby="dropdownDefaultButton">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" role="menu">
                        <li role="none">
                            <a href="../views/manageProfile.php"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Manage
                                Profile</a>
                        </li>
                        <li role="none">
                            <a href="../views/changePassword.php"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Change
                                Password</a>
                        </li>
                        <li role="none">
                            <a href="../views/logout.php"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Sign
                                out</a>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Hamburger Icon (Mobile) -->
            <div class="md:hidden flex items-center">
                <button id="menu-toggle" class="text-white focus:outline-none" aria-label="Toggle mobile menu" aria-expanded="false" aria-controls="mobile-menu">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu (Hidden by default) -->
    <div id="mobile-menu" class="md:hidden max-h-0 overflow-hidden transition-max-height bg-white shadow-xl" role="menu" aria-labelledby="menu-toggle">
        <div class="px-4 pt-4 pb-2 space-y-2">
            <a href="#" class="block text-gray-700 hover:text-indigo-600" role="menuitem">Home</a>
            <a href="#" class="block text-gray-700 hover:text-indigo-600" role="menuitem">About</a>
            <a href="#" class="block text-gray-700 hover:text-indigo-600" role="menuitem">Services</a>
            <a href="#" class="block text-gray-700 hover:text-indigo-600" role="menuitem">Contact</a>
        </div>
    </div>
</nav>

<!-- JavaScript for Mobile Menu Toggle -->
<script>
const menuToggle = document.getElementById('menu-toggle');
const mobileMenu = document.getElementById('mobile-menu');

menuToggle.addEventListener('click', () => {
    const isOpen = mobileMenu.style.maxHeight !== '0px' && mobileMenu.style.maxHeight !== '';
    mobileMenu.style.maxHeight = isOpen ? '0px' : mobileMenu.scrollHeight + 'px';
    menuToggle.setAttribute('aria-expanded', !isOpen);
});
</script>