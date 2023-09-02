<?php
/*sd_id
date_issued
cust_id
empid

sp_id
sd_id
cp_id
qty_sold
amount_sold*/

class SaleController
{
    public function getSaleDetailsList()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/SaleDetailsModel.php";
        $orddetails = new SaleDetailsModel();

        $result = $orddetails->getSaleDetailsList();
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = [
                    $row["customer"],
                    $row["personnel"],
                    $row["date"],
                    '<button class="bg-primary text-white px-3 rounded-full py-1 text-xs" value="' . $row["sd_id"] . '">VIEW</button>',
                ];
            }
        } else {
            $data[] = ['No results found'];
        }

        $headerLabels = [
            "Customer",
            "Issued by",
            "Date Issued",
            "Action"
        ];
        include $_SERVER['DOCUMENT_ROOT'] . "/resources/partials/table.php";
        echo generateTable($data, $headerLabels);
    }

    public function getSaleProductList()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/SaleProductModel.php";
        $ordproduct = new SaleProductModel();

        $result = $ordproduct->getSaleProductList($_GET['id']);
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = [
                    $row["product"],
                    $row["quantity"],
                    $row["amount"],
                ];
            }
        } else {
            $data[] = ['No results found', '', ''];
        }

        $headerLabels = [
            "Product",
            "Quantity Sold",
            "Amount Sold"
        ];
        include $_SERVER['DOCUMENT_ROOT'] . "/resources/partials/table.php";
        echo generateTable($data, $headerLabels);
    }

    public function getSaleDetails()
    {
    }

    public function getSaleProduct()
    {
    }

    public function createSaleProduct()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/SaleProductModel.php";
        $salproduct = new SaleProductModel();
        $result = $salproduct->createSaleProduct($_POST['sd_id'], $_POST['cp_id'], $_POST['qty_sold'], $_POST["amount_sold"]);
        echo $result;
    }

    public function updateSaleProduct()
    {
    }

    public function deleteSaleProduct()
    {
    }

    public function createSaleDetails()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/SaleDetailsModel.php";
        $saldetails = new SaleDetailsModel();
        $result = $saldetails->createSaleDetails($_POST['date_issued'], $_POST['cust_id'], $_POST['empid']);
        echo $result;
    }

    public function updateSaleDetails()
    {
    }

    public function deleteSaleDetails()
    {
    }
}
