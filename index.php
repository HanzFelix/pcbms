<?php
include "./headers/header.php";

session_start();

$error = "";
// Check if an error message exists
if (isset($_SESSION['error_message'])) {
    $error = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}
?>
<!--main-->
<div>
    <main class="container mx-auto">
        <form action="./login/loginAction.php" method="post" class="flex flex-col justify-center items-center">
            <input type="text" name="username" class="border border-blue-800" placeholder="Username">
            <input type="password" name="password" class="border border-blue-800" placeholder="Password">
            <select name="role" class="form-control" required id="">
                <option>manager</option>
                <option>cashier</option>
                <option>personnel</option>
            </select>
            <button type="submit" class="border-green-600 border">Login</button>
            <?= $error ?>
        </form>
    </main>
</div>

<?php
include "./footers/footer.php";
?>