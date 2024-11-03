<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
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
    <title>Onboarding</title>
    <style>
    .hidden {
        display: none;
    }
    </style>
</head>

<body class="flex items-center justify-center h-screen bg-gradient-to-r from-blue-50 to-blue-100">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-3xl font-semibold text-center text-gray-700 mb-6">Complete Your Profile</h2>
        <p class="text-center text-gray-600 mb-4">We need some information to set up your account.</p>

        <form id="onboardForm" class="space-y-5">
            <!-- Page 1 -->
            <div id="page1" class="page flex flex-col gap-3">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" name="first_name" id="first_name" placeholder="Enter your first name"
                        class="mt-2 p-2.5 border rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400" />
                    <p id="firstNameError" class="text-red-500 text-xs hidden">Please enter your first name.</p>
                </div>

                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" name="last_name" id="last_name" placeholder="Enter your last name"
                        class="mt-2 p-2.5 border rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400" />
                    <p id="lastNameError" class="text-red-500 text-xs hidden">Please enter your last name.</p>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email"
                        class="mt-2 p-2.5 border rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400" />
                    <p id="emailError" class="text-red-500 text-xs hidden">Please enter a valid email address.</p>
                </div>
            </div>

            <!-- Page 2 -->
            <div id="page2" class="page flex flex-col gap-3 hidden">
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" name="address" id="address" placeholder="Enter your address"
                        class="mt-2 p-2.5 border rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400" />
                    <p id="addressError" class="text-red-500 text-xs hidden">Please enter your address.</p>
                </div>

                <div>
                    <label for="contact_number" class="block text-sm font-medium text-gray-700">Contact Number</label>
                    <input type="tel" name="contact_number" id="contact_number" placeholder="Enter your contact number"
                        class="mt-2 p-2.5 border rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400" />
                    <p id="contactError" class="text-red-500 text-xs hidden">Please enter a valid contact number.</p>
                </div>

                <div>
                    <label for="birthday" class="block text-sm font-medium text-gray-700">Birthday</label>
                    <input type="date" name="birthday" id="birthday"
                        class="mt-2 p-2.5 border rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400" />
                    <p id="birthdayError" class="text-red-500 text-xs hidden">Please select your birthday.</p>
                </div>
            </div>

            <div class="flex gap-5 justify-between">
                <button type="button" id="prevButton"
                    class="hidden w-1/2 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 rounded-lg transition duration-200 ease-in-out">Previous</button>
                <button type="button" id="nextButton"
                    class="w-1/2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-200 ease-in-out">Next</button>
                <button type="submit" id="submitButton"
                    class="hidden w-1/2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-200 ease-in-out">Complete
                </button>
            </div>

        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../public/js/app.js"></script>
    <script>
    $(document).ready(function() {
        let currentPage = 1;

        // Function to validate email format
        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Simple email regex
            return re.test(String(email).toLowerCase());
        }

        // Function to validate contact number (Assuming a general format, adjust as needed)
        function validateContactNumber(contactNumber) {
            const re = /^[0-9]{10,15}$/; // Assuming a 10 to 15 digit number
            return re.test(String(contactNumber).trim());
        }

        $('#nextButton').on('click', function() {
            if (currentPage === 1) {
                // Validate page 1 inputs
                const firstName = $('#first_name').val().trim();
                const lastName = $('#last_name').val().trim();
                const email = $('#email').val().trim();
                let isValid = true;

                // Clear previous error messages
                $('#firstNameError, #lastNameError, #emailError').addClass('hidden');

                // Check if fields are empty
                if (!firstName) {
                    $('#firstNameError').removeClass('hidden');
                    isValid = false;
                }
                if (!lastName) {
                    $('#lastNameError').removeClass('hidden');
                    isValid = false;
                }
                if (!email) {
                    $('#emailError').removeClass('hidden');
                    isValid = false;
                } else if (!validateEmail(email)) {
                    $('#emailError').removeClass('hidden');
                    isValid = false;
                }

                // Proceed if valid
                if (isValid) {
                    $('#page1').addClass('hidden');
                    $('#page2').removeClass('hidden');
                    $('#prevButton').removeClass('hidden');
                    $('#nextButton').addClass('hidden');
                    $('#submitButton').removeClass('hidden');
                    currentPage++;
                }
            } else if (currentPage === 2) {
                // Validate page 2 inputs
                const address = $('#address').val().trim();
                const contactNumber = $('#contact_number').val().trim();
                const birthday = $('#birthday').val().trim();
                let isValid = true;

                // Clear previous error messages
                $('#addressError, #contactError, #birthdayError').addClass('hidden');

                // Check if fields are empty
                if (!address) {
                    $('#addressError').removeClass('hidden');
                    isValid = false;
                }
                if (!validateContactNumber(contactNumber)) {
                    $('#contactError').removeClass('hidden');
                    isValid = false;
                }
                if (!birthday) {
                    $('#birthdayError').removeClass('hidden');
                    isValid = false;
                }

                // Proceed if valid
                if (isValid) {
                    $('#onboardForm').submit(); // Submit the form if all validations pass
                }
            }
        });

        $('#prevButton').on('click', function() {
            if (currentPage === 2) {
                $('#page2').addClass('hidden');
                $('#page1').removeClass('hidden');
                $('#prevButton').addClass('hidden');
                $('#nextButton').removeClass('hidden');
                $('#submitButton').addClass('hidden');
                currentPage--;
            }
        });
    });
    </script>
</body>

</html>