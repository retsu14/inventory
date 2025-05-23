<?php $title = "Assign"; include "../partials/header.php"; ?>


<?php include "../components/navbar.php"; 
require_once "../config/db.php";
require_once '../controllers/authController.php';

$database= new Database();
$db = $database->connect();
$controller = new AuthController();
$student_id = $_SESSION['user_id']; 
$assignment = new Assignment($db);
$assignments = $assignment->getByStudentId($student_id);
?>

<div class="flex">
    <div><?php include "../components/sidebarStudent.php" ?></div>

    <div class="flex justify-center mt-10 h-screen w-full" style="margin-left: 16rem">
        <div class="overflow-x-auto bg-white shadow-md rounded-lg w-full max-w-5xl">
            <table class="min-w-full border border-gray-200 text-gray-800">
                <thead>
                    <tr class="bg-blue-800 text-white">
                        <th class="py-3 px-6 text-left text-sm font-medium uppercase">Title</th>
                        <th class="py-3 px-6 text-left text-sm font-medium uppercase">Description</th>
                        <th class="py-3 px-6 text-left text-sm font-medium uppercase">Due Date</th>
                        <th class="py-3 px-6 text-left text-sm font-medium uppercase">Status</th>
                        <th class="py-3 px-6 text-left text-sm font-medium uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($assignments as $assignment): ?>
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="py-4 px-6"><?php echo htmlspecialchars($assignment['title']); ?></td>
                        <td class="py-4 px-6"><?php echo htmlspecialchars($assignment['description']); ?></td>
                        <td class="py-4 px-6"><?php echo htmlspecialchars($assignment['due_date']); ?></td>
                        <td class="py-4 px-6">
                            <span
                                class="inline-block px-3 py-1 text-xs font-semibold rounded-full 
                                <?php echo $assignment['status'] === 'done' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                                <?php echo htmlspecialchars($assignment['status']); ?>
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <?php if ($assignment['status'] !== 'done'): ?>
                            <button
                                class="mark-done bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200"
                                data-id="<?php echo $assignment['id']; ?>">
                                Mark as Done
                            </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php include "../partials/footer.php"; ?>