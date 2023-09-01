<?php
$title = "Orders";
$error = "";
// Check if an error message exists
if (isset($_SESSION['error_message'])) {
    $error = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

ob_start();
?>
<main class="container mx-auto bg-shade">
    <h2 class="text-center text-3xl p-4 font-bold">EXPIRED PRODUCTS</h2>
    <!--div class="flex items-center justify-end gap-2 my-2">
        <button onclick="newOrderDetails()" class="bg-primary text-white py-2 px-4 rounded-md" id="new-button">NEW ORDER</button>
    </div-->
    <div class="w-full overflow-x-auto" id="estable">
    </div>
</main>
<!--OrderDetailsForm>
<dialog id="orderDetailsFormDialog" class="backdrop:backdrop-brightness-50 bg-secondary border-t-4 border-primary p-4">
    <form class="flex flex-col gap-4" action="#" id="od-form">
        
        <header class="flex items-start justify-between">
            <h1 class="text-2xl font-bold" id="testh1">Order Details</h1>
            <button type="button" onclick="showDialog('orderDetailsFormDialog',false)" class="ml-auto inline-flex items-center rounded-lg p-1.5 text-sm text-zinc-400 hover:bg-zinc-200 hover:text-orange-600 transition-colors">
                <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </header>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Supplier</p>

            <select id="supplier-options" title="supplier" name="supplier" class="border border-primary w-full disabled:bg-secondary py-2 px-2" required>
            </select>
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Order Date</p>
            <input name="order-date" id="order-date-input" type="date" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Ordered by:</p>
            <input name="ordered-by" id="ordered-by-input" type="text" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Status:</p>
            <select name="status" id="status-options" type="text" class="border border-primary w-full disabled:bg-secondary">
                <option value="Pending">Pending</option>
                <option value="Received">Received</option>
                <option value="Cancelled">Cancelled</option>
            </select>
        </div>
        <footer class="flex justify-end gap-2">
            <button id="od-create" class="bg-primary text-white py-2 px-4 rounded-md" value="create">Create</button>
            <button id="od-update" class="bg-primary text-white py-2 px-4 rounded-md" value="update">Update</button>
            <button id="od-delete" class="bg-accent text-white py-2 px-4 rounded-md" value="delete">Delete</button>
            <button id="od-cancel" type="button" onclick="showDialog('orderDetailsFormDialog',false)" class="bg-accent text-white py-2 px-4 rounded-md" value="0">Cancel</button>
        </footer>
    </form>
</dialog-->
<!--OrderDetailsProducts-->
<dialog id="supplierExpiredDialog" class="backdrop:backdrop-brightness-50  bg-secondary border-t-4 border-primary p-4">
    <form action="#" method="post" id="esd-form">
        <div class="flex justify-between items-start mb-2 gap-4">
            <div>
                <p class="text-2xl"><span id="esd-supplier" class="font-semibold">SupplierName</span>'s Expired Products</p>
            </div>
        </div>
        <div class="overflow-x-auto" id="esptable">
        </div>

        <footer class="flex justify-end gap-2 mt-2 items-center">
            <input name="s-id" id="s-id" hidden>
            <label for="return-date">Return Date</label>
            <input type="date" name="return-date" id="return-date" class="border-none rounded-md" required>
            <button id="ed-new" class="bg-primary text-white py-2 px-4 rounded-md" value="create" type="submit">Return Products</button>
            <button id="close-se-modal" onclick="showDialog('supplierExpiredDialog',false)" class="bg-accent text-white py-2 px-4 rounded-md" type="button">Close</button>
        </footer>
    </form>
</dialog>
<script>
    // updated
    function getExpiredListBySupplier() {
        $.ajax({
            url: '/?action=getExpiredListBySupplier',
            method: 'GET',
            success: function(response) {
                // Update the search results container
                $('#estable').html(response);

                // Add event listener to container when selecting a specific option
                $('#estable').on('click', function(e) {
                    // If selected container, or does not have a target attribute
                    if (!$(e.target).val()) {
                        return;
                    }
                    var s_id = $(e.target).val();
                    getExpiredProductListFromSupplier(s_id);
                    getSupplier(s_id)
                    $('#s-id').val(s_id);
                    // something to transfer vals
                    showDialog("supplierExpiredDialog");
                });
            },
            error: function(xhr, status, error) {
                // Handle errors if necessary
                console.error(error);
            }
        });
    }

    function getSupplier(query) {
        $.ajax({
            url: '/?action=getSupplier',
            method: 'GET',
            dataType: 'json',
            data: {
                suppid: query
            },
            success: function(supplier) {
                $('#esd-supplier').text(supplier.company);
            },
            error: function(xhr, status, error) {
                // Handle errors if necessary
                console.error(error);
            }
        });

    }

    // others

    function getExpiredProductListFromSupplier(query) {
        $.ajax({
            url: '/?action=getExpiredProductListFromSupplier',
            method: 'GET',
            data: {
                id: query
            },
            success: function(response) {
                $('#esptable').html(response);
            },
            error: function(xhr, status, error) {
                // Handle errors, if any
                console.log(error);
            }
        });
    }

    function newOrderDetails() {
        $('#supplier-options').val("");
        $('#order-date-input').val("");
        $('#ordered-by-input').val("");
        $('#status-options').val("Pending");
        setODCrudMode("create");
        showDialog("orderDetailsFormDialog");
    }

    function showDialog(dialogId, bool = true) {
        if (bool) {
            document.getElementById(dialogId).showModal();
        } else {
            document.getElementById(dialogId).close();
        }
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

    function createExpiredProducts(ed_id) {
        var dataToSend = [];
        $('form#esd-form input[type="checkbox"]:checked').each(function() {
            var cp_check = $(this);
            var ep_quantity = cp_check.closest('tr').find('input[type="text"]');

            // Add selected data to the array
            dataToSend.push({
                cp_id: cp_check.val(),
                unsold_quantity: ep_quantity.val(),
                ed_id: ed_id
            });
        });

        dataToSend.forEach(function(item) {
            $.ajax({
                url: '/?action=createExpiredProduct', // Replace with your server-side script
                method: 'POST',
                data: {
                    cp_id: item.cp_id,
                    unsold_quantity: item.unsold_quantity,
                    ed_id: item.ed_id
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });

        showDialog('supplierExpiredDialog', false);
        getExpiredListBySupplier();
    }

    $(document).ready(function() {

        $('#esd-form').submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();
            var formData2 = $(this).serializeArray()

            switch ($(document.activeElement).val()) {

                case "create":
                    $.ajax({
                        type: 'POST',
                        url: '/?action=createExpiredDetails',
                        data: formData,
                        success: function(ed_id) {
                            createExpiredProducts(ed_id);
                        }
                    });
                    break;
                default:
                    break;
            }
        });

        getExpiredListBySupplier();
    });
</script>
<?php
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/resources/layouts/manager_layout.php';
?>