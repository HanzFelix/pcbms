<?php
include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ProductModel.php";

class ProductController
{
    public function getProductList()
    {
        $prodmodel = new ProductModel();

        $result = $prodmodel->getProductList();
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = [
                    $row["prod_name"],
                    $row["total_quantity"] . ' / ' . $row["max_quantity"],
                    $row["unit"],
                    $row["appreciation"],
                    $row["shelf_life"],
                    '<button class="bg-primary text-white px-3 rounded-full py-1 text-xs" value="' . $row["prod_id"] . '">EDIT</button>',
                ];
            }
        } else {
            $data[] = ['No results found', "", "", "", "", "", ""];
        }

        $headerLabels = [
            "Product Name",
            "Quantity",
            "Unit",
            "Appreciation",
            "Shelf life (days)",
            "Action"
        ];
        include $_SERVER['DOCUMENT_ROOT'] . "/resources/partials/table.php";
        echo generateTable($data, $headerLabels);
    }

    public function getProductOptions()
    {
        $prodmodel = new ProductModel();

        $products = $prodmodel->getProductList();
        while ($row = mysqli_fetch_assoc($products)) {
            echo '<option value=' . $row["prod_id"] . '>' . $row["prod_name"] . ' (' . $row["unit"] . ') </option>';
        }
    }

    public function getProduct()
    {
        $prodmodel = new ProductModel();

        $product = $prodmodel->getProduct($_GET['id']);
        // Return first result
        echo json_encode($product);
    }

    public function searchProduct()
    {
        $prodmodel = new ProductModel();
        $result = $prodmodel->searchProduct($_GET['q']);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<button value="' . $row['prod_id'] . '" id="button-product" class="text-left truncate">' . $row['prod_name'] . '</button>';
            }
        } else {
            echo 'No results found';
        }
    }

    public function createProduct()
    {
        $prodmodel = new ProductModel();

        // Retrieve the submitted form data
        $name = $_POST['product-name'];
        $shelf_life = $_POST['shelf-life'];
        $unit = $_POST['unit'];
        $appreciation = $_POST['appreciation'];
        $max_quantity = $_POST['max-quantity'];

        $prodmodel->createProduct($name, $shelf_life, $unit, $appreciation, $max_quantity);
    }

    public function updateProduct()
    {
        $prodmodel = new ProductModel();

        // Retrieve the submitted form data
        $prod_id = $_POST['id'];
        $name = $_POST['product-name'];
        $shelf_life = $_POST['shelf-life'];
        $unit = $_POST['unit'];
        $appreciation = $_POST['appreciation'];
        $max_quantity = $_POST['max-quantity'];

        $test = $prodmodel->updateProduct($prod_id, $name, $shelf_life, $unit, $appreciation, $max_quantity);
        echo $test;
    }

    public function deleteProduct()
    {
        $prodmodel = new ProductModel();

        $prodmodel->deleteProduct($_POST['id']);
    }
}
