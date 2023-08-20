<?php

class ConsignedProductController
{
    public function searchConsignedDetails()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConsignedDetailsModel.php";
        $condetails = new ConsignedDetailsModel();

        $result = $condetails->getConsignedDetailsList($_GET['search-input']);
        // Build the HTML dropdown with the search results
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<button value="' . $row['cd_id'] . '" id="button-consigned_det" class="text-left truncate">' . $row['date'] . ' - ' . $row['company'] . '</button>';
            }
        } else {
            echo 'No results found';
        }
    }

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

    public function getConsignedDetailsList()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConsignedDetailsModel.php";
        $condetails = new ConsignedDetailsModel();

        $result = $condetails->getConsignedDetailsListNew();
        if (mysqli_num_rows($result) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr class="bg-accent ' . ($i % 2 == 0 ? 'bg-opacity-10' : 'bg-opacity-25') . '">
                <td class="px-4 py-2">' . $row["cd_id"] . ' </td>
                    <td class="px-4 py-2">' . $row["company"] . ' </td>
                    <td class="px-4 py-2">' . $row["username"] . '</td>
                    <td class="px-4 py-2">' . $row["date"] . '</td>
                    <td class="px-4 py-2">
                        <button class="bg-primary text-white px-3 rounded-full py-1 text-xs" value="' . $row["cd_id"] . '">VIEW</button>
                    </td>
                </tr>';
                $i++;
            }
        } else {
            echo '<tr class="bg-accent bg-opacity-10"><td class="px-4 py-2">No results found</td></tr>';
        }
    }

    public function getConsignedProductList()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConsignedProductModel.php";
        $conproduct = new ConsignedProductModel();

        $result = $conproduct->getConsignedProductList($_GET['id']);
        // Build the HTML dropdown with the search results
        if (mysqli_num_rows($result) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr class="bg-accent ' . ($i % 2 == 0 ? 'bg-opacity-10' : 'bg-opacity-25') . '">
                    <td class="px-4 py-2">' . $row["product-name"] . ' (x' . $row["quantity"] . ') </td>
                    <td class="px-4 py-2">' . $row["barcode"] . '</td>
                    <td class="px-4 py-2">' . $row["particulars"] . '</td>
                    <td class="px-4 py-2">' . $row["exp-date"] . '</td>
                    <td class="px-4 py-2">Php ' . $row["unit-price"] . '</td>
                    <td class="px-4 py-2">Php ' . $row["selling-price"] . '</td>
                    <td class="px-4 py-2">
                        <button class="bg-primary text-white px-3 rounded-full py-1 text-xs" value="' . $row["cp-id"] . '">EDIT</button>
                    </td>
                </tr>';
                $i++;
            }
        } else {
            echo '<tr class="bg-accent bg-opacity-10"><td class="px-4 py-2" colspan="7">No results found</td></tr>';
        }
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
