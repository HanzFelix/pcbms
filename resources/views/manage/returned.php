<?php
$title = "Returned Products";
$error = "";
// Check if an error message exists
if (isset($_SESSION['error_message'])) {
    $error = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

ob_start();
?>
<!--Main-->
<main class="container mx-auto bg-shade">
    <h2 class="text-center text-3xl p-4 font-bold">Returned Products CRUD</h2>
    <div class="w-full overflow-x-auto" id="edtable">
        ...
    </div>
    <?= $error ?>
</main>
<!--ExpiredDetailsForm-->
<dialog id="expiredDetailsFormDialog" class="backdrop:backdrop-brightness-50 bg-secondary border-t-4 border-primary p-4">
    <form class="flex flex-col gap-4" action="#" id="ed-form">
        <input name="ed-id" id="ed-id" hidden>
        <header class="flex items-start justify-between">
            <h1 class="text-2xl font-bold" id="testh1">Expired Details</h1>
            <button type="button" onclick="showDialog('expiredDetailsFormDialog',false)" class="ml-auto inline-flex items-center rounded-lg p-1.5 text-sm text-zinc-400 hover:bg-zinc-200 hover:text-orange-600 transition-colors">
                <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </header>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Supplier</p>

            <select title="supplier" name="supplier" class="border border-primary w-full disabled:bg-secondary py-2 px-2" required id="supplier-options">
            </select>
            <!--input name="supplier" id="supplier-input" type="text" class="border border-primary w-full disabled:bg-secondary" /-->
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Date Delivered</p>
            <input name="date-returned" id="date-returned-input" type="date" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Returned by:</p>
            <input name="returned-by" id="returned-by-input" type="text" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <footer class="flex justify-end gap-2">
            <button id="ed-create" class="bg-primary text-white py-2 px-4 rounded-md" value="create">Create</button>
            <button id="ed-update" class="bg-primary text-white py-2 px-4 rounded-md" value="update">Update</button>
            <button id="ed-delete" class="bg-accent text-white py-2 px-4 rounded-md" value="delete">Delete</button>
            <button id="ed-cancel" type="button" onclick="showDialog('expiredDetailsFormDialog',false)" class="bg-accent text-white py-2 px-4 rounded-md" value="0">Cancel</button>
        </footer>
    </form>
</dialog>
<!--ExpiredDetailsProducts-->
<dialog id="expiredDetailsDialog" class="backdrop:backdrop-brightness-50  bg-secondary border-t-4 border-primary p-4">
    <div class="flex justify-between items-end mb-2 gap-2">
        <div>
            <p>Supplier: <span id="ed-supplier" class="font-semibold">SupplierName</span> </p>
            <p>Returned by: <span id="ed-personnel" class="font-semibold">Personnel</span> </p>
        </div>
        <div>
            <!--p>Actions: <span><button class="bg-primary text-white px-3 rounded-full py-1 text-xs" type="button" onclick="showDialog('expiredDetailsFormDialog')">EDIT RETURNED DETAILS</button></span></p-->
            <p>Date Delivered: <span id="ed-date" class="font-semibold">20/20/20XX</span></p>
        </div>
    </div>
    <div class="overflow-x-auto w-full" id="eptable">
    </div>

    <footer class="flex justify-end gap-2 mt-2">
        <!--button id="ep-new" onclick="newExpiredProduct()" class="bg-primary text-white py-2 px-4 rounded-md" value="0">Add Expired Product</button-->
        <button id="close-ed-modal" onclick="showDialog('expiredDetailsDialog',false)" class="bg-accent text-white py-2 px-4 rounded-md" value="0">Close</button>
    </footer>
</dialog>
<!--ExpiredProduct-->
<dialog class="backdrop:backdrop-brightness-50 rounded-xl bg-secondary border-t-4 border-primary p-4" id="expiredProductDialog">
    <form class="flex flex-col gap-4" action="#" id="ep-form">
        <input name="ep-id" id="ep-id" hidden>
        <header class="flex items-start justify-between">
            <h1 class="text-2xl font-bold" id="testh1">Expired Product</h1>
            <button type="button" onclick="showDialog('expiredProductDialog',false)" id="close-ep-modal" class="ml-auto inline-flex items-center rounded-lg p-1.5 text-sm text-zinc-400 hover:bg-zinc-200 hover:text-orange-600 transition-colors">
                <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </header>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Product</p>

            <select title="product" name="product" class="border border-primary w-full disabled:bg-secondary py-2 px-2" required id="product-options">
            </select>
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Barcode</p>
            <input name="barcode" id="barcode" type="text" placeholder="00000000" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Particulars</p>
            <div class="w-full flex items-center gap-2">
                <input name="particulars" id="particulars" placeholder="15 grams/liters/etc..." type="text" class="border border-primary w-full disabled:bg-secondary" />
                <label class="whitespace-nowrap">per unit</label>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Expiry Date</p>
            <input name="expiry-date" id="expiry-date" type="date" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Unit price</p>
            <input name="unit-price" id="unit-price" type="text" placeholder="0.00" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Selling price</p>
            <input name="selling-price" id="selling-price" type="text" placeholder="0.00" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Quantity</p>
            <input name="quantity" id="quantity" type="text" placeholder="0" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Amount</p>
            <input name="amount" id="amount" type="text" placeholder="0.00" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <footer class="flex justify-end gap-2">
            <button id="ep-create" class="bg-primary text-white py-2 px-4 rounded-md" value="create">Create</button>
            <button id="ep-update" class="bg-primary text-white py-2 px-4 rounded-md" value="update">Update</button>
            <button id="ep-delete" class="bg-accent text-white py-2 px-4 rounded-md" value="delete">Delete</button>
            <button id="ed-cancel" type="button" onclick="showDialog('expiredProductDialog',false)" class="bg-accent text-white py-2 px-4 rounded-md" value="0">Cancel</button>
        </footer>
    </form>
</dialog>
<script>
    function showDialog(dialogId, bool = true) {
        if (bool) {
            document.getElementById(dialogId).showModal();
        } else {
            document.getElementById(dialogId).close();
        }
    }

    function getExpiredDetailsList() {
        $.ajax({
            url: '/?action=getExpiredDetailsList',
            method: 'GET',
            success: function(response) {
                // Update the search results container
                //$('#cdlisttbody').html(response);
                $('#edtable').html(response)

                // Add event listener to container when selecting a specific option
                $('#edtable').on('click', function(e) {
                    // If selected container, or does not have a target attribute
                    if (!$(e.target).val()) {
                        return;
                    }
                    var ed_id = $(e.target).val();
                    getExpiredProducts(ed_id);
                    getExpiredDetails(ed_id);
                    document.getElementById("expiredDetailsDialog").showModal();
                });
            },
            error: function(xhr, status, error) {
                // Handle errors if necessary
                console.error(error);
            }
        });
    }

    function getExpiredDetails(query) {
        $.ajax({
            url: '/?action=getExpiredDetails',
            method: 'GET',
            dataType: 'json',
            data: {
                id: query
            },
            success: function(expired_details) {
                //$('#id').val(expired_details.ed_id);
                $('#ed-id').val(expired_details.ed_id);
                $('#ed-supplier').text(expired_details.company);
                $('#ed-personnel').text(expired_details.personnel);
                $('#ed-date').text(expired_details.date);
                $('#supplier-options').val(expired_details.supp_id);
                $('#returned-by-input').val(expired_details.userid);
                $('#date-returned-input').val(expired_details.date);
                setCDCrudMode("update");
            },
            error: function(xhr, status, error) {
                // Handle errors if necessary
                console.error(error);
            }
        });
    }

    function getExpiredProducts(query) {
        $.ajax({
            url: '/?action=getExpiredProductList',
            method: 'GET',
            data: {
                id: query
            },
            success: function(response) {
                // Update the search results container
                $('#eptable').html(response);

                // Add event listener to container when selecting a specific option
                $('#eptable').on('click', function(e) {
                    // If selected container, or does not have a target attribute
                    if (!$(e.target).val()) {
                        return;
                    }
                    var ep_id = $(e.target).val();
                    getExpiredProduct(ep_id);
                    showDialog("expiredProductDialog")
                });
            },
            error: function(xhr, status, error) {
                // Handle errors, if any
                console.log(error);
            }
        });
    }

    function newExpiredProduct() {
        showDialog("expiredProductDialog");
        getProductOptions(function() {
            $("#ep-id").val("");
            $('#product-options').val("");
            $('#barcode').val("");
            $('#particulars').val("");
            $('#expiry-date').val("");
            $('#unit-price').val("");
            $('#selling-price').val("");
            $('#quantity').val("");
            $('#amount').val("");
        });
        setCPCrudMode("create");
    }

    function newExpiredDetails() {
        $('#supplier-options').val("");
        $('#date-returned-input').val("");
        $('#returned-by-input').val("");
        setCDCrudMode("create");
        showDialog("expiredDetailsFormDialog");
    }

    function getProductOptions(callback) {
        $.ajax({
            url: '/?action=getProductOptions',
            method: 'GET',
            success: function(response) {
                $('#product-options').html(response);
                if (typeof callback === 'function') {
                    callback();
                }
            },
            error: function(xhr, status, error) {
                // Handle errors if necessary
                console.error(error);
            }
        });
    }

    function getSupplierOptions(callback) {
        $.ajax({
            url: '/?action=getSupplierOptions',
            method: 'GET',
            success: function(response) {
                $('#supplier-options').html(response);
                if (typeof callback === 'function') {
                    callback();
                }
            },
            error: function(xhr, status, error) {
                // Handle errors if necessary
                console.error(error);
            }
        });
    }

    function getExpiredProduct(query) {
        $.ajax({
            url: '/?action=getExpiredProduct',
            method: 'GET',
            dataType: 'json',
            data: {
                id: query
            },
            success: function(expired_product) {
                getProductOptions(function() {
                    $("#ep-id").val(expired_product.ep_id);
                    $('#product-options').val(expired_product.prod_id);
                    $('#barcode').val(expired_product.barcode);
                    $('#particulars').val(expired_product.particulars);
                    $('#expiry-date').val(expired_product.expiry_date);
                    $('#unit-price').val(expired_product.unit_price);
                    $('#selling-price').val(expired_product.selling_price);
                    $('#quantity').val(expired_product.quantity);
                    $('#amount').val(expired_product.amount);
                    setCPCrudMode("update");
                });
            }
        });
    }

    function setCPCrudMode(state = "") {
        var delbtn = $('#ep-delete');
        var savbtn = $('#ep-update');
        var crtbtn = $('#ep-create');
        switch (state) {
            case "update":
                delbtn.show();
                savbtn.show();
                crtbtn.hide();
                break;
            default:
                delbtn.hide();
                savbtn.hide();
                crtbtn.show();
                break;
        }
    }

    function setCDCrudMode(state = "") {
        var delbtn = $('#ed-delete');
        var savbtn = $('#ed-update');
        var crtbtn = $('#ed-create');
        switch (state) {
            case "update":
                delbtn.show();
                savbtn.show();
                crtbtn.hide();
                break;
            default:
                delbtn.hide();
                savbtn.hide();
                crtbtn.show();
                break;
        }
    }


    $(document).ready(function() {
        $('#ep-form').submit(function(event) {
            event.preventDefault();

            // Get the form data
            var formData = $(this).serialize();
            formData += "&ed-id=" + $('#ed-id').val();

            // Get the clicked button value
            switch ($(document.activeElement).val()) {
                case "create":
                    $.ajax({
                        type: 'POST',
                        url: '/?action=createExpiredProduct',
                        data: formData,
                        success: function(response) {
                            getExpiredProducts($('#ed-id').val());
                            showDialog("expiredProductDialog", false);
                            setCPCrudMode("");
                        }
                    });
                    break;
                case "update":
                    console.log(formData);
                    $.ajax({
                        type: 'POST',
                        url: '/?action=updateExpiredProduct',
                        data: formData,
                        success: function(response) {
                            getExpiredProducts($('#ed-id').val());
                            showDialog("expiredProductDialog", false);
                            setCPCrudMode("");
                        },
                        error: function(xhr, status, error) {
                            // Handle errors if necessary
                            console.error(error);
                        }
                    });
                    break;
                case "delete":
                    $.ajax({
                        type: 'POST',
                        url: '/?action=deleteExpiredProduct',
                        data: formData,
                        success: function(response) {
                            getExpiredProducts($('#ed-id').val());
                            showDialog("expiredProductDialog", false);
                            setCPCrudMode("");
                        },
                        error: function(xhr, status, error) {
                            // Handle errors if necessary
                            console.error(error);
                        }
                    });
                    break;
                default:
                    console.log(formData)
                    break;
            }
        });

        $('#ed-form').submit(function(event) {
            event.preventDefault();

            // Get the form data
            var formData = $(this).serialize();

            // Get the clicked button value
            switch ($(document.activeElement).val()) {
                case "create":
                    $.ajax({
                        type: 'POST',
                        url: '/?action=createExpiredDetails',
                        data: formData,
                        success: function(response) {
                            setCDCrudMode();
                            showDialog('expiredDetailsFormDialog', false);
                            getExpiredDetailsList();
                        }
                    });
                    break;
                case "update":
                    $.ajax({
                        type: 'POST',
                        url: '/?action=updateExpiredDetails',
                        data: formData,
                        success: function(response) {
                            setCDCrudMode();
                            showDialog('expiredDetailsFormDialog', false);
                            getExpiredDetails($('#ed-id').val());
                            getExpiredDetailsList();
                        }
                    });
                    break;
                case "delete":
                    $.ajax({
                        type: 'POST',
                        url: '/?action=deleteExpiredDetails',
                        data: formData,
                        success: function(response) {
                            setCDCrudMode();
                            showDialog('expiredDetailsFormDialog', false);
                            showDialog('expiredDetailsDialog', false);
                            getExpiredDetailsList();
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: '/?action=deleteExpiredProducts',
                        data: formData,
                        success: function(response) {
                            setCDCrudMode();
                            showDialog('expiredDetailsFormDialog', false);
                            showDialog('expiredDetailsDialog', false);
                            getExpiredDetailsList();
                        }
                    });
                    break;
                default:
                    break;
            }
        });

        getExpiredDetailsList();
        getSupplierOptions();
        setCDCrudMode();
    });
</script>
<?php
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/resources/layouts/manager_layout.php';
?>