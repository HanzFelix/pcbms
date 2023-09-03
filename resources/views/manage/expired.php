<?php
$title = "Expired Products";
$error = "";

if (isset($_SESSION['error_message'])) {
    $error = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

ob_start();
?>
<main class="container mx-auto bg-shade">
    <h2 class="text-center text-3xl p-4 font-bold">EXPIRED PRODUCTS</h2>
    <div class="w-full overflow-x-auto" id="estable">
    </div>
</main>
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
    function getExpiredListBySupplier() {
        $.ajax({
            url: '/?action=getExpiredListBySupplier',
            method: 'GET',
            success: function(response) {
                $('#estable').html(response);

                $('#estable').on('click', function(e) {
                    if (!$(e.target).val()) {
                        return;
                    }
                    var s_id = $(e.target).val();
                    getExpiredProductListFromSupplier(s_id);
                    getSupplier(s_id)
                    $('#s-id').val(s_id);
                    showDialog("supplierExpiredDialog");
                });
            },
            error: function(xhr, status, error) {
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
                console.error(error);
            }
        });
    }

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
                console.log(error);
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

    function createExpiredProducts(ed_id) {
        var dataToSend = [];
        $('form#esd-form input[type="checkbox"]:checked').each(function() {
            var cp_check = $(this);
            var ep_quantity = cp_check.closest('tr').find('input[type="text"]');

            dataToSend.push({
                cp_id: cp_check.val(),
                unsold_quantity: ep_quantity.val(),
                ed_id: ed_id
            });
        });

        dataToSend.forEach(function(item) {
            $.ajax({
                url: '/?action=createExpiredProduct',
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