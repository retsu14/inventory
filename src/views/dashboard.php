<?php $title = "Dashboard"; include "../partials/header.php"; ?>

<?php include "../components/navbar.php"; 

// if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
//     header("Location: login.php");
//     exit();
// }
?>

<main class="flex">
    <aside><?php include "../components/sidebar.php" ?></aside>
    <div class="flex items-center justify-center h-screen w-full bg-gray-50" style="margin-left: 16rem">
        <div class="bg-white p-8 rounded shadow-md w-96 text-center">
            <h2 class="text-2xl mb-4">Welcome!</h2>
            <p>You are logged in.</p>
        </div>
    </div>
</main>

<?php include "../partials/footer.php" ?>