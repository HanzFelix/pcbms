<?php
$title = "Returned Products";
$error = "";

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
<!--ExpiredDetailsDialog-->
<dialog id="expiredDetailsDialog" class="backdrop:backdrop-brightness-50  bg-secondary border-t-4 border-primary p-4">
    <div class="flex justify-between items-end mb-2 gap-2">
        <div>
            <p>Supplier: <span id="ed-supplier" class="font-semibold">SupplierName</span> </p>
            <p>Returned by: <span id="ed-personnel" class="font-semibold">Personnel</span> </p>
        </div>
        <div>
            <p>Date Returned: <span id="ed-date" class="font-semibold">20/20/20XX</span></p>
        </div>
    </div>
    <div class="overflow-x-auto w-full" id="eptable">
    </div>

    <footer class="flex justify-end gap-2 mt-2">
        <button id="close-ed-modal" onclick="showDialog('expiredDetailsDialog',false)" class="bg-accent text-white py-2 px-4 rounded-md" value="0">Close</button>
    </footer>
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
                $('#edtable').html(response)

                $('#edtable').on('click', function(e) {
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
                $('#ed-id').val(expired_details.ed_id);
                $('#ed-supplier').text(expired_details.company);
                $('#ed-personnel').text(expired_details.personnel);
                $('#ed-date').text(expired_details.date);
                $('#supplier-options').val(expired_details.supp_id);
                $('#returned-by-input').val(expired_details.userid);
                $('#date-returned-input').val(expired_details.date);
            },
            error: function(xhr, status, error) {
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
                $('#eptable').html(response);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }

    $(document).ready(function() {
        getExpiredDetailsList();
    });
</script>
<?php
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/resources/layouts/manager_layout.php';
?>