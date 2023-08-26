<?php
$title = "Manage Products";
$error = "";
// Check if an error message exists
if (isset($_SESSION['error_message'])) {
    $error = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

$productHeaderLabels = [
    "Product Name",
    "Shelf life (days)",
    "Unit",
    "Appreciation",
    "Quantity",
    "Action"
];

ob_start();
?>
<main class="container mx-auto bg-shade px-4">
    <h2 class="text-center text-3xl py-4 font-bold">Product Data CRUD</h2>
    <!--div class="flex gap-4 px-4 items-start">
        <section class="flex flex-col w-3/12 gap-2">
            <form class="flex" action="#" id="search-form">
                <input class="w-full" type="text" name="q" id="search" placeholder="Type few letters here" />
                <button class="bg-primary text-white py-2 px-4 rounded-r-md" id="search-button">GO</button>
            </form>
            <div multiple id="search-results" class="min-h-[12rem] flex flex-col items-stretch">

            </div>
        </section>
        
    </div-->
    <div class="flex items-center justify-end gap-2 my-2">
        <button class="bg-primary text-white py-2 px-4 rounded-md" id="new-button">NEW PRODUCT</button>
    </div>
    <div class="w-full overflow-x-auto" id="ptable">

        <table class="text-left rounded-md overflow-hidden w-full">
            <thead class="bg-accent bg-opacity-75 text-white border-primary sticky divide-x divide-white">
                <?php
                foreach ($productHeaderLabels as $label) {
                    echo "<th class='px-4 py-2'>$label</th>";
                }
                ?>
            </thead>
            <tbody id="productlisttbody">
            </tbody>
        </table>
    </div>
</main>

<dialog class="backdrop:backdrop-brightness-50 bg-secondary p-4" id="productDialog">
    <header class="flex items-start justify-between">
        <h1 class="text-2xl font-bold" id="testh1">Product Details</h1>
        <button type="button" id="close-product-modal" class="ml-auto inline-flex items-center rounded-lg p-1.5 text-sm text-zinc-400 hover:bg-zinc-200 hover:text-orange-600 transition-colors">
            <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close modal</span>
        </button>
    </header>
    <form class="mt-2 flex flex-col gap-4 bg-secondary p-4 border-t-4 border-primary" action="#" id="product-form">
        <input type="text" name="id" id="id" hidden value="0" />
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Product Name</p>
            <input name="product-name" id="product-name" type="text" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Shelf life (days)</p>
            <input name="shelf-life" id="shelf-life" type="number" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Unit</p>
            <select name="unit" id="unit" class=" w-full px-3 py-2 disabled:bg-secondary">
                <option value="piece">piece</option>
                <option value="pack">pack</option>
                <option value="bottle">bottle</option>
                <option value="bag">bag</option>
            </select>
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Appreciation</p>
            <input type="text" name="appreciation" id="appreciation" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Max Quantity</p>
            <input name="max-quantity" id="max-quantity" type="number" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <div class="flex items-center justify-end gap-2">
            <button type="submit" id="delete-button" value="delete" class="bg-accent text-white py-2 px-4 rounded-md" hidden>Delete</button>
            <button type="submit" id="save-button" value="update" class="bg-primary text-white py-2 px-4 rounded-md" hidden>Save</button>
            <button type="submit" id="create-button" value="create" class="bg-primary text-white py-2 px-4 rounded-md" hidden>Create</button>
        </div>
    </form>
</dialog>
<script>
    function getProduct(query) {
        $.ajax({
            url: '/?action=getProduct',
            method: 'GET',
            dataType: 'json',
            data: {
                id: query
            },
            success: function(product) {
                // Update the search results container
                $('#id').val(product.prod_id);
                $('#product-name').val(product.prod_name);
                $('#shelf-life').val(product.shelf_life);
                $('#unit').val(product.unit);
                $('#appreciation').val(product.appreciation);
                $('#max-quantity').val(product.max_quantity);
                setCrudMode("update");
            },
            error: function(xhr, status, error) {
                // Handle errors if necessary
                console.error(error);
            }
        });
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

    function clearText() {
        $('#id').val(0);
        $('#product-name').val("");
        $('#shelf-life').val("");
        $('#unit').val("");
        $('#appreciation').val("");
        $('#max-quantity').val("");
    }

    function getProductList() {
        $.ajax({
            url: '/?action=getProductList',
            method: 'GET',
            success: function(response) {
                // Update the search results container
                $('#ptable').html(response);

                // Add event listener to container when selecting a specific option
                $('#ptable').on('click', function(e) {
                    // If selected container, or does not have a target attribute
                    if (!$(e.target).val()) {
                        return;
                    }
                    var prod_id = $(e.target).val();

                    getProduct(prod_id);
                    document.getElementById("productDialog").showModal();
                });
            },
            error: function(xhr, status, error) {
                // Handle errors if necessary
                console.error(error);
            }
        });
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
                        url: '/?action=createProduct',
                        data: formData,
                        success: function(response) {
                            clearText(true);
                            setCrudMode("");
                            document.getElementById("productDialog").close();
                            getProductList();
                        }
                    });
                    break;
                case "update":
                    $.ajax({
                        type: 'POST',
                        url: '/?action=updateProduct',
                        data: formData,
                        success: function(response) {
                            clearText(true);
                            setCrudMode("");
                            document.getElementById("productDialog").close();
                            getProductList();
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            // Handle errors, if any
                            console.log(error);
                        }
                    });
                    break;
                case "delete":
                    $.ajax({
                        type: 'POST',
                        url: '/?action=deleteProduct',
                        data: formData,
                        success: function(response) {
                            clearText(true);
                            setCrudMode("");
                            document.getElementById("productDialog").close();
                            getProductList();
                        }
                    });
                    break;
                default:
                    break;
            }
        });

        // Add event listener to the search button
        $('#search-form').submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();
            $.ajax({
                url: '/?action=searchProduct',
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
                        var prod_id = $(e.target).val();

                        getProduct(prod_id);
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
            document.getElementById("productDialog").showModal();
        });

        $('#close-product-modal').on('click', function() {
            document.getElementById("productDialog").close();
        });

        // show all results on ready
        //$('#search-form').submit();
        getProductList();
    });
</script>

<?php
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/resources/layouts/manager_layout.php';
?>