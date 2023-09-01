<?php

class ConsignedProductController
{
    public function getConsignedDetails()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConsignedDetailsModel.php";
        $condetails = new ConsignedDetailsModel();

        $consigned_details = $condetails->getConsignedDetails($_GET['id']);
        // Return first result
        echo json_encode($consigned_details);
    }

    public function getConsignedProduct()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConsignedProductModel.php";
        $conproduct = new ConsignedProductModel();

        $consigned_product = $conproduct->getConsignedProduct($_GET['id']);
        // Return first result
        echo json_encode($consigned_product);
    }

    public function getConsignedProductWithBarcode()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConsignedProductModel.php";
        $conproduct = new ConsignedProductModel();

        $consigned_product = $conproduct->getConsignedProductWithBarcode($_GET['barcode']);
        echo json_encode($consigned_product);
    }

    public function getConsignedDetailsList()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConsignedDetailsModel.php";
        $condetails = new ConsignedDetailsModel();

        $result = $condetails->getConsignedDetailsList();
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = [
                    $row["cd_id"],
                    $row["company"],
                    $row["personnel"],
                    $row["date"],
                    '<button class="bg-primary text-white px-3 rounded-full py-1 text-xs" value="' . $row["cd_id"] . '">VIEW</button>',
                ];
            }
        } else {
            $data[] = ['No results found', "", "", "", ""];
        }

        $headerLabels = ["ID", "Supplier", "Received by", "Date Delivered", "Action"];
        include $_SERVER['DOCUMENT_ROOT'] . "/resources/partials/table.php";
        echo generateTable($data, $headerLabels);
    }

    public function getConsignedProductList()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConsignedProductModel.php";
        $conproduct = new ConsignedProductModel();

        $result = $conproduct->getConsignedProductList($_GET['id']);
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = [
                    $row["product-name"] . ' (x' . $row["quantity"] . ')',
                    $row["barcode"],
                    $row["particulars"],
                    $row["exp-date"],
                    $row["unit-price"],
                    $row["selling-price"],
                    '<button class="bg-primary text-white px-3 rounded-full py-1 text-xs" value="' . $row["cp-id"] . '">EDIT</button>',
                ];
            }
        } else {
            $data[] = ['No results found', "", "", "", "", "", ""];
        }

        $headerLabels = ["Product Name (Qty)", "Barcode", "Particular", "Expiry Date", "Unit Price", "Selling Price", "Action"];
        include $_SERVER['DOCUMENT_ROOT'] . "/resources/partials/table.php";
        echo generateTable($data, $headerLabels);
    }

    public function createConsignedProduct()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConsignedProductModel.php";
        $conproduct = new ConsignedProductModel();
        $conproduct->createConsignedProduct($_POST['cd-id'], $_POST['product'], $_POST['barcode'], $_POST['particulars'], $_POST['expiry-date'], $_POST['unit-price'], $_POST['selling-price'], $_POST['quantity'], $_POST['amount']);
        echo "done";
    }

    public function updateConsignedProduct()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConsignedProductModel.php";
        $conproduct = new ConsignedProductModel();
        $conproduct->updateConsignedProduct($_POST['cp-id'], $_POST['product'], $_POST['barcode'], $_POST['particulars'], $_POST['expiry-date'], $_POST['unit-price'], $_POST['selling-price'], $_POST['quantity'], $_POST['amount']);
        echo "done";
    }

    public function deleteConsignedProduct()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConsignedProductModel.php";
        $conproduct = new ConsignedProductModel();
        $conproduct->deleteConsignedProduct($_POST['cp-id']);
        echo "done";
        //cp-id=3&product=3&barcode=1234568&particulars=25.00&expiry-date=2023-08-16&unit-price=21.00&selling-price=26.00&quantity=9&amount=189.00
    }

    public function createConsignedDetails()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConsignedDetailsModel.php";
        $condetails = new ConsignedDetailsModel();
        $condetails->createConsignedDetails($_POST['supplier'], $_POST['date-delivered'], $_POST['received-by']);
        echo "done";
    }

    public function updateConsignedDetails()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConsignedProductModel.php";
        $condetails = new ConsignedDetailsModel();
        $condetails->updateConsignedDetails($_POST['cd-id'], $_POST['supplier'], $_POST['date-delivered'], $_POST['received-by']);
        echo "done";
    }

    public function deleteConsignedDetails()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConsignedProductModel.php";
        $conproduct = new ConsignedProductModel();
        $conproduct->deleteConsignedProducts($_POST['cd-id']);
        echo "done";
    }

    public function deleteConsignedProducts()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConsignedDetailsModel.php";
        $condetails = new ConsignedDetailsModel();
        $condetails->deleteConsignedDetails($_POST['cd-id']);
    }
}
