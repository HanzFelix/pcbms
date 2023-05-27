<?php
// search.php
include "../models/mgtDAO.php";

$mgtdao = new MgtDAO();
$supp_id = $_GET['id'];

$supplier = $mgtdao->getSupplier($supp_id);
// Return first result
echo json_encode($supplier);
