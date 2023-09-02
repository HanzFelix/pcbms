<?php

class ExpiredController
{
    public function getExpiredListBySupplier()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ExpiredDetailsModel.php";
        $edmodel = new ExpiredDetailsModel();

        $result = $edmodel->getExpiredListBySupplier();
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = [
                    $row["company"],
                    $row["expired_total"],
                    '<button class="bg-primary text-white px-3 rounded-full py-1 text-xs" value="' . $row["supp_id"] . '">VIEW</button>',
                ];
            }
        } else {
            $data[] = ['No results found', '', ''];
        }

        $headerLabels = [
            "Company",
            "Expired Product Count",
            "Action"
        ];
        include $_SERVER['DOCUMENT_ROOT'] . "/resources/partials/table.php";
        echo generateTable($data, $headerLabels);
    }

    public function getExpiredProductListFromSupplier()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ExpiredProductModel.php";
        $epmodel = new ExpiredProductModel();

        $result = $epmodel->getExpiredProductListFromSupplier($_GET['id']);
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = [
                    "<input type='checkbox' value='{$row["cp_id"]}' name='cp_check[]'>
                    <input type='text' value='{$row["unsold_quantity"]}' name='ep_quantity[]' hidden>",
                    $row["prod_name"],
                    $row["unsold_quantity"],
                    $row["date_delivered"],
                    $row["expiry_date"],
                ];
            }
        } else {
            $data[] = ['No results found', '', ''];
        }

        $headerLabels = [
            "",
            "Product",
            "Expired Quantity",
            "Date Delivered",
            "Expiry Date"
        ];
        include $_SERVER['DOCUMENT_ROOT'] . "/resources/partials/table.php";
        echo generateTable($data, $headerLabels);
    }

    public function getExpiredDetailsList()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ExpiredDetailsModel.php";
        $expdetails = new ExpiredDetailsModel();

        $result = $expdetails->getExpiredDetailsList();
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = [
                    $row["ed_id"],
                    $row["company"],
                    $row["personnel"],
                    $row["date"],
                    '<button class="bg-primary text-white px-3 rounded-full py-1 text-xs" value="' . $row["ed_id"] . '">VIEW</button>',
                ];
            }
        } else {
            $data[] = ['No results found', "", "", "", ""];
        }

        $headerLabels = ["ID", "Supplier", "Returned by", "Date Returned", "Action"];
        include $_SERVER['DOCUMENT_ROOT'] . "/resources/partials/table.php";
        echo generateTable($data, $headerLabels);
    }

    public function getExpiredProductList()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ExpiredProductModel.php";
        $expproduct = new ExpiredProductModel();

        $result = $expproduct->getExpiredProductList($_GET['id']);
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = [
                    $row["product-name"],
                    $row["quantity"],
                    $row["exp-date"],
                ];
            }
        } else {
            $data[] = ['No results found', "", ""];
        }

        $headerLabels = ["Product Name", "Quantity", "Expiry Date"];
        include $_SERVER['DOCUMENT_ROOT'] . "/resources/partials/table.php";
        echo generateTable($data, $headerLabels);
    }

    public function getExpiredDetails()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ExpiredDetailsModel.php";
        $expdetails = new ExpiredDetailsModel();

        $expired_details = $expdetails->getExpiredDetails($_GET['id']);

        echo json_encode($expired_details);
    }

    public function getExpiredProduct()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ExpiredProductModel.php";
        $expproduct = new ExpiredProductModel();

        $consigned_product = $expproduct->getExpiredProduct($_GET['id']);

        echo json_encode($consigned_product);
    }

    public function createExpiredProduct()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ExpiredProductModel.php";
        $epmodel = new ExpiredProductModel();

        $result = $epmodel->createExpiredProduct($_POST['ed_id'], $_POST["cp_id"], $_POST['unsold_quantity']);
        echo $result;
    }

    public function updateExpiredProduct()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ExpiredProductModel.php";
        $expproduct = new ExpiredProductModel();
        $expproduct->updateExpiredProduct($_POST['ep-id'], $_POST['product'], $_POST['barcode'], $_POST['particulars'], $_POST['expiry-date'], $_POST['unit-price'], $_POST['selling-price'], $_POST['quantity'], $_POST['amount']);
        echo "done";
    }

    public function deleteExpiredProduct()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ExpiredProductModel.php";
        $expproduct = new ExpiredProductModel();
        $expproduct->deleteExpiredProduct($_POST['ep-id']);
        echo "done";
    }

    public function createExpiredDetails()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ExpiredDetailsModel.php";
        $edmodel = new ExpiredDetailsModel();

        $result = $edmodel->createExpiredDetails($_POST['s-id'], $_SESSION["empid"], $_POST['return-date']);
        echo $result;
    }

    public function updateExpiredDetails()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ExpiredProductModel.php";
        $expdetails = new ExpiredDetailsModel();
        $expdetails->updateExpiredDetails($_POST['ed-id'], $_POST['supplier'], $_POST['date-delivered'], $_POST['received-by']);
        echo "done";
    }

    public function deleteExpiredDetails()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ExpiredProductModel.php";
        $expdetails = new ExpiredDetailsModel();
        $expdetails->deleteExpiredDetails($_POST['ed-id']);
        echo "done";
    }
}
