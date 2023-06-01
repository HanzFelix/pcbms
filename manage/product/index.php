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
    <h2 class="text-center text-2xl p-4 font-semibold">Product Data CRUD</h2>
    <div class="flex gap-4 px-4 items-start">
        <section class="flex flex-col w-3/12 gap-2">
            <div class="flex">
                <input class="w-full" type="text" name="" id="search" placeholder="Type few letters here" />
                <button class="bg-primary text-white py-2 px-4 rounded-r-md" id="search-button">GO</button>
            </div>
            <div multiple id="search-results" class="min-h-[12rem] flex flex-col items-stretch">

            </div>
            <div class="flex items-center justify-end gap-2">
                <button class="bg-accent text-white py-2 px-4 rounded-md" id="new-button">NEW</button>
            </div>
        </section>
        <form class="w-9/12 flex flex-col gap-4 bg-secondary p-4 border-t-4 border-primary" action="#" id="product-form">
            <input type="text" name="id" id="id" hidden value="0" />
            <div class="flex items-center gap-4">
                <p class="w-40 text-right">Product Name</p>
                <input name="product-name" id="product-name" type="text" class="border border-primary w-full disabled:bg-secondary" disabled />
            </div>
            <div class="flex items-center gap-4">
                <p class="w-40 text-right">Shelf life (days)</p>
                <input name="shelf-life" id="shelf-life" type="number" class="border border-primary w-full disabled:bg-secondary" disabled />
            </div>
            <div class="flex items-center gap-4">
                <p class="w-40 text-right">Unit</p>
                <select name="unit" id="unit" class=" w-full px-3 py-2 disabled:bg-secondary" disabled>
                    <option value="piece">piece</option>
                    <option value="pack">pack</option>
                    <option value="bottle">bottle</option>
                    <option value="bag">bag</option>
                </select>
            </div>
            <div class="flex items-center gap-4">
                <p class="w-40 text-right">Appreciation</p>
                <input type="text" name="appreciation" id="appreciation" class="border border-primary w-full disabled:bg-secondary" disabled />
            </div>
            <div class="flex items-center justify-end gap-2">
                <button type="submit" id="delete-button" value="delete" class="bg-accent text-white py-2 px-4 rounded-md" hidden>Delete</button>
                <button type="submit" id="save-button" value="update" class="bg-primary text-white py-2 px-4 rounded-md" hidden>Save</button>
                <button type="submit" id="create-button" value="create" class="bg-primary text-white py-2 px-4 rounded-md" hidden>Create</button>
            </div>
        </form>
    </div>
</main>

<script>
    // show all results on load
    search('');
    // Add event listener to the search button
    document.getElementById('search-button').addEventListener('click', function() {
        var searchQuery = document.getElementById('search').value;

        search(searchQuery);
    });
    document.getElementById('new-button').addEventListener('click', function() {
        clearText(false);
        setCrudMode("create");
    });


    function search(query) {
        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Define the AJAX request
        xhr.open('GET', '../product/searchProduct.php?q=' + query, true);

        // Define the callback function when the response is received
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Update the search results container
                document.getElementById('search-results').innerHTML = xhr.responseText;

                // add event listener to container when selecting a specific option
                document.getElementById('search-results').addEventListener('click', function(e) {
                    // if selected container
                    if (!e.target.value) {
                        return;
                    }
                    var prod_id = e.target.value;

                    getProduct(prod_id);
                });
            }
        };

        // Send the AJAX request
        xhr.send();
    }

    function getProduct(query) {
        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Define the AJAX request
        xhr.open('GET', '../product/getProduct.php?id=' + query, true);

        // Define the callback function when the response is received
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Update the search results container
                var product = JSON.parse(xhr.responseText);
                $('#id').val(product.prod_id);
                $('#product-name').val(product.prod_name);
                $('#shelf-life').val(product.shelf_life);
                $('#unit').val(product.unit);
                $('#appreciation').val(product.appreciation);
                setCrudMode("update");
                $('#product-name').prop('disabled', false);
                $('#shelf-life').prop('disabled', false);
                $('#unit').prop('disabled', false);
                $('#appreciation').prop('disabled', false);
            }
        };

        // Send the AJAX request
        xhr.send();
    }

    function setCrudMode(state) {
        var delbtn = document.getElementById('delete-button');
        var savbtn = document.getElementById('save-button');
        var crtbtn = document.getElementById('create-button');
        switch (state) {
            case "update":
                delbtn.hidden = false;
                savbtn.hidden = false;
                crtbtn.hidden = true;
                break;
            case "create":
                delbtn.hidden = true;
                savbtn.hidden = true;
                crtbtn.hidden = false;
                break;
            default:
                delbtn.hidden = true;
                savbtn.hidden = true;
                crtbtn.hidden = true;
                break;
        }
    }

    function clearText(isDisabled) {
        document.getElementById('id').value = 0;
        document.getElementById('product-name').value = "";
        document.getElementById('shelf-life').value = "";
        document.getElementById('unit').value = "";
        document.getElementById('appreciation').value = "";

        // $("#company-name", "#contact-person").prop('disabled', isDisabled)
        document.getElementById('product-name').disabled = isDisabled;
        document.getElementById('shelf-life').disabled = isDisabled;
        document.getElementById('unit').disabled = isDisabled;
        document.getElementById('appreciation').disabled = isDisabled;
    }

    $(document).ready(function() {
        $('#product-form').submit(function(event) {
            event.preventDefault();

            // Get the form data
            var formData = $(this).serialize();

            // Get the clicked button value
            switch ($(document.activeElement).val()) {
                case "create":
                    $.ajax({
                        type: 'POST',
                        url: '../product/createProduct.php',
                        data: formData,
                        success: function(response) {
                            // Display the response from the PHP page
                            // $('#response').html(response);
                            clearText(true);
                            setCrudMode("");
                            document.getElementById('search-button').click();
                        }
                    });
                    break;
                case "update":
                    $.ajax({
                        type: 'POST',
                        url: '../product/updateProduct.php',
                        data: formData,
                        success: function(response) {
                            // Display the response from the PHP page
                            // $('#response').html(response);
                            clearText(true);
                            setCrudMode("");
                            document.getElementById('search-button').click();
                        }
                    });
                    break;
                case "delete":
                    $.ajax({
                        type: 'POST',
                        url: '../product/deleteProduct.php',
                        data: formData,
                        success: function(response) {
                            // Display the response from the PHP page
                            // $('#response').html(response);
                            clearText(true);
                            setCrudMode("");
                            document.getElementById('search-button').click();
                        }
                    });
                    break;
                default:
                    break;
            }

            // Proceed with form submission or prevent it based on your requirements
            // $(this).unbind('submit').submit();
        });
    });
</script>

<?php
include "../../footers/footer.php";
?>
<!--
    INSERT INTO `product` (`prod_id`, `prod_name`, `shelf_life`, `unit`, `appreciation`) VALUES (NULL, 'kamote', '23', 'bag', '2.0');
-->