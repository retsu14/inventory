<?php $title = "Dashboard";  include "../partials/header.php"; ?>

<?php include "../components/navbar.php"; 

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}?>

<div class="flex">
    <div><?php include "../components/sidebarStudent.php" ?></div>

    <div class="flex items-center justify-center h-screen  h-screen w-full" style="margin-left: 16rem">
        <div class="bg-white p-8 rounded shadow-md w-96">
            <h2 class="text-2xl mb-4">Student</h2>
            <p>You are logged in.</p>
        </div>
    </div>
</div>


<?php include "../partials/footer.php" ?>