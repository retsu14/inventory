<?php $title = "Assign"; include "../partials/header.php"; ?>

<div class="flex items-center justify-center h-screen bg-gray-100">
    <form id="assignmentForm" class="w-full max-w-md bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-2xl font-semibold text-center mb-6 text-gray-800">Create Assignment</h2>

        <!-- <input type="hidden" name="student_id" value="58"> -->

        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Assignment Title</label>
            <input type="text" name="title" id="title" placeholder="Assignment Title" required
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Assignment Description</label>
            <textarea name="description" id="description" placeholder="Assignment Description" required
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>

        <div class="mb-4">
            <label for="due_date" class="block text-gray-700 text-sm font-bold mb-2">Due Date</label>
            <input type="datetime-local" name="due_date" id="due_date" required
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <div class="flex flex-col gap-5">
            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
                Create Assignment
            </button>
            <a href="<?php echo ($_SESSION["role"] === 'admin') ? '../views/dashboard.php' : '../views/studentDashboard.php'; ?>"
                class="text-center w-full bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
                Go Back
            </a>
        </div>

        <div id="assignmentError" class="text-red-500 text-center mt-4 hidden"></div>
    </form>
</div>

<?php include "../partials/footer.php"; ?>