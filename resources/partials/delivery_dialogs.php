<!--ConsignedDetailsForm-->
<dialog id="consignedDetailsFormDialog" class="backdrop:backdrop-brightness-50 bg-secondary border-t-4 border-primary p-4">
    <form class="flex flex-col gap-4" action="#" id="cd-form">
        <input name="cd-id" id="cd-id" hidden>
        <header class="flex items-start justify-between">
            <h1 class="text-2xl font-bold" id="testh1">Consigned Details</h1>
            <button type="button" onclick="showDialog('consignedDetailsFormDialog',false)" class="ml-auto inline-flex items-center rounded-lg p-1.5 text-sm text-zinc-400 hover:bg-zinc-200 hover:text-orange-600 transition-colors">
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
            <input name="date-delivered" id="date-delivered-input" type="date" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <div class="flex items-center gap-4">
            <p class="w-40 text-right">Received by:</p>
            <input name="received-by" id="received-by-input" type="text" class="border border-primary w-full disabled:bg-secondary" />
        </div>
        <footer class="flex justify-end gap-2">
            <button id="cd-create" class="bg-primary text-white py-2 px-4 rounded-md" value="create">Create</button>
            <button id="cd-update" class="bg-primary text-white py-2 px-4 rounded-md" value="update">Update</button>
            <button id="cd-delete" class="bg-accent text-white py-2 px-4 rounded-md" value="delete">Delete</button>
            <button id="cd-cancel" type="button" onclick="showDialog('consignedDetailsFormDialog',false)" class="bg-accent text-white py-2 px-4 rounded-md" value="0">Cancel</button>
        </footer>
    </form>
</dialog>
<!--ConsignedDetailsProducts-->
<dialog id="consignedDetailsDialog" class="backdrop:backdrop-brightness-50  bg-secondary border-t-4 border-primary p-4">
    <div class="flex justify-between items-end mb-2">
        <div>
            <p>Supplier: <span id="cd-supplier" class="font-semibold">SupplierName</span> </p>
            <p>Received by: <span id="cd-username" class="font-semibold">UserName</span> </p>
        </div>
        <div>
            <p>Actions: <span><button class="bg-primary text-white px-3 rounded-full py-1 text-xs" type="button" onclick="showDialog('consignedDetailsFormDialog')">EDIT CONSIGNED DETAILS</button></span></p>
            <p>Date Delivered: <span id="cd-date" class="font-semibold">20/20/20XX</span></p>
        </div>
    </div>
    <div class="overflow-x-auto w-full" id="cptable">
    </div>

    <footer class="flex justify-end gap-2 mt-2">
        <button id="cp-new" onclick="newConsignedProduct()" class="bg-primary text-white py-2 px-4 rounded-md" value="0">Add Consigned Product</button>
        <button id="close-cd-modal" onclick="showDialog('consignedDetailsDialog',false)" class="bg-accent text-white py-2 px-4 rounded-md" value="0">Close</button>
    </footer>
</dialog>
<!--ConsignedProduct-->
<dialog class="backdrop:backdrop-brightness-50 rounded-xl bg-secondary border-t-4 border-primary p-4" id="consignedProductDialog">
    <form class="flex flex-col gap-4" action="#" id="cp-form">
        <input name="cp-id" id="cp-id" hidden>
        <header class="flex items-start justify-between">
            <h1 class="text-2xl font-bold" id="testh1">Consigned Product</h1>
            <button type="button" onclick="showDialog('consignedProductDialog',false)" id="close-cp-modal" class="ml-auto inline-flex items-center rounded-lg p-1.5 text-sm text-zinc-400 hover:bg-zinc-200 hover:text-orange-600 transition-colors">
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
            <button id="cp-create" class="bg-primary text-white py-2 px-4 rounded-md" value="create">Create</button>
            <button id="cp-update" class="bg-primary text-white py-2 px-4 rounded-md" value="update">Update</button>
            <button id="cp-delete" class="bg-accent text-white py-2 px-4 rounded-md" value="delete">Delete</button>
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

    function getConsignedDetailsList() {
        $.ajax({
            url: '/?action=getConsignedDetailsList',
            method: 'GET',
            success: function(response) {
                // Update the search results container
                //$('#cdlisttbody').html(response);
                $('#cdtable').html(response)

                // Add event listener to container when selecting a specific option
                $('#cdtable').on('click', function(e) {
                    // If selected container, or does not have a target attribute
                    if (!$(e.target).val()) {
                        return;
                    }
                    var cd_id = $(e.target).val();
                    getConsignedProducts(cd_id);
                    getConsignedDetails(cd_id);
                    document.getElementById("consignedDetailsDialog").showModal();
                });
            },
            error: function(xhr, status, error) {
                // Handle errors if necessary
                console.error(error);
            }
        });
    }

    function getConsignedDetails(query) {
        $.ajax({
            url: '/?action=getConsignedDetails',
            method: 'GET',
            dataType: 'json',
            data: {
                id: query
            },
            success: function(consigned_details) {
                //$('#id').val(consigned_details.cd_id);
                $('#cd-id').val(consigned_details.cd_id);
                $('#cd-supplier').text(consigned_details.company);
                $('#cd-username').text(consigned_details.username);
                $('#cd-date').text(consigned_details.date);
                $('#supplier-options').val(consigned_details.supp_id);
                $('#received-by-input').val(consigned_details.userid);
                $('#date-delivered-input').val(consigned_details.date);
                setCDCrudMode("update");
            },
            error: function(xhr, status, error) {
                // Handle errors if necessary
                console.error(error);
            }
        });
    }

    function getConsignedProducts(query) {
        $.ajax({
            url: '/?action=getConsignedProductList',
            method: 'GET',
            data: {
                id: query
            },
            success: function(response) {
                // Update the search results container
                $('#cptable').html(response);

                // Add event listener to container when selecting a specific option
                $('#cptable').on('click', function(e) {
                    // If selected container, or does not have a target attribute
                    if (!$(e.target).val()) {
                        return;
                    }
                    var cp_id = $(e.target).val();
                    getConsignedProduct(cp_id);
                    showDialog("consignedProductDialog")
                });
            },
            error: function(xhr, status, error) {
                // Handle errors, if any
                console.log(error);
            }
        });
    }

    function newConsignedProduct() {
        showDialog("consignedProductDialog");
        getProductOptions(function() {
            $("#cp-id").val("");
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

    function newConsignedDetails() {
        $('#supplier-options').val("");
        $('#date-delivered-input').val("");
        $('#received-by-input').val("");
        setCDCrudMode("create");
        showDialog("consignedDetailsFormDialog");
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

    function getConsignedProduct(query) {
        $.ajax({
            url: '/?action=getConsignedProduct',
            method: 'GET',
            dataType: 'json',
            data: {
                id: query
            },
            success: function(consigned_product) {
                getProductOptions(function() {
                    $("#cp-id").val(consigned_product.cp_id);
                    $('#product-options').val(consigned_product.prod_id);
                    $('#barcode').val(consigned_product.barcode);
                    $('#particulars').val(consigned_product.particulars);
                    $('#expiry-date').val(consigned_product.expiry_date);
                    $('#unit-price').val(consigned_product.unit_price);
                    $('#selling-price').val(consigned_product.selling_price);
                    $('#quantity').val(consigned_product.quantity);
                    $('#amount').val(consigned_product.amount);
                    setCPCrudMode("update");
                });
            }
        });
    }

    function setCPCrudMode(state = "") {
        var delbtn = $('#cp-delete');
        var savbtn = $('#cp-update');
        var crtbtn = $('#cp-create');
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
        var delbtn = $('#cd-delete');
        var savbtn = $('#cd-update');
        var crtbtn = $('#cd-create');
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
        $('#cp-form').submit(function(event) {
            event.preventDefault();

            // Get the form data
            var formData = $(this).serialize();
            formData += "&cd-id=" + $('#cd-id').val();

            // Get the clicked button value
            switch ($(document.activeElement).val()) {
                case "create":
                    $.ajax({
                        type: 'POST',
                        url: '/?action=createConsignedProduct',
                        data: formData,
                        success: function(response) {
                            getConsignedProducts($('#cd-id').val());
                            showDialog("consignedProductDialog", false);
                            setCPCrudMode("");
                        }
                    });
                    break;
                case "update":
                    console.log(formData);
                    $.ajax({
                        type: 'POST',
                        url: '/?action=updateConsignedProduct',
                        data: formData,
                        success: function(response) {
                            getConsignedProducts($('#cd-id').val());
                            showDialog("consignedProductDialog", false);
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
                        url: '/?action=deleteConsignedProduct',
                        data: formData,
                        success: function(response) {
                            getConsignedProducts($('#cd-id').val());
                            showDialog("consignedProductDialog", false);
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

        $('#cd-form').submit(function(event) {
            event.preventDefault();

            // Get the form data
            var formData = $(this).serialize();

            // Get the clicked button value
            switch ($(document.activeElement).val()) {
                case "create":
                    $.ajax({
                        type: 'POST',
                        url: '/?action=createConsignedDetails',
                        data: formData,
                        success: function(response) {
                            setCDCrudMode();
                            showDialog('consignedDetailsFormDialog', false);
                            getConsignedDetailsList();
                        }
                    });
                    break;
                case "update":
                    $.ajax({
                        type: 'POST',
                        url: '/?action=updateConsignedDetails',
                        data: formData,
                        success: function(response) {
                            setCDCrudMode();
                            showDialog('consignedDetailsFormDialog', false);
                            getConsignedDetails($('#cd-id').val());
                            getConsignedDetailsList();
                        }
                    });
                    break;
                case "delete":
                    $.ajax({
                        type: 'POST',
                        url: '/?action=deleteConsignedDetails',
                        data: formData,
                        success: function(response) {
                            setCDCrudMode();
                            showDialog('consignedDetailsFormDialog', false);
                            showDialog('consignedDetailsDialog', false);
                            getConsignedDetailsList();
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: '/?action=deleteConsignedProducts',
                        data: formData,
                        success: function(response) {
                            setCDCrudMode();
                            showDialog('consignedDetailsFormDialog', false);
                            showDialog('consignedDetailsDialog', false);
                            getConsignedDetailsList();
                        }
                    });
                    break;
                default:
                    break;
            }
        });

        getConsignedDetailsList();
        getSupplierOptions();
        setCDCrudMode();
    });
</script>