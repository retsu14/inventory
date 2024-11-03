<?php
session_start();

require_once '../config/db.php';
require_once '../models/user.php';
require_once '../models/userInfo.php';

class AuthController {
    private $user;
    private $userInfo;

    public function __construct() {
        $database = new Database();
        $db = $database->connect();
        $this->user = new User($db);
        $this->userInfo = new UserInfo($db);
    }

    public function register($username, $password) {
        // Check if the user already exists
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
    
            // Redirect based on user role
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
    
    public function logout(){
        session_start();
        header('Location: login.php');
        session_destroy();
        exit();
    }
}
?>