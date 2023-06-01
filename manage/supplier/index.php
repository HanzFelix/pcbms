<?php
include "../../headers/header.php";
include "../../components/navigationBar.php"
?>

<!--Main-->
<main class="p-4">
    <h1 class="text-center text-3xl font-bold">Store Management</h1>
</main>
<!--Supplier Update -->
<main class="container mx-auto bg-shade">
    <h2 class="text-center text-2xl p-4 font-semibold">Supplier Data CRUD</h2>
    <div class="flex gap-4 px-4 items-start">
        <section class="flex flex-col w-3/12 gap-2">
            <div class="flex">
                <input class="w-full" type="text" name="" id="search" placeholder="Type few letters here" />
                <button class="bg-primary text-white py-2 px-4 rounded-r-md" id="search-button">GO</button>
            </div>
            <div multiple id="search-results" class="min-h-[12rem] flex flex-col items-stretch">

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
    // show all results on load
    search('');
    // Add event listener to the search button
    document.getElementById('search-button').addEventListener('click', function() {
        var searchQuery = document.getElementById('search').value;

        search(searchQuery);
    });
    document.getElementById('new-button').addEventListener('click', function() {
        clearText(false);
        setCrudMode("create");
    });


    function search(query) {
        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Define the AJAX request
        xhr.open('GET', '../supplier/searchSupplier.php?q=' + query, true);

        // Define the callback function when the response is received
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Update the search results container
                document.getElementById('search-results').innerHTML = xhr.responseText;

                // add event listener to container when selecting a specific option
                document.getElementById('search-results').addEventListener('click', function(e) {
                    // if selected container
                    if (!e.target.value) {
                        return;
                    }
                    var supp_id = e.target.value;

                    getSupplier(supp_id);
                });
            }
        };

        // Send the AJAX request
        xhr.send();
    }

    function getSupplier(query) {
        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Define the AJAX request
        xhr.open('GET', '../supplier/getSupplier.php?id=' + query, true);

        // Define the callback function when the response is received
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Update the search results container
                var supplier = JSON.parse(xhr.responseText);
                $('#id').val(supplier.supp_id);
                $('#company-name').val(supplier.company);
                $('#contact-person').val(supplier.contact_person);
                $('#sex').val(supplier.sex);
                $('#address').val(supplier.address);
                $('#phone').val(supplier.phone);
                setCrudMode("update");
                $('#company-name').prop('disabled', false);
                $('#contact-person').prop('disabled', false);
                $('#sex').prop('disabled', false);
                $('#address').prop('disabled', false);
                $('#phone').prop('disabled', false);
            }
        };

        // Send the AJAX request
        xhr.send();
    }

    function setCrudMode(state) {
        var delbtn = document.getElementById('delete-button');
        var savbtn = document.getElementById('save-button');
        var crtbtn = document.getElementById('create-button');
        switch (state) {
            case "update":
                delbtn.hidden = false;
                savbtn.hidden = false;
                crtbtn.hidden = true;
                break;
            case "create":
                delbtn.hidden = true;
                savbtn.hidden = true;
                crtbtn.hidden = false;
                break;
            default:
                delbtn.hidden = true;
                savbtn.hidden = true;
                crtbtn.hidden = true;
                break;
        }
    }

    function clearText(isDisabled) {
        document.getElementById('id').value = 0;
        document.getElementById('company-name').value = "";
        document.getElementById('contact-person').value = "";
        document.getElementById('sex').value = "";
        document.getElementById('address').value = "";
        document.getElementById('phone').value = "";

        // $("#company-name", "#contact-person").prop('disabled', isDisabled)
        document.getElementById('company-name').disabled = isDisabled;
        document.getElementById('contact-person').disabled = isDisabled;
        document.getElementById('sex').disabled = isDisabled;
        document.getElementById('address').disabled = isDisabled;
        document.getElementById('phone').disabled = isDisabled;
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
                        url: '../manage/createSupplier.php',
                        data: formData,
                        success: function(response) {
                            // Display the response from the PHP page
                            // $('#response').html(response);
                            clearText(true);
                            setCrudMode("");
                            document.getElementById('search-button').click();
                        }
                    });
                    break;
                case "update":
                    $.ajax({
                        type: 'POST',
                        url: '../manage/updateSupplier.php',
                        data: formData,
                        success: function(response) {
                            // Display the response from the PHP page
                            // $('#response').html(response);
                            clearText(true);
                            setCrudMode("");
                            document.getElementById('search-button').click();
                        }
                    });
                    break;
                case "delete":
                    $.ajax({
                        type: 'POST',
                        url: '../manage/deleteSupplier.php',
                        data: formData,
                        success: function(response) {
                            // Display the response from the PHP page
                            // $('#response').html(response);
                            clearText(true);
                            setCrudMode("");
                            document.getElementById('search-button').click();
                        }
                    });
                    break;
                default:
                    break;
            }

            // Proceed with form submission or prevent it based on your requirements
            // $(this).unbind('submit').submit();
        });
    });
</script>

<?php
include "../../footers/footer.php";
?>