<?php
include $_SERVER['DOCUMENT_ROOT'] . "/app/auth.php";
requireLogin(true);

// Continue with other application logic
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
    <link rel="icon" href="images/vsulogo.ico" />
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
                    <!--li>
                        <button id="dropdownHoverButton" data-dropdown-toggle="dropdownReceive" data-dropdown-trigger="hover" class="text-white text-center inline-flex items-center" type="button">
                            Receive Delivery
                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <!-- Dropdown menu ->
                        <div id="dropdownReceive" class="z-10 hidden bg-shade divide-y divide-gray-100 rounded-lg shadow w-44">
                            <ul class="py-2 text-sm text-txt " aria-labelledby="dropdownHoverButton">
                                <li>
                                    <a href="/manage/supplier" class="block px-4 py-2 hover:bg-accent hover:text-white">
                                        Manage Suppliers
                                    </a>
                                </li>
                                <li>
                                    <a href="/manage/product" class="block px-4 py-2 hover:bg-accent hover:text-white">
                                        Manage Products
                                    </a>
                                </li>
                                <li>
                                    <a href="/manage/delivery" class="block px-4 py-2 hover:bg-accent hover:text-white">
                                        Product Delivery
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <button id="dropdownHoverButton" data-dropdown-toggle="dropdownProduct" data-dropdown-trigger="hover" class="text-white text-center inline-flex items-center" type="button">
                            Order Products
                            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <!-- Dropdown menu ->
                        <div id="dropdownProduct" class="z-10 hidden bg-shade divide-y divide-gray-100 rounded-lg shadow w-44">
                            <ul class="py-2 text-sm text-txt " aria-labelledby="dropdownHoverButton">
                                <li>
                                    <a href="#" class="block px-4 py-2 hover:bg-accent hover:text-white">
                                        Manage Purchase Order
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 hover:bg-accent hover:text-white">
                                        Manage Expired Products
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li-->
                    <li>
                        <a class="dropdown-item" href="/sales">Sales</a>
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