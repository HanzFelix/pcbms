<?php
// search.php
include "../../models/mgtDAO.php";

$mgtdao = new MgtDAO();
$company = $_GET['search-input'];

$result = $mgtdao->getSuppliers($company);
// Build the HTML dropdown with the search results
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<button value="' . $row['supp_id'] . '" id="button-supplier" class="text-left truncate">' . $row['company'] . ', ' . $row['contact_person'] . '</button>';
    }
} else {
    echo 'No results found';
}
