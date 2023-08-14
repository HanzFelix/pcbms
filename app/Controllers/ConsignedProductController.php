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
                        <button class="bg-primary text-white px-3 rounded-full py-1 text-xs" value="' . $row["item-id"] . '">EDIT</button>
                    </td>
                </tr>';
                $i++;
            }
        } else {
            echo '<tr class="bg-accent bg-opacity-10"><td class="px-4 py-2" colspan="7">No results found</td></tr>';
        }
    }
}
