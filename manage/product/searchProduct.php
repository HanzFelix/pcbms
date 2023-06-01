<?php
// search.php
include "../../models/prodDAO.php";

$proddao = new ProdDAO();
$name = $_GET['q'];

$result = $proddao->getProducts($name);
// Build the HTML dropdown with the search results
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<button value="' . $row['prod_id'] . '" id="button-product" class="text-left truncate">' . $row['prod_name'] . '</button>';
    }
} else {
    echo 'No results found';
}
