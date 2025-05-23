<?php $title = "Assignment"; include "../partials/header.php"; ?>

<?php  include "../components/navbar.php"; 
require_once '../controllers/authController.php';
$controller = new AuthController();
$assignments = json_decode($controller->getAllAssignments(), true);
?>

<div class="flex">
    <div><?php include "../components/sidebar.php"; ?></div>

    <div class="flex justify-center mt-10 h-screen w-full" style="margin-left: 16rem">
        <div class="overflow-x-auto bg-white shadow-md rounded-lg w-full max-w-5xl">
            <form id="batchDeleteForm">
                <button type="submit" class="mt-4 bg-red-500 text-white py-2 px-4 rounded">Delete Selected</button>
                <table class="min-w-full border border-gray-200 text-gray-800">
                    <thead>
                        <tr class="bg-blue-800 text-white">
                            <th class="py-3 px-6 text-left text-sm font-medium uppercase">Select</th>
                            <th class="py-3 px-6 text-left text-sm font-medium uppercase">Title</th>
                            <th class="py-3 px-6 text-left text-sm font-medium uppercase">Description</th>
                            <th class="py-3 px-6 text-left text-sm font-medium uppercase">Due Date</th>
                            <th class="py-3 px-6 text-left text-sm font-medium uppercase">Student ID</th>
                            <th class="py-3 px-6 text-left text-sm font-medium uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($assignments as $assignment): ?>
                        <tr class="hover:bg-gray-100 transition duration-200">
                            <td class="py-4 px-6">
                                <input type="checkbox" name="assignment_ids[]" value="<?php echo $assignment['id']; ?>">
                            </td>
                            <td class="py-4 px-6"><?php echo htmlspecialchars($assignment['title']); ?></td>
                            <td class="py-4 px-6"><?php echo htmlspecialchars($assignment['description']); ?></td>
                            <td class="py-4 px-6"><?php echo htmlspecialchars($assignment['due_date']); ?></td>
                            <td class="py-4 px-6"><?php echo htmlspecialchars($assignment['student_id']); ?></td>
                            <td class="py-4 px-6">
                                <span
                                    class="inline-block px-3 py-1 text-xs font-semibold rounded-full 
                                    <?php echo $assignment['status'] === 'Completed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                    <?php echo htmlspecialchars($assignment['status']); ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </form>
        </div>
    </div>
</div>






<?php include "../partials/footer.php"; ?>