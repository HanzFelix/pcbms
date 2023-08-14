<?php
// search.php
include "../../models/dlvDAO.php";

$dlvdao = new DlvDAO();
$company = $_GET['search-input'];

$result = $dlvdao->getConsignedDetailsList($company);
// Build the HTML dropdown with the search results
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<button value="' . $row['cd_id'] . '" id="button-consigned_det" class="text-left truncate">' . $row['date'] . ' - ' . $row['company'] . '</button>';
    }
} else {
    echo 'No results found';
}
