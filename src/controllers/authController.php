<?php
session_start();

require_once '../config/db.php';
require_once '../models/user.php';
require_once '../models/userInfo.php';
require_once '../models/assignment.php';

class AuthController {
    private $user;
    private $userInfo;
    private $db; 

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect(); 
        $this->user = new User($this->db);
        $this->userInfo = new UserInfo($this->db); 
    }

    public function register($username, $password) {
       
        if ($this->user->exists($username)) {
            return json_encode(["status" => "error", "message" => "User already exists."]);
        }
    
        if ($this->user->create($username, $password)) {
            return json_encode(["status" => "success"]);
        }
    
        return json_encode(["status" => "error", "message" => "Registration failed."]);
    }
    

    public function login($username, $password) {
        $user = $this->user->login($username, $password);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
    
            if (!$this->user->isFullyRegistered($user['id'])) {
                echo json_encode(["status" => "success", "redirect" => 'onboarding.php']);
                exit();
            }
           
            if ($user['role'] === 'admin') {
                echo json_encode(["status" => "success", "redirect" => 'dashboard.php']);
            } elseif ($user['role'] === 'student') {
                echo json_encode(["status" => "success", "redirect" => 'studentDashboard.php']);
            } else {
                echo json_encode(["status" => "error", "message" => "User role not recognized."]);
            }
    
            if ($this->user->isFullyRegistered($user['id'])) {
                $userInfo = $this->userInfo->getByUserId($user['id']);
                if ($userInfo) {
                    $_SESSION['first_name'] = $userInfo['first_name'];
                    $_SESSION['last_name'] = $userInfo['last_name'];
                    $_SESSION['email'] = $userInfo['email'];
                    $_SESSION['address'] = $userInfo['address'];
                    $_SESSION['contact_number'] = $userInfo['contact_number'];
                    $_SESSION['birthday'] = $userInfo['birthday'];
                }
            }
            exit();
        } else {
            return json_encode(["status" => "error", "message" => "Invalid login credentials."]);
        }
    }
    

    public function onboard($first_name, $last_name, $email, $address, $contact_number, $birthday) {
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            if ($this->userInfo->create($user_id, $first_name, $last_name, $email, $address, $contact_number, $birthday)) {
                $this->user->setFullyRegistered($user_id);

                $userInfo = $this->userInfo->getByUserId($user_id);
                if ($userInfo) {
                    $_SESSION['first_name'] = $userInfo['first_name'];
                    $_SESSION['last_name'] = $userInfo['last_name'];
                    $_SESSION['email'] = $userInfo['email'];
                    $_SESSION['address'] = $userInfo['address'];
                    $_SESSION['contact_number'] = $userInfo['contact_number'];
                    $_SESSION['birthday'] = $userInfo['birthday'];
                }
                return json_encode(["status" => "success"]);
            }
        }
        return json_encode(["status" => "error"]);
    }

    public function updateProfile($user_id, $first_name, $last_name, $email, $address, $contact_number, $birthday) {
        if ($this->userInfo->update($user_id, $first_name, $last_name, $email, $address, $contact_number, $birthday)) {
            return json_encode(["status" => "success", "message" => "Profile updated successfully."]);
        }
        return json_encode(["status" => "error", "message" => "Failed to update profile."]);
    }
    
    public function changePassword($user_id, $current_password, $new_password) {
        $user = $this->user->getById($user_id);
        
        if ($user && password_verify($current_password, $user['password'])) {
            $new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);
            if ($this->user->updatePassword($user_id, $new_password_hash)) {
                return json_encode(["status" => "success", "message" => "Password changed successfully."]);
            } else {
                return json_encode(["status" => "error", "message" => "Failed to change password."]);
            }
        } else {
            return json_encode(["status" => "error", "message" => "Current password is incorrect."]);
        }
    }

    public function assignTasksToAllStudents($title, $description, $due_date) {
    $assignment = new Assignment($this->db);
    $student_ids = $assignment->getAllStudentIds();

    $errors = [];
    foreach ($student_ids as $student_id) {
        if (!$assignment->create($student_id, $title, $description, $due_date)) {
            $errors[] = "Failed to assign to student ID: $student_id";
        }
    }

    if (empty($errors)) {
        return json_encode(["status" => "success", "message" => "Assignment created for all students."]);
    } else {
        return json_encode(["status" => "error", "message" => "Some assignments failed.", "errors" => $errors]);
    }
}


    public function getAllAssignments() {
        $assignment = new Assignment($this->db);
        $assignments = $assignment->getAll();
        return json_encode($assignments);
    }
    
    public function markAssignmentAsDone($assignment_id) {
        $assignment = new Assignment($this->db);
        if ($assignment->markAsDone($assignment_id)) {
            return json_encode(["status" => "success", "message" => "Assignment marked as done."]);
        }
        return json_encode(["status" => "error", "message" => "Failed to mark assignment as done."]);
    }
    
    public function batchDeleteAssignments($assignment_ids) {
        $assignment = new Assignment($this->db);
        $errors = [];
        
        foreach ($assignment_ids as $assignment_id) {
            if (!$assignment->delete($assignment_id)) {
                $errors[] = "Failed to delete assignment ID: $assignment_id";
            }
        }
    
        if (empty($errors)) {
            return json_encode(["status" => "success", "message" => "All selected assignments deleted successfully."]);
        } else {
            return json_encode(["status" => "error", "message" => "Some deletions failed.", "errors" => $errors]);
        }
    }
    
    
    public function logout(){
        session_start();
        header('Location: login.php');
        session_destroy();
        exit();
    }
}
?>