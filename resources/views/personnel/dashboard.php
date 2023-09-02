<?php
$title = "Dashboard";
$error = "";

if (isset($_SESSION['error_message'])) {
    $error = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

include 'app/Controllers/DTRController.php';
$dtrController = new DTRController();
$state = $dtrController->hasLoggedInToday();
ob_start();
?>
<!--Main-->
<main class="p-4 container mx-auto">
    <h1 class="text-center text-3xl font-bold">DTR</h1>
    <section>
        <form action='/processDTR' method='post' class="flex justify-between items-end mb-2">
            <input type='text' name='empid' value='<?= $_SESSION['empid'] ?>' hidden>
            <input type='text' name='state' value='<?= $state ?>' hidden>
            <h2 class=" text-xl font-bold">Recent Logs</h2>
            <div>
                <button type='submit' class="bg-primary text-white py-2 px-4 rounded-md" name="submit" value='process-dtr'>CLOCK <?= strtoupper($state) ?></button>
            </div>
        </form>
        <div class="w-full overflow-x-auto">
            <?php $dtrController->getLogs() ?>
        </div>
    </section>
</main>

<?php
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/resources/layouts/personnel_layout.php';
?>