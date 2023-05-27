<?php

session_start();
$sessionuser = $_SESSION["username"] . " - " . $_SESSION["role"];
?>
<header class="sticky w-full flex flex-col">
    <nav class="bg-accent py-4">
        <div class="container mx-auto flex justify-between text-white">
            <h1 class="font-black text-xl">Store Management</h1>
            <ul class="flex gap-4">
                <li>Home</li>
                <li>
                    <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover" class="text-white text-center inline-flex items-center" type="button">
                        Receive Delivery
                        <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownHover" class="z-10 hidden bg-shade divide-y divide-gray-100 rounded-lg shadow w-44">
                        <ul class="py-2 text-sm text-txt " aria-labelledby="dropdownHoverButton">
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-accent hover:text-white">
                                    Manage Suppliers
                                </a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-accent hover:text-white">
                                    Manage Products
                                </a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-accent hover:text-white">
                                    Product Delivery
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    Order Products
                    <ul class="hidden">
                        <li>Purchase Order Manage</li>
                        <li>Expired Products Manage</li>
                    </ul>
                </li>
                <li>
                    <a class="dropdown-item" href="../login/logout.php">Log out</a>
                </li>
            </ul>
        </div>
    </nav>
    <section class="bg-accent bg-opacity-50 py-2 text-white font-semibold">
        <div class="container mx-auto justify-between flex">
            <h2><?= $sessionuser ?></h2>
            <h2>DateTime</h2>
        </div>
    </section>
</header>