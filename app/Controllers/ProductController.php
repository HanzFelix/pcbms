<?php
// search.php
include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ProductModel.php";

class ProductController
{
    public function getProductList()
    {
        $prodmodel = new ProductModel();

        $products = $prodmodel->getProductList();
        if (mysqli_num_rows($products) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($products)) {
                echo '<tr class="bg-accent ' . ($i % 2 == 0 ? 'bg-opacity-10' : 'bg-opacity-25') . '">
                <td class="px-4 py-2">' . $row["prod_name"] . ' </td>
                    <td class="px-4 py-2">' . $row["shelf_life"] . ' </td>
                    <td class="px-4 py-2">' . $row["unit"] . '</td>
                    <td class="px-4 py-2">' . $row["appreciation"] . '</td>
                    <td class="px-4 py-2">' . $row["max_quantity"] . '</td>
                    <td class="px-4 py-2">
                        <button class="bg-primary text-white px-3 rounded-full py-1 text-xs" value="' . $row["prod_id"] . '">EDIT</button>
                    </td>
                </tr>';
                $i++;
            }
        } else {
            echo '<tr class="bg-accent bg-opacity-10"><td class="px-4 py-2">No results found</td></tr>';
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
