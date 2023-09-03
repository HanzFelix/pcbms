<?php
$title = "Dashboard";
$error = "";

if (isset($_SESSION['error_message'])) {
    $error = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

$urlList = [
    ['url' => '/manage/supplier', 'title' => 'Manage Suppliers'],
    ['url' => '/manage/product', 'title' => 'Manage Products'],
    ['url' => '/manage/delivery', 'title' => 'Product Delivery'],
    ['url' => '/manage/order', 'title' => 'Manage Purchase Order'],
    ['url' => '/manage/expired', 'title' => 'Manage Expired Products'],
    ['url' => '/manage/returned', 'title' => 'Manage Returned Products']
];

ob_start();
?>
<!--Main-->
<main class="p-8 container mx-auto">
    <h1 class="text-center text-3xl font-bold">Store Management</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mt-8">
        <?php foreach ($urlList as $urlItem) : ?>
            <a href="<?= $urlItem['url'] ?>">
                <div class="flex justify-end flex-col border-l-4 border-accent/80 bg-accent/10 h-32 px-4 py-2">
                    <span class="font-bold text-2xl text-accent"><?= $urlItem['title'] ?></span>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</main>

<?php
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/resources/layouts/manager_layout.php';
?>