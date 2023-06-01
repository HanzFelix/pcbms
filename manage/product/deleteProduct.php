<?php
include "../../models/prodDAO.php";

$proddao = new ProdDAO();

// Retrieve the submitted form data
$prod_id = $_POST['id'];

$product = $proddao->deleteProduct($prod_id);

// Return the response
echo "success";
