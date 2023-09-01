<?php
include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/UserModel.php";

class UserController
{
    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $userdao = new UserModel();

        $result = $userdao->getUser($username, $password, $role);

        if ($result) {
            $_SESSION["userid"] = $result["userid"];
            $_SESSION["username"] = $username;
            $_SESSION["empname"] = $result["lname"] . ", " . $result["fname"] . " " . $result["mname"];
            $_SESSION["empid"] = $result["empid"];
            $_SESSION["role"] = $role;

            switch ($role) {
                case 'cashier':
                    header("Location: /cashier");
                    break;
                case 'manager':
                    header("Location: /manage");
                    break;
                case 'personnel':
                    header("Location: /personnel");
                    break;
                default:
                    $_SESSION["error_message"] = "found but i don't know what to do with your role";
                    header("Location: /guest");
                    break;
            }
        } else {
            $_SESSION["error_message"] = "no user found";
            header("Location: /");
        }
    }

    public function logout()
    {
        // Destroy the user session
        session_start();
        session_unset();
        session_destroy();

        // Redirect the user to the login page or any other appropriate page
        header('Location: /login');
        exit;
    }
}
