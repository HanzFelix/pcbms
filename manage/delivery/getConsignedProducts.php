<?php
// search.php
include "../../models/dlvDAO.php";

$dlvdao = new DlvDAO();
$cd_id = $_GET['id'];

$result = $dlvdao->getConsignedProducts($cd_id);
// Build the HTML dropdown with the search results
if (mysqli_num_rows($result) > 0) {
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr class="bg-accent ' . ($i % 2 == 0 ? 'bg-opacity-10' : 'bg-opacity-25') . '">
            <td class="px-4 py-2">' . $row["product-name"] . ' (x' . $row["quantity"] . ') </td>
            <td class="px-4 py-2">' . $row["particulars"] . '</td>
            <td class="px-4 py-2">' . $row["exp-date"] . '</td>
            <td class="px-4 py-2">Php ' . $row["unit-price"] . '</td>
            <td class="px-4 py-2">Php ' . $row["selling-price"] . '</td>
            <td class="px-4 py-2">
                <button class="bg-primary text-white px-3 rounded-full py-1 text-xs" value="' . $row["item-id"] . '">EDIT</button>
            </td>
        </tr>';
        $i++;
    }
} else {
    echo 'No results found';
}
