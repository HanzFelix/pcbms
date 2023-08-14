<?php
// search.php
include "../../models/dlvDAO.php";

$dlvdao = new DlvDAO();
$cd_id = $_GET['id'];

$consigned = $dlvdao->getConsignedDetails($cd_id);
// Return first result
echo json_encode($consigned);
