<?php
// search.php
include "../../models/dlvDAO.php";

$dlvdao = new DlvDAO();
$cp_id = $_GET['id'];

$consigned_product = $dlvdao->getConsignedProduct($cp_id);
// Return first result
echo json_encode($consigned_product);
