<?php
// search.php
include "../../models/prodDAO.php";

$proddao = new ProdDAO();
$prod_id = $_GET['id'];

$product = $proddao->getProduct($prod_id);
// Return first result
echo json_encode($product);
