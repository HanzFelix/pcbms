<?php
include "../models/userDAO.php";

$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

$userdao = new UserDAO();

$result = $userdao->getUser($username, $password, $role);

if ($result) {
    $_SESSION["userid"] = $row["userid"];
    $_SESSION["username"] = $username;
    $_SESSION["role"] = $role;

    switch ($role) {
        case 'cashier':
            header("Location: ../pos/");
            break;
        case 'manager':
            header("Location: ../manage/");
            break;
        case 'personnel':
            header("Location: ../dtr/");
            break;
        default:
            $_SESSION["error_message"] = "found but i don't know what to do with your role";
            header("Location: ../");
            break;
    }
} else {
    header("Location: ../");
}
