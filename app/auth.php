<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isUserLoggedIn()
{
    return isset($_SESSION['username']);
}

function requireLogin($bool)
{
    if (!isUserLoggedIn() && $bool) {
        header('Location: /login');
    } elseif (isUserLoggedIn() && !$bool) {
        switch ($_SESSION['role']) {
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
    }
}
