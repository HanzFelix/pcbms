<!--OrderDetailsForm-->
<dialog id="orderDetailsFormDialog" class="backdrop:backdrop-brightness-50 bg-secondary border-t-4 border-primary p-4">
    <form class="flex flex-col gap-4" action="#" id="od-form">
        <input name="od-id" id="od-id" hidden>
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
</dialog>
<!--OrderDetailsProducts-->
<dialog id="orderDetailsDialog" class="backdrop:backdrop-brightness-50  bg-secondary border-t-4 border-primary p-4">
    <div class="flex justify-between items-start mb-2 gap-4">
        <div>
            <p>Supplier: <span id="od-supplier" class="font-semibold">SupplierName</span> </p>
            <p>Ordered by: <span id="od-personnel" class="font-semibold">UserName</span> </p>
            <p>Order Date: <span id="od-date" class="font-semibold">20/20/20XX</span></p>
        </div>
        <div>
            <p>Actions: <span><button class="bg-primary text-white px-3 rounded-full py-1 text-xs" type="button" onclick="showDialog('orderDetailsFormDialog')">EDIT ORDER DETAILS</button></span></p>
            <p>Status: <span id="od-status" class="font-semibold">Unknown</span></p>
        </div>
    </div>
    <div class="overflow-x-auto" id="optable">
    </div>

    <footer class="flex justify-end gap-2 mt-2">
        <button id="op-new" onclick="newOrderProduct()" class="bg-primary text-white py-2 px-4 rounded-md" value="0">Add Product</button>
        <button id="close-od-modal" onclick="showDialog('orderDetailsDialog',false)" class="bg-accent text-white py-2 px-4 rounded-md" value="0">Close</button>
    </footer>
</dialog>
<!--OrderProduct-->
<dialog id="orderProductDialog" class="backdrop:backdrop-brightness-50 rounded-xl bg-secondary border-t-4 border-primary p-4">
    <form class="flex flex-col gap-4" action="#" id="op-form">
        <input name="op-id" id="op-id" hidden>
        <header class="flex items-start justify-between">
            <h1 class="text-2xl font-bold" id="testh1">Order Product</h1>
            <button type="button" onclick="showDialog('orderProductDialog',false)" id="close-op-modal" class="ml-auto inline-flex items-center rounded-lg p-1.5 text-sm text-zinc-400 hover:bg-zinc-200 hover:text-orange-600 transition-colors">
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
            <p class="w-40 text-right">Quantity</p>
            <input name="quantity" id="quantity" type="text" placeholder="0" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <footer class="flex justify-end gap-2">
            <button id="op-create" class="bg-primary text-white py-2 px-4 rounded-md" value="create">Create</button>
            <button id="op-update" class="bg-primary text-white py-2 px-4 rounded-md" value="update">Update</button>
            <button id="op-delete" class="bg-accent text-white py-2 px-4 rounded-md" value="delete">Delete</button>
            <button id="op-cancel" type="button" onclick="showDialog('orderProductDialog',false)" class="bg-accent text-white py-2 px-4 rounded-md" value="0">Cancel</button>
        </footer>
    </form>
</dialog>
<script>
    function getOrderDetailsList() {
        $.ajax({
            url: '/?action=getOrderDetailsList',
            method: 'GET',
            success: function(response) {
                $('#odtable').html(response);

                $('#odtable').on('click', function(e) {
                    if (!$(e.target).val()) {
                        return;
                    }
                    var od_id = $(e.target).val();
                    getOrderProducts(od_id);
                    getOrderDetails(od_id);
                    showDialog("orderDetailsDialog");
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function getOrderProducts(query) {
        $.ajax({
            url: '/?action=getOrderProductList',
            method: 'GET',
            data: {
                id: query
            },
            success: function(response) {
                $('#optable').html(response);

                $('#optable').on('click', function(e) {
                    if (!$(e.target).val()) {
                        return;
                    }
                    var op_id = $(e.target).val();
                    getOrderProduct(op_id);
                    showDialog("orderProductDialog")
                });
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }

    function getOrderDetails(query) {
        $.ajax({
            url: '/?action=getOrderDetails',
            method: 'GET',
            dataType: 'json',
            data: {
                id: query
            },
            success: function(order_details) {
                $('#od-id').val(order_details.od_id);
                $('#od-supplier').text(order_details.supplier);
                $('#od-personnel').text(order_details.personnel);
                $('#od-date').text(order_details.date);
                $('#od-status').text(order_details.status);
                $('#supplier-options').val(order_details.supp_id);
                $('#ordered-by-input').val(order_details.emp_id);
                $('#order-date-input').val(order_details.date);
                $('#status-options').val(order_details.status);
                setODCrudMode("update");
            },
            error: function(xhr, status, error) {
                console.error(error);
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


    function newOrderProduct() {
        getProductOptions(function() {
            $("#op-id").val("");
            $('#product-options').val("");
            $('#quantity').val("");
        });
        setOPCrudMode("create");
        showDialog("orderProductDialog");
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
                console.error(error);
            }
        });
    }

    function getOrderProduct(query) {
        $.ajax({
            url: '/?action=getOrderProduct',
            method: 'GET',
            dataType: 'json',
            data: {
                id: query
            },
            success: function(order_product) {
                getProductOptions(function() {
                    $("#op-id").val(order_product.op_id);
                    $('#product-options').val(order_product.prod_id);
                    $('#quantity').val(order_product.quantity);
                    setOPCrudMode("update");
                });
            }
        });
    }

    function setOPCrudMode(state = "") {
        var delbtn = $('#op-delete');
        var savbtn = $('#op-update');
        var crtbtn = $('#op-create');
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

    function setODCrudMode(state = "") {
        var delbtn = $('#od-delete');
        var savbtn = $('#od-update');
        var crtbtn = $('#od-create');
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
        $('#op-form').submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();
            formData += "&od-id=" + $('#od-id').val();

            switch ($(document.activeElement).val()) {
                case "create":
                    $.ajax({
                        type: 'POST',
                        url: '/?action=createOrderProduct',
                        data: formData,
                        success: function(response) {
                            getOrderProducts($('#od-id').val());
                            showDialog("orderProductDialog", false);
                            setOPCrudMode("");
                        }
                    });
                    break;
                case "update":
                    $.ajax({
                        type: 'POST',
                        url: '/?action=updateOrderProduct',
                        data: formData,
                        success: function(response) {
                            getOrderProducts($('#od-id').val());
                            showDialog("orderProductDialog", false);
                            setOPCrudMode("");
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                    break;
                case "delete":
                    $.ajax({
                        type: 'POST',
                        url: '/?action=deleteOrderProduct',
                        data: formData,
                        success: function(response) {
                            getOrderProducts($('#od-id').val());
                            showDialog("orderProductDialog", false);
                            setOPCrudMode("");
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                    break;
                default:
                    console.log(formData)
                    break;
            }
        });

        $('#od-form').submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();

            switch ($(document.activeElement).val()) {
                case "create":
                    $.ajax({
                        type: 'POST',
                        url: '/?action=createOrderDetails',
                        data: formData,
                        success: function(response) {
                            setODCrudMode();
                            showDialog('orderDetailsFormDialog', false);
                            getOrderDetailsList();
                        }
                    });
                    break;
                case "update":
                    $.ajax({
                        type: 'POST',
                        url: '/?action=updateOrderDetails',
                        data: formData,
                        success: function(response) {
                            setODCrudMode();
                            showDialog('orderDetailsFormDialog', false);
                            getOrderDetails($('#od-id').val());
                            getOrderDetailsList();
                        }
                    });
                    break;
                case "delete":
                    $.ajax({
                        type: 'POST',
                        url: '/?action=deleteOrderDetails',
                        data: formData,
                        success: function(response) {
                            setODCrudMode();
                            showDialog('orderDetailsFormDialog', false);
                            showDialog('orderDetailsDialog', false);
                            getOrderDetailsList();
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: '/?action=deleteOrderProducts',
                        data: formData,
                        success: function(response) {}
                    });
                    break;
                default:
                    break;
            }
        });

        getOrderDetailsList();
        getSupplierOptions();
        setODCrudMode();
    });
</script>