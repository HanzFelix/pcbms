<?php
$title = "Sold Products";
$error = "";

if (isset($_SESSION['error_message'])) {
    $error = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

ob_start();
?>
<main class="container mx-auto bg-shade">
    <h2 class="text-center text-3xl p-4 font-bold">SOLD PRODUCTS</h2>
    <div class="w-full overflow-x-auto" id="sdtable">
    </div>
</main>
<!--OrderDetailsProducts-->
<dialog id="saleProductListDialog" class="backdrop:backdrop-brightness-50  bg-secondary border-t-4 border-primary p-4">
    <div class="flex justify-between items-start mb-2 gap-4">
        <div>
            <p>Customer: <span id="sd-customer" class="font-semibold">UserName</span> </p>
            <p>Issued by: <span id="sd-personnel" class="font-semibold">SupplierName</span> </p>
        </div>
        <div>
            <p>Date Issued: <span id="sd-date" class="font-semibold">20/20/20XX</span></p>
        </div>
    </div>
    <div class="overflow-x-auto" id="sptable">
    </div>
    <footer class="flex justify-end gap-2 mt-2 items-center">
        <button onclick="showDialog('saleProductListDialog',false)" class="bg-accent text-white py-2 px-4 rounded-md" type="button">Close</button>
    </footer>
</dialog>
<script>
    function getSaleDetailsList() {
        $.ajax({
            url: '/?action=getSaleDetailsList',
            method: 'GET',
            success: function(response) {
                $('#sdtable').html(response);

                $('#sdtable').on('click', function(e) {
                    if (!$(e.target).val()) {
                        return;
                    }
                    var sd_id = $(e.target).val();
                    getSaleProductList(sd_id);
                    getSaleDetails(sd_id)
                    $('#s-id').val(sd_id);
                    showDialog("saleProductListDialog");
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function getSaleDetails(id) {
        $.ajax({
            url: '/?action=getSaleDetails',
            method: 'GET',
            dataType: 'json',
            data: {
                sd_id: id
            },
            success: function(response) {
                $('#sd-customer').text(response.customer);
                $('#sd-personnel').text(response.personnel);
                $('#sd-date').text(response.date);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

    }

    function getSaleProductList(id) {
        $.ajax({
            url: '/?action=getSaleProductList',
            method: 'GET',
            data: {
                id: id
            },
            success: function(response) {
                $('#sptable').html(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function showDialog(dialogId, bool = true) {
        if (bool) {
            document.getElementById(dialogId).showModal();
        } else {
            document.getElementById(dialogId).close();
        }
    }

    $(document).ready(function() {
        getSaleDetailsList();
    });
</script>
<?php
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/resources/layouts/cashier_layout.php';
?>