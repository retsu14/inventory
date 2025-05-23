<?php
require_once '../controllers/authController.php';

$action = isset($_POST['action']) ? $_POST['action'] : null;
$controller = new AuthController();

switch ($action) {
    case 'register':
        $username = $_POST['username'];
        $password = $_POST['password'];
        echo $controller->register($username, $password);
        break;

    case 'login':
        $username = $_POST['username'];
        $password = $_POST['password'];
        echo $controller->login($username, $password);
        break;

    case 'onboard':
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $address = $_POST["address"];
        $contact_number = $_POST["contact_number"];
        $birthday = $_POST["birthday"];
        echo $controller->onboard($first_name, $last_name, $email, $address, $contact_number, $birthday);
        break;
    
    case 'updateProfile':
        $user_id = $_SESSION['user_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $address = $_POST["address"];
        $contact_number = $_POST["contact_number"];
        $birthday = $_POST["birthday"];
        echo $controller->updateProfile($user_id, $first_name, $last_name, $email, $address, $contact_number, $birthday);
        break;
        
    case 'changePassword':
        $user_id = $_SESSION['user_id'];
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        echo $controller->changePassword($user_id, $current_password, $new_password);
        break;
    
    case 'assignTasksToAllStudents':
        $title = $_POST['title'];
        $description = $_POST['description'];
        $due_date = $_POST['due_date'];
        echo $controller->assignTasksToAllStudents($title, $description, $due_date);
        break;
        
    case 'getAllAssignments':
        echo $controller->getAllAssignments();
        break;
        
    case 'markAssignmentAsDone':
        $assignment_id = $_POST['assignment_id'];
        echo $controller->markAssignmentAsDone($assignment_id);
        break;
    case 'batchDeleteAssignments':
        $assignment_ids = $_POST['assignment_ids'] ?? [];
        echo $controller->batchDeleteAssignments($assignment_ids);
        break;
        

    default:
        echo json_encode(["status" => "error", "message" => "Invalid action."]);
        break;
}
?>