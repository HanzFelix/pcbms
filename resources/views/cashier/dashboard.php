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
<main class="p-4 container mx-auto">
    <h1 class="text-center text-3xl font-bold">Sales Management</h1>
    <div class="flex w-full gap-2 mt-4">
        <div class="bg-accent/10 rounded-md basis-full flex overflow-hidden flex-col justify-between">

            <div class="">
                <h1 class="bg-accent/80 text-white py-2 font-bold px-4">Items</h1>
                <?php for ($i = 0; $i < 4; $i++) : ?>
                    <div class="flex justify-between font-semibold px-4 py-2 <?= ($i % 2 == 0 ? '' : 'bg-accent/20') ?> ">
                        <span>ItemSomething x1</span>
                        <span>20.00</span>
                    </div>
                <?php endfor ?>
            </div>
            <div class="px-4">
                <div class="flex justify-between py-1">
                    <span>Total</span>
                    <span>20.00</span>
                </div>
                <div class="flex justify-between py-1">
                    <span>Cash Received</span>
                    <span>20.00</span>
                </div>
                <div class="flex justify-between py-1">
                    <span>Change due</span>
                    <span>20.00</span>
                </div>
            </div>
        </div>
        <div class="bg-accent/10 p-4 rounded-md flex flex-col gap-2">
            <div class="bg-accent/10 w-96 h-24 p-4">Waiting for item scanner...</div>
            <div class="bg-white flex px-2">
                <input type="text" disabled class="basis-full bg-transparent border-none py-2">
                <button class="bg-accent/20">del</button>
            </div>
            <div class="flex gap-2">
                <div class="grid basis-full grid-cols-3 gap-1">
                    <?php foreach (array_merge(range(1, 9), ['0', '00', '.']) as $numkey) : ?>
                        <button class="bg-primary text-white font-semibold text-2xl p-2 px-4"><?= $numkey ?></button>
                    <?php endforeach ?>
                </div>
                <div class="flex flex-col gap-1 whitespace-nowrap">
                    <p class="px-2 border-l-4 border-primary basis-full">Select Product</p>
                    <p class="px-2 border-l-4 border-primary basis-full">Quantity</p>
                    <button class="bg-accent text-white font-bold basis-full">Calculate Total</button>
                    <button class="bg-accent text-white font-bold basis-full">Enter</button>
                </div>
            </div>
        </div>
    </div>
</main>

<!--temp-->
<div class="md:flex md:items-center md:justify-between">
    <div class="min-w-0">
        <h1 class="text-3xl font-bold text-white">Sales</h1>
    </div>
    <div class="mt-4 flex md:ml-4 md:mt-0">
        <button type="button" @click="openModal" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
            <div class="flex flex-row space-x-2 text-primary">
                <span>Add New Sale</span>
                <Icon icon="fluent:add-circle-24-regular" class="h-5 w-5" />
            </div>
        </button>
        <div as="div" @close="closeModal" class="relative z-10">
            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center">
                    <div as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
                        <div class="w-full max-w-2xl transform rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
                            <header as="h3" class="text-lg font-medium leading-6 text-gray-900">
                                <h3>Sale Information</h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Please fill out the
                                    information below.
                                </p>
                            </header>

                            <form @submit.prevent="submit" class="mt-8">
                                <div class="mt-8 pt-8 text-right sm:border-t sm:border-gray-200">
                                    <button type="button" @click="closeModal" class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary/80 focus:ring-offset-2">
                                        Cancel
                                    </button>
                                    <button type="submit" class="ml-2 inline-flex justify-center rounded-md border border-transparent bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="flex flex-col shadow-lg">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Sale ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Date Issued
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Item ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Quantity Sold
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Amount Sold
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Customer
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Personnel
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <tr v-for="sale in sales" :key="sale.sale_id">
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="text-md font-medium text-gray-900">
                                    {{ sale.sale_id }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="text-md font-medium text-gray-900">
                                    {{ sale.date_issued }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="text-md font-medium text-gray-900">
                                    {{ sale.item_id }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="text-md font-medium text-gray-900">
                                    {{ sale.qty_sold }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="text-md font-medium text-gray-900">
                                    {{ sale.amount_sold }}
                                </div>
                            </td>
                            <td class="max-w-[16rem] whitespace-nowrap px-6 py-4">
                                <div class="text-md font-medium text-gray-900">
                                    {{ sale.name }}
                                </div>
                                <div class="truncate text-sm text-gray-500">
                                    {{ sale.address }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0">
                                        <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="" />
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ sale.username }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ sale.role }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="flex flex-row items-center space-x-2 whitespace-nowrap px-6 py-6 text-right text-sm font-medium">
                                <button type="button" title="Edit Consigned Product Details" class="text-primary/80 hover:text-primary" @click="openEditModal(product)">
                                    Edit
                                </button>
                                <form @submit.prevent="
                                                deleteProduct(product.cp_id)
                                            ">
                                    <button type="submit" title="Delete Consigned Product" class="text-red-700 hover:text-red-900">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/resources/layouts/cashier_layout.php';
?>