<?php
$title = "Deliveries";
$error = "";

if (isset($_SESSION['error_message'])) {
    $error = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

ob_start();
?>
<!--Main-->
<main class="container mx-auto bg-shade">
    <h2 class="text-center text-3xl p-4 font-bold">Consigned Detail CRUD</h2>
    <div class="flex items-center justify-end gap-2 my-2">
        <button onclick="newConsignedDetails()" class="bg-primary text-white py-2 px-4 rounded-md" id="new-button">NEW DELIVERY</button>
    </div>
    <div class="w-full overflow-x-auto" id="cdtable">
        ...
    </div>
    <?= $error ?>
</main>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/resources/partials/delivery_dialogs.php';
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/resources/layouts/manager_layout.php';
?>