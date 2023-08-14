<?php
include "../../models/prodDAO.php";

$proddao = new ProdDAO();

// Retrieve the submitted form data
$prod_id = $_POST['id'];
$name = $_POST['product-name'];
$shelf_life = $_POST['shelf-life'];
$unit = $_POST['unit'];
$appreciation = $_POST['appreciation'];

$product = $proddao->updateProduct($prod_id, $name, $shelf_life, $unit, $appreciation);

// Return the response
echo "success";
