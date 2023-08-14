<?php
include "../../headers/header.php";
include "../../components/navigationBar.php"
?>

<!--Main-->
<main class="p-4">
    <h1 class="text-center text-3xl font-bold">Store Management</h1>
</main>
<!--Supplier Update -->
<main class="container mx-auto bg-shade">
    <h2 class="text-center text-2xl p-4 font-semibold">Consigned Detail CRUD</h2>
    <div class="flex gap-4 px-4 items-start">
        <section class="flex flex-col w-3/12 gap-2">
            <form class="flex" action="#" id="search-form">
                <input class="w-full" type="text" name="search-input" id="search-input" placeholder="Type few letters here" />
                <button class="bg-primary text-white py-2 px-4 rounded-r-md" type="submit" id="search-button">GO</button>
            </form>
            <div multiple id="search-results" class="min-h-[12rem] flex flex-col items-stretch">

            </div>
            <div class="flex items-center justify-end gap-2">
                <button class="bg-accent text-white py-2 px-4 rounded-md" id="new-button">NEW</button>
            </div>
        </section>
        <div class="w-9/12 ">
            <table class="text-left rounded-md overflow-hidden w-full">
                <thead class="bg-accent bg-opacity-75 text-white border-primary sticky">
                    <th class="px-4 py-2">Product Name (Qty)</th>
                    <th class="px-4 py-2">Barcode</th>
                    <th class="px-4 py-2">Particular</th>
                    <th class="px-4 py-2">Expiry Date</th>
                    <th class="px-4 py-2">Unit Price</th>
                    <th class="px-4 py-2">Selling Price</th>
                    <th class="px-4 py-2">Action</th>
                </thead>
                <tbody id="tbody"><!--
                    <tr class="bg-accent bg-opacity-10">
                        <td class="px-4 py-2">Potato Chips (x15) </td>
                        <td class="px-4 py-2">50 grams per bag</td>
                        <td class="px-4 py-2">TOMORROW!</td>
                        <td class="px-4 py-2">Php 50.00</td>
                        <td class="px-4 py-2">Php 100.00</td>
                        <td class="px-4 py-2">
                            <button class="bg-primary text-white px-3 rounded-full py-1 text-xs">EDIT</button>
                        </td>
                    </tr>
                    <tr class="bg-accent bg-opacity-25">
                        <td class="px-4 py-2">Potato Chips (x15) </td>
                        <td class="px-4 py-2">50 grams per bag</td>
                        <td class="px-4 py-2">TOMORROW!</td>
                        <td class="px-4 py-2">Php 50.00</td>
                        <td class="px-4 py-2">Php 100.00</td>
                        <td class="px-4 py-2">Edit Del</td>
                    </tr>
                    <tr class="bg-accent bg-opacity-10">
                        <td class="px-4 py-2">Potato Chips (x15) </td>
                        <td class="px-4 py-2">50 grams per bag</td>
                        <td class="px-4 py-2">TOMORROW!</td>
                        <td class="px-4 py-2">Php 50.00</td>
                        <td class="px-4 py-2">Php 100.00</td>
                        <td class="px-4 py-2">Edit Del</td>
                    </tr>
                    <tr class="bg-accent bg-opacity-25">
                        <td class="px-4 py-2">Potato Chips (x15) </td>
                        <td class="px-4 py-2">50 grams per bag</td>
                        <td class="px-4 py-2">TOMORROW!</td>
                        <td class="px-4 py-2">Php 50.00</td>
                        <td class="px-4 py-2">Php 100.00</td>
                        <td class="px-4 py-2">Edit Del</td>
                    </tr>
                    <tr class="bg-accent bg-opacity-10">
                        <td class="px-4 py-2">Potato Chips (x15) </td>
                        <td class="px-4 py-2">50 grams per bag</td>
                        <td class="px-4 py-2">TOMORROW!</td>
                        <td class="px-4 py-2">Php 50.00</td>
                        <td class="px-4 py-2">Php 100.00</td>
                        <td class="px-4 py-2">Edit Del</td>
                    </tr>-->
                </tbody>
            </table>
            <div>
                <p>Supplier: <span id="supplier-name">SupplierName</span> </p>
                <p>Received by: <span id="username">UserName</span> </p>
                <p>Date Delivered: <span id="date">20/20/20XX</span></p>
            </div>
        </div>

        <!--form class="w-9/12 flex flex-col gap-4 bg-secondary p-4 border-t-4 border-primary" action="#" id="supplier-form">
            <input type="text" name="id" id="id" hidden value="0" />
            <div class="flex items-center gap-4">
                <p class="w-40 text-right">Company Name</p>
                <input name="company-name" id="company-name" type="text" class="border border-primary w-full disabled:bg-secondary" disabled />
            </div>
            <div class="flex items-center gap-4">
                <p class="w-40 text-right">Contact Person</p>
                <input name="contact-person" id="contact-person" type="text" class="border border-primary w-full disabled:bg-secondary" disabled />
            </div>
            <div class="flex items-center gap-4">
                <p class="w-40 text-right">Sex</p>
                <select name="sex" id="sex" class=" w-full px-3 py-2 disabled:bg-secondary" disabled>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Non-Binary">Non-Binary</option>
                </select>
            </div>
            <div class="flex items-center gap-4">
                <p class="w-40 text-right">Address</p>
                <input type="text" name="address" id="address" class="border border-primary w-full disabled:bg-secondary" disabled />
            </div>
            <div class="flex items-center gap-4">
                <p class="w-40 text-right">Phone</p>
                <input type="tel" name="phone" id="phone" class="border border-primary w-full disabled:bg-secondary" disabled />
            </div>
            <div class="flex items-center justify-end gap-2">
                <button type="submit" id="delete-button" value="delete" class="bg-accent text-white py-2 px-4 rounded-md" hidden>Delete</button>
                <button type="submit" id="save-button" value="update" class="bg-primary text-white py-2 px-4 rounded-md" hidden>Save</button>
                <button type="submit" id="create-button" value="create" class="bg-primary text-white py-2 px-4 rounded-md" hidden>Create</button>
            </div>
        </form-->
    </div>
</main>
<dialog class="backdrop:backdrop-brightness-50 rounded-xl bg-secondary border-t-4 border-primary p-4" id="customDialog">
    <form class="flex flex-col gap-4" action="#" id="supplier-form">
        <header class="flex items-start justify-between">
            <h1 class="text-2xl font-bold" id="testh1">a</h1>
            <button type="button" id="close-modal" class="ml-auto inline-flex items-center rounded-lg p-1.5 text-sm text-zinc-400 hover:bg-zinc-200 hover:text-orange-600 transition-colors" data-modal-hide="defaultModal">
                <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </header>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Product</p>
            <input name="product" id="product" type="text" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Barcode</p>
            <input name="barcode" id="barcode" type="text" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Particulars</p>
            <input name="particulars" id="particulars" type="text" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Expiry Date</p>
            <input name="expiry-date" id="expiry-date" type="text" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Unit price</p>
            <input name="unit-price" id="unit-price" type="text" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Selling price</p>
            <input name="selling-price" id="selling-price" type="text" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Quantity</p>
            <input name="quantity" id="quantity" type="text" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Amount</p>
            <input name="amount" id="amount" type="text" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <footer class="flex justify-end gap-2">
            <button id="save-consigned-product" class="bg-primary text-white py-2 px-4 rounded-md" value="0">Save</button>
            <button id="delete-consigned-product" class="bg-accent text-white py-2 px-4 rounded-md" value="0">Delete</button>
        </footer>
    </form>
</dialog>
<script>
    function getConsignedDetails(query) {
        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Define the AJAX request
        xhr.open('GET', '../delivery/getConsignedDetails.php?id=' + query, true);

        // Define the callback function when the response is received
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Update the search results container
                var consigned_details = JSON.parse(xhr.responseText);
                getConsignedProducts(consigned_details.cd_id);
                $('#id').val(consigned_details.cd_id);
                $('#supplier-name').text(consigned_details.supp_id);
                $('#username').text(consigned_details.userid);
                $('#date').text(consigned_details.date_delivered);
                setCrudMode("update");
            }
        };

        // Send the AJAX request
        xhr.send();
    }

    function getConsignedProducts(query) {
        $.ajax({
            url: '../delivery/getConsignedProducts.php',
            method: 'GET',
            data: {
                id: query
            },
            success: function(response) {
                // Update the search results container
                $('#tbody').html(response);

                // Add event listener to container when selecting a specific option
                $('#tbody').on('click', function(e) {
                    // If selected container, or does not have a target attribute
                    if (!$(e.target).val()) {
                        return;
                    }
                    var cp_id = $(e.target).val();
                    getConsignedProduct(cp_id);
                    document.getElementById("customDialog").showModal();
                });
            },
            error: function(xhr, status, error) {
                // Handle errors, if any
                console.log(error);
            }
        });
    }

    function getConsignedProduct(query) {
        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Define the AJAX request
        xhr.open('GET', '../delivery/getConsignedProduct.php?id=' + query, true);

        // Define the callback function when the response is received
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Update the search results container
                var consigned_product = JSON.parse(xhr.responseText);
                $("#testh1").text(consigned_product.prod_name);
                $('#save-consigned-product').val(consigned_product.item_id);
                $('#delete-consigned-product').val(consigned_product.item_id);
                $('#product').val(consigned_product.prod_id);
                $('#barcode').val(consigned_product.barcode);
                $('#particulars').val(consigned_product.particulars);
                $('#expiry-date').val(consigned_product.expiry_date);
                $('#unit-price').val(consigned_product.unit_price);
                $('#selling-price').val(consigned_product.selling_price);
                $('#quantity').val(consigned_product.quantity);
                $('#amount').val(consigned_product.amount);
                setCrudMode("update");
            }
        };

        // Send the AJAX request
        xhr.send();
    }

    function setCrudMode(state) {
        var delbtn = $('#delete-button');
        var savbtn = $('#save-button');
        var crtbtn = $('#create-button');
        switch (state) {
            case "update":
                delbtn.show();
                savbtn.show();
                crtbtn.hide();
                break;
            case "create":
                delbtn.hide();
                savbtn.hide();
                crtbtn.show();
                break;
            default:
                delbtn.hide();
                savbtn.hide();
                crtbtn.hide();
                break;
        }
    }

    function clearText(isDisabled) {
        $('#id').val(0);
        $('#company-name').val("");
        $('#contact-person').val("");
        $('#sex').val("");
        $('#address').val("");
        $('#phone').val("");

        $('#company-name').prop('disabled', isDisabled);
        $('#contact-person').prop('disabled', isDisabled);
        $('#sex').prop('disabled', isDisabled);
        $('#address').prop('disabled', isDisabled);
        $('#phone').prop('disabled', isDisabled);
    }


    $(document).ready(function() {
        $('#supplier-form').submit(function(event) {
            event.preventDefault();

            // Get the form data
            var formData = $(this).serialize();

            // Get the clicked button value
            switch ($(document.activeElement).val()) {
                case "create":
                    $.ajax({
                        type: 'POST',
                        url: '../supplier/createSupplier.php',
                        data: formData,
                        success: function(response) {
                            // Display the response from the PHP page
                            // $('#response').html(response);
                            clearText(true);
                            setCrudMode("");
                            $('#search-form').submit();
                        }
                    });
                    break;
                case "update":
                    $.ajax({
                        type: 'POST',
                        url: '../supplier/updateSupplier.php',
                        data: formData,
                        success: function(response) {
                            // Display the response from the PHP page
                            // $('#response').html(response);
                            clearText(true);
                            setCrudMode("");
                            $('#search-form').submit();
                        }
                    });
                    break;
                case "delete":
                    $.ajax({
                        type: 'POST',
                        url: '../supplier/deleteSupplier.php',
                        data: formData,
                        success: function(response) {
                            // Display the response from the PHP page
                            // $('#response').html(response);
                            clearText(true);
                            setCrudMode("");
                            $('#search-form').submit();
                        }
                    });
                    break;
                default:
                    break;
            }

            // Proceed with form submission or prevent it based on your requirements
            // $(this).unbind('submit').submit();
        });


        // Add event listener to the search button
        $('#search-form').submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();
            $.ajax({
                url: '../delivery/searchConsignedDetails.php',
                method: 'GET',
                data: formData,
                success: function(response) {
                    // Update the search results container
                    $('#search-results').html(response);

                    // Add event listener to container when selecting a specific option
                    $('#search-results').on('click', function(e) {
                        // If selected container
                        if (!$(e.target).val()) {
                            return;
                        }
                        var supp_id = $(e.target).val();

                        getConsignedDetails(supp_id);
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors, if any
                    console.log(error);
                }
            });
        });

        $('#new-button').on('click', function() {
            clearText(false);
            setCrudMode("create");
        });

        $('#close-modal').on('click', function() {
            document.getElementById("customDialog").close();
        });

        // show all results on ready
        $('#search-form').submit();
    });
</script>

<?php
include "../../footers/footer.php";
?>