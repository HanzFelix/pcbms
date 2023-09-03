<?php
$title = "Dashboard";
$error = "";

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
                <div id="items">
                </div>
            </div>
            <div class="px-4">
                <div class="flex justify-between py-1">
                    <span>Total</span>
                    <span id="total">0.00</span>
                </div>
            </div>
        </div>
        <div class="bg-accent/10 p-4 rounded-md flex flex-col gap-2">
            <div class="bg-accent/10 w-96 h-24 p-4">
                <p>Product: <span class="font-bold" id="product-name">Waiting for item scanner...</span></p>
                <p>Selling price: <span class="font-bold" id="selling-price">...</span></p>
                <p>In Stock:<span class="font-bold" id="unsold-quantity">...</span> </p>
            </div>
            <div id="barcode-field" class="bg-white flex pr-2 py-2">
                <input value="" id="barcode-input" type="text" placeholder="or enter barcode..." class="border-l-4 border-0 focus:ring-0 focus:border-accent pl-2 border-primary basis-full bg-transparent py-0 text-xl font-bold">
                <button class="bg-primary px-4 py-1 font-bold text-white" onclick="$('#barcode-input').val('')">X</button>
            </div>
            <div id="quantity-field" class="bg-white flex pr-2 py-2">
                <input value="" id="quantity-input" type="text" placeholder="Enter quantity (Default: 1)" class="border-l-4 border-0 focus:ring-0 focus:border-accent pl-2 border-primary basis-full bg-transparent py-0 text-xl font-bold">
                <button class="bg-primary px-4 py-1 font-bold text-white" onclick="$('#quantity-input').val('')">X</button>
            </div>
            <div class="flex justify-stretch gap-1">
                <p id="barcode-tab" class="px-2 border-t-4  border-accent basis-full font-bold">Product</p>
                <p id="quantity-tab" class="px-2 border-t-4  border-accent border-opacity-40 basis-full">Quantity</p>
            </div>
            <div class="flex gap-1">
                <div class="grid basis-3/4 grid-cols-3 gap-1">
                    <?php foreach (array_merge(range(1, 9), ['0', '00', '.']) as $numkey) : ?>
                        <button class="numeric-key bg-primary text-white font-semibold text-2xl p-2 px-4" value="<?= $numkey ?>"><?= $numkey ?></button>
                    <?php endforeach ?>
                </div>
                <div class="flex flex-col basis-1/4 gap-1 justify-stretch">
                    <button id="add-sale" class="border-accent border-2 text-accent font-bold basis-full">Add Sale & Print Receipt</button>
                    <button id="barcode-enter" class="bg-accent text-white font-bold basis-full">Enter</button>
                    <button id="quantity-enter" class="bg-accent text-white font-bold basis-full">Enter</button>
                </div>
            </div>
        </div>
    </div>
</main>
<input id="cp-id" type="text" hidden>
<dialog>
    <button>Add sales</button>
</dialog>
<script>
    <?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
    var empid = <?= $_SESSION['empid'] ?>;

    var barcodeMode = true;

    function setBarcodeMode(bool) {
        if (bool) {
            $('#quantity-field').hide();
            $('#quantity-enter').hide();

            $('#barcode-field').show();
            $('#barcode-enter').show();

            $('#quantity-tab').addClass('border-opacity-40');
            $('#barcode-tab').addClass('font-bold');

            $('#barcode-tab').removeClass('border-opacity-40');
            $('#quantity-tab').removeClass('font-bold');
        } else {
            $('#quantity-field').show();
            $('#quantity-enter').show();

            $('#barcode-field').hide();
            $('#barcode-enter').hide();

            $('#quantity-tab').addClass('font-bold');
            $('#barcode-tab').addClass('border-opacity-40');

            $('#quantity-tab').removeClass('border-opacity-40');
            $('#barcode-tab').removeClass('font-bold');
        }
        barcodeMode = bool;
    }
    var productList = [];

    function searchProductWithBarcode() {
        var barcode = $('#barcode-input').val();
        $('#barcode-input').val('');

        $.ajax({
            url: '/?action=getConsignedProductWithBarcode',
            method: 'GET',
            dataType: 'json',
            data: {
                barcode: barcode
            },
            success: function(response) {
                if (response) {
                    $('#cp-id').val(response.cp_id);
                    $('#product-name').text(response.prod_name);
                    $('#selling-price').text(response.selling_price);
                    $('#unsold-quantity').text(response.unsold_quantity);
                    setBarcodeMode(false);
                } else {
                    $('#cp-id').val('');
                    $('#product-name').text('Product ' + barcode + ' not found');
                    $('#selling-price').text('');
                    $('#unsold-quantity').text('');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        })
    }

    function addProductQuantity() {
        var product = {
            cp_id: $('#cp-id').val(),
            name: $('#product-name').text(),
            price: parseFloat($('#selling-price').text()),
            quantity: $('#quantity-input').val() || '1'
        }

        productList.push(product);
        refreshProductList();
        $('#quantity-input').val('');
        setBarcodeMode(true);
    }

    $(document).ready(function() {
        $('#barcode-enter').click(searchProductWithBarcode)
        $('#quantity-enter').click(addProductQuantity);

        $('#calculate-total').click(function() {
            var total = calculateTotal();

            $('#total-amount').text(total.toFixed(2));
            $('#cash-input-dialog').show();
        })

        $('#add-sale').click(function() {
            $.ajax({
                url: '/?action=createSaleDetails',
                method: 'POST',
                data: {
                    date_issued: new Date().toISOString().split('T')[0],
                    cust_id: 1,
                    empid: empid
                },
                success: function(sd_id) {
                    createSaleProducts(sd_id);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            })
        });

        $('.numeric-key').click(function() {
            var keyValue = $(this).val();

            var inputField = barcodeMode ? $('#barcode-input') : $('#quantity-input');
            var currentInput = inputField.val();
            inputField.val(currentInput + keyValue);
        });

        $(document).on('keydown', function(event) {
            if ((event.keyCode >= 48 && event.keyCode <= 57) || event.keyCode === 8 || (event.keyCode >= 96 && event.keyCode <= 105)) {
                if (barcodeMode) {
                    $('#barcode-input').focus();
                } else {
                    $('#quantity-input').focus();
                }

            } else if (event.keyCode === 13) {
                if (barcodeMode) {
                    searchProductWithBarcode();
                } else {
                    addProductQuantity();
                }
            }
        });

        setBarcodeMode(true)
    });

    function createSaleProducts(sd_id) {
        for (const product of productList) {
            $.ajax({
                url: '/?action=createSaleProduct',
                method: 'POST',
                data: {
                    cp_id: product.cp_id,
                    qty_sold: product.quantity,
                    amount_sold: (product.price * product.quantity),
                    sd_id: sd_id
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }

        resetTransaction();
    }

    function refreshProductList() {
        var itemsContainer = $('#items');
        itemsContainer.empty();

        let i = 0;
        for (const p of productList) {
            var div = $('<div>');
            div.addClass('flex justify-between font-semibold px-4 py-2');
            div.addClass(i % 2 == 0 ? '' : 'bg-accent/20');
            var div2 = $('<div>').addClass('flex gap-1');
            div2.append($('<button>').text('✕').addClass('bg-accent/50 font-bold rounded-md text-white px-1').click((function(index) {
                return function() {
                    productList.splice(index, 1);
                    refreshProductList();
                };
            })(i)));
            div2.append($('<span>').text(p.name + ' x' + p.quantity));
            div.append(div2);
            div.append($('<span>').text((p.price * p.quantity).toFixed(2)));
            itemsContainer.append(div);
            i++;
        }
        $('#total').text(calculateTotal())
    }

    function removeFromProductList(index) {
        productList.splice(index, 1);
        refreshProductList();
    }

    function calculateTotal() {
        var total = 0.00;
        for (const p of productList) {
            total += p.price * p.quantity
        }
        return total.toFixed(2);
    }

    function resetTransaction() {
        productList = [];
        setBarcodeMode(true);
        refreshProductList();
    }
</script>
<?php
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/resources/layouts/cashier_layout.php';
?>