<?php
$title = "Dashboard";
$error = "";
// Check if an error message exists
if (isset($_SESSION['error_message'])) {
    $error = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

$consignedDetailsHeaderLabels = [
    "Date",
    "Time",
    "Log State",
];


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
            <table class="text-left rounded-md overflow-hidden w-full">
                <thead class="bg-accent bg-opacity-75 text-white border-primary sticky divide-x divide-white">
                    <?php
                    foreach ($consignedDetailsHeaderLabels as $label) {
                        echo "<th class='px-4 py-2'>$label</th>";
                    }
                    ?>
                </thead>
                <tbody>
                    <?= $dtrController->getLogs() ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/resources/layouts/personnel_layout.php';
?>