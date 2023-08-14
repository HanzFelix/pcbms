<?php
$title = "Manage Suppliers";
$error = "";
// Check if an error message exists
if (isset($_SESSION['error_message'])) {
    $error = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

ob_start();
?>
<main class="container mx-auto bg-shade">
    <h2 class="text-center text-3xl p-4 font-bold">Supplier Data CRUD</h2>
    <div class="flex gap-4 px-4 items-start">
        <section class="flex flex-col w-3/12 gap-2">
            <form class="flex" action="#" id="search-form">
                <input class="w-full" type="text" name="search-input" id="search-input" placeholder="Type few letters here" />
                <button class="bg-primary text-white py-2 px-4 rounded-r-md" type="submit" id="search-button">GO</button>
            </form>
            <div multiple id="search-results" class="bg-white min-h-[12rem] flex flex-col items-stretch">

            </div>
            <div class="flex items-center justify-end gap-2">
                <button class="bg-accent text-white py-2 px-4 rounded-md" id="new-button">NEW</button>
            </div>
        </section>
        <form class="w-9/12 flex flex-col gap-4 bg-secondary p-4 border-t-4 border-primary" action="#" id="supplier-form">
            <input type="text" name="id" id="id" hidden value="0" />
            <div class="flex items-center gap-4">
                <p class="w-40 text-right">Company Name</p>
                <input name="company-name" id="company-name" type="text" class="border border-primary w-full disabled:bg-secondary" disabled />
            </div>
            <div class="flex items-center gap-4">
                <p class="w-40 text-right">Contact Person</p>
                <input name="contact-person" id="contact-person" type="text" class="border border-primary w-full disabled:bg-secondary" disabled />
            </div>
            <div class="flex items-center gap-4">
                <p class="w-40 text-right">Sex</p>
                <select name="sex" id="sex" class=" w-full px-3 py-2 disabled:bg-secondary" disabled>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Non-Binary">Non-Binary</option>
                </select>
            </div>
            <div class="flex items-center gap-4">
                <p class="w-40 text-right">Address</p>
                <input type="text" name="address" id="address" class="border border-primary w-full disabled:bg-secondary" disabled />
            </div>
            <div class="flex items-center gap-4">
                <p class="w-40 text-right">Phone</p>
                <input type="tel" name="phone" id="phone" class="border border-primary w-full disabled:bg-secondary" disabled />
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
    function getSupplier(query) {
        $.ajax({
            url: '/?action=getSupplier',
            method: 'GET',
            dataType: 'json',
            data: {
                suppid: query
            },
            success: function(supplier) {
                $('#company-name, #contact-person, #sex, #address, #phone').prop('disabled', false);
                // Update the search results container
                $('#id').val(supplier.supp_id);
                $("#company-name").val(supplier.company);
                $('#contact-person').val(supplier.contact_person);
                $('#sex').val(supplier.sex);
                $('#address').val(supplier.address);
                $('#phone').val(supplier.phone);
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

    function clearText(isDisabled) {
        $('#id').val(0);
        $('#company-name').val("");
        $('#contact-person').val("");
        $('#sex').val("");
        $('#address').val("");
        $('#phone').val("");

        $('#company-name').prop('disabled', isDisabled);
        $('#contact-person').prop('disabled', isDisabled);
        $('#sex').prop('disabled', isDisabled);
        $('#address').prop('disabled', isDisabled);
        $('#phone').prop('disabled', isDisabled);
    }


    $(document).ready(function() {
        $('#supplier-form').submit(function(event) {
            event.preventDefault();

            // Get the form data
            var formData = $(this).serialize();

            // Get the clicked button value
            switch ($(document.activeElement).val()) {
                case "create":
                    $.ajax({
                        type: 'POST',
                        url: '/?action=createSupplier',
                        data: formData,
                        success: function(response) {
                            clearText(true);
                            setCrudMode("");
                            $('#search-form').submit();
                        }
                    });
                    break;
                case "update":
                    $.ajax({
                        type: 'POST',
                        url: '/?action=updateSupplier',
                        data: formData,
                        success: function(response) {
                            clearText(true);
                            setCrudMode("");
                            $('#search-form').submit();
                        }
                    });
                    break;
                case "delete":
                    $.ajax({
                        type: 'POST',
                        url: '/?action=deleteSupplier',
                        data: formData,
                        success: function(response) {
                            clearText(true);
                            setCrudMode("");
                            $('#search-form').submit();
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
                url: '/?action=searchSupplier',
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
                        var supp_id = $(e.target).val();

                        getSupplier(supp_id);
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
        });

        // show all results on ready
        $('#search-form').submit();
    });
</script>

<?php
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/resources/layouts/manager_layout.php';
?>