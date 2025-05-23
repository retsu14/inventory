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

    <div class="flex items-center justify-center h-screen  h-screen w-full" style="margin-left: 16rem">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($assignments as $assignment): ?>
                <tr>
                    <td><?php echo htmlspecialchars($assignment['title']); ?></td>
                    <td><?php echo htmlspecialchars($assignment['description']); ?></td>
                    <td><?php echo htmlspecialchars($assignment['due_date']); ?></td>
                    <td><?php echo htmlspecialchars($assignment['status']); ?></td>
                    <td>
                        <?php if ($assignment['status'] !== 'done'): ?>
                        <button class="mark-done" data-id="<?php echo $assignment['id']; ?>">Mark as Done</button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<?php include "../partials/footer.php"; ?>