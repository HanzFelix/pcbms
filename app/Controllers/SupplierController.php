<?php
include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/SupplierModel.php";

class SupplierController
{
    public function getSupplier()
    {
        $suppmodel = new SupplierModel();

        $supplier = $suppmodel->getSupplier($_GET['suppid']);
        echo json_encode($supplier);
    }

    public function getSupplierOptions()
    {

        $suppmodel = new SupplierModel();

        $suppliers = $suppmodel->getSupplierList();
        if (mysqli_num_rows($suppliers) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($suppliers)) {
                echo '<option value=' . $row["supp_id"] . '>' . $row["company"] . ' </option>';
                $i++;
            }
        }
    }

    public function searchSupplier()
    {
        $suppmodel = new SupplierModel();
        $result = $suppmodel->getSuppliers($_GET['search-input']);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<button value="' . $row['supp_id'] . '" id="button-supplier" class="text-left truncate">' . $row['company'] . ', ' . $row['contact_person'] . '</button>';
            }
        } else {
            echo 'No results found';
        }
    }

    public function createSupplier()
    {
        $suppmodel = new SupplierModel();

        $name = $_POST['company-name'];
        $contact = $_POST['contact-person'];
        $sex = $_POST['sex'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        $suppmodel->createSupplier($name, $contact, $sex, $address, $phone);
    }

    public function updateSupplier()
    {
        $suppmodel = new SupplierModel();

        $supp_id = $_POST['id'];
        $name = $_POST['company-name'];
        $contact = $_POST['contact-person'];
        $sex = $_POST['sex'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        $suppmodel->updateSupplier($supp_id, $name, $contact, $sex, $address, $phone);
    }

    public function deleteSupplier()
    {
        $suppmodel = new SupplierModel();

        $supp_id = $_POST['id'];

        $suppmodel->deleteSupplier($supp_id);
    }
}
