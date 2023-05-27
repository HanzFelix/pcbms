<?php
include "../headers/header.php";
include "../components/navigationBar.php"
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
                <button class="bg-primary text-white py-2 px-4 rounded-r-md" id="search-btn">GO</button>
            </div>
            <div multiple id="search-results" class="min-h-[12rem] flex flex-col items-stretch">

            </div>
            <div class="flex items-center justify-end gap-2">
                <button class="bg-accent text-white py-2 px-4 rounded-md">NEW</button>
            </div>
        </section>
        <form class="w-9/12 flex flex-col gap-4 bg-secondary p-4 border-t-4 border-primary" action="#">
            <div class="flex items-center gap-4">
                <p class="w-40 text-right">Company Name</p>
                <input name="company-name" id="company-name" type="text" class="border border-primary w-full" />
            </div>
            <div class="flex items-center gap-4">
                <p class="w-40 text-right">Contact Person</p>
                <input name="contact-person" id="contact-person" type="text" class="border border-primary w-full" />
            </div>
            <div class="flex items-center gap-4">
                <p class="w-40 text-right">Sex</p>
                <select name="sex" id="sex" class=" w-full px-3 py-2">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Non-Binary">Non-Binary</option>
                </select>
            </div>
            <div class="flex items-center gap-4">
                <p class="w-40 text-right">Address</p>
                <input type="text" name="address" id="address" class="border border-primary w-full" />
            </div>
            <div class="flex items-center gap-4">
                <p class="w-40 text-right">Phone</p>
                <input type="tel" name="phone" id="phone" class="border border-primary w-full" />
            </div>
            <div class="flex items-center justify-end gap-2">
                <button type="submit" class="bg-accent text-white py-2 px-4 rounded-md">Delete</button>
                <button type="submit" class="bg-primary text-white py-2 px-4 rounded-md">Save</button>
            </div>
        </form>
    </div>
</main>

<script>
    // show all results on load
    search('');
    // Add event listener to the search button
    document.getElementById('search-btn').addEventListener('click', function() {
        var searchQuery = document.getElementById('search').value;

        search(searchQuery);
    });

    function search(query) {
        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Define the AJAX request
        xhr.open('GET', '../search/searchSupplier.php?q=' + query, true);

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
        xhr.open('GET', '../search/getSupplier.php?id=' + query, true);

        // Define the callback function when the response is received
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Update the search results container
                var supplier = JSON.parse(xhr.responseText);
                document.getElementById('company-name').value = supplier.company;
                document.getElementById('contact-person').value = supplier.contact_person;
                document.getElementById('sex').value = supplier.sex;
                document.getElementById('address').value = supplier.address;
                document.getElementById('phone').value = supplier.phone;
            }
        };

        // Send the AJAX request
        xhr.send();
    }
</script>

<?php
include "../footers/footer.php";
?>