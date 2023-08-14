<?php

// Start the session if not already started
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
        // Redirect the user to the login page or show an error page
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
