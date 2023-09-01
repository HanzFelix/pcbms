<!--temp-->
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