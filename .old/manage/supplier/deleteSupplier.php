<?php
include "../../models/mgtDAO.php";

$mgtdao = new MgtDAO();

// Retrieve the submitted form data
$supp_id = $_POST['id'];

$supplier = $mgtdao->deleteSupplier($supp_id);

// Return the response
echo "success";
