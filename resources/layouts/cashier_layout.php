<?php
include $_SERVER['DOCUMENT_ROOT'] . "/app/auth.php";
requireLogin(true);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title; ?> - VSU PCBMS (Cashier)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        txt: '#072227',
                        shade: '#eefafc',
                        primary: '#449748',
                        secondary: '#d3f3f8',
                        accent: '#384470',
                    }
                }
            }
        }
    </script>
    <link rel="icon" href="/public/img/vsulogo.ico" />
    <link rel="stylesheet" href="/public/css/custom.css">
</head>

<body class="bg-shade text-txt">
    <header class="sticky w-full flex flex-col">
        <nav class="bg-accent py-4 px-4">
            <div class="container mx-auto flex justify-between text-white">
                <h1 class="font-black text-xl">Cashier Overview</h1>
                <ul class="flex gap-4">
                    <li>
                        <a href="/personnel">
                            Home
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="/cashier/sale">Sales</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="/logout">Log out</a>
                    </li>
                </ul>
            </div>
        </nav>
        <section class=" px-4 bg-accent bg-opacity-50 py-2 text-white font-semibold">
            <div class="container mx-auto justify-between flex">
                <h2><?= $_SESSION["empname"] . " - " . $_SESSION["role"] ?></h2>
                <h2><?= date('m/d/Y H:i A') ?></h2>
            </div>
        </section>
    </header>
    <?php echo $content; ?>
    <?php echo $error; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

</html>