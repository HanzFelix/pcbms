<?php
$title = "Dashboard";
$error = "";
// Check if an error message exists
if (isset($_SESSION['error_message'])) {
    $error = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

ob_start();
?>
<!--Main-->
<main class="p-4">
    <h1 class="text-center text-3xl font-bold">Purchase Order Managemnt</h1>
</main>

<?php
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/resources/layouts/manager_layout.php';
?>