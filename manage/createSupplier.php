<?php
include "../models/mgtDAO.php";

$mgtdao = new MgtDAO();

// Retrieve the submitted form data
$name = $_POST['company-name'];
$contact = $_POST['contact-person'];
$sex = $_POST['sex'];
$address = $_POST['address'];
$phone = $_POST['phone'];

$supplier = $mgtdao->createSupplier($name, $contact, $sex, $address, $phone);

// Return the response
echo "success";
