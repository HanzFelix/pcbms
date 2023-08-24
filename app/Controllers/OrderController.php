<?php

class OrderController
{

    public function getOrderDetailsList()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/OrderDetailsModel.php";
        $orddetails = new OrderDetailsModel();

        $result = $orddetails->getOrderDetailsList();
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = [
                    $row["company"],
                    $row["personnel"],
                    $row["date"],
                    $row["status"],
                    '<button class="bg-primary text-white px-3 rounded-full py-1 text-xs" value="' . $row["od_id"] . '">VIEW</button>',
                ];
            }
        } else {
            $data[] = ['No results found'];
        }

        $headerLabels = [
            "Supplier",
            "Ordered by",
            "Order date",
            "Status",
            "Action"
        ];
        include $_SERVER['DOCUMENT_ROOT'] . "/resources/partials/table.php";
        echo generateTable($data, $headerLabels);
    }

    public function getOrderDetails()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/OrderDetailsModel.php";
        $orddetails = new OrderDetailsModel();

        $order_details = $orddetails->getOrderDetails($_GET['id']);
        // Return first result
        echo json_encode($order_details);
    }

    public function getOrderProduct()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/OrderProductModel.php";
        $ordproduct = new OrderProductModel();

        $order_product = $ordproduct->getOrderProduct($_GET['id']);
        // Return first result
        echo json_encode($order_product);
    }

    public function getOrderProductList()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/OrderProductModel.php";
        $ordproduct = new OrderProductModel();

        $result = $ordproduct->getOrderProductList($_GET['id']);
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = [
                    $row["product"],
                    $row["quantity"],
                    '<button class="bg-primary text-white px-3 rounded-full py-1 text-xs" value="' . $row["op-id"] . '">VIEW</button>',
                ];
            }
        } else {
            $data[] = ['No results found', '', ''];
        }

        $headerLabels = [
            "Product",
            "Quantity",
            "Action"
        ];
        include $_SERVER['DOCUMENT_ROOT'] . "/resources/partials/table.php";
        echo generateTable($data, $headerLabels);
    }

    public function createOrderProduct()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/OrderProductModel.php";
        $ordproduct = new OrderProductModel();
        $ordproduct->createOrderProduct($_POST['od-id'], $_POST['product'], $_POST['quantity']);
        echo "done";
    }

    public function updateOrderProduct()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/OrderProductModel.php";
        $ordproduct = new OrderProductModel();
        $ordproduct->updateOrderProduct($_POST['op-id'], $_POST['product'], $_POST['quantity']);
        echo "done";
    }

    public function deleteOrderProduct()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/OrderProductModel.php";
        $ordproduct = new OrderProductModel();
        $ordproduct->deleteOrderProduct($_POST['op-id']);
        echo "done";
    }

    public function createOrderDetails()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/OrderDetailsModel.php";
        $orddetails = new OrderDetailsModel();
        $orddetails->createOrderDetails($_POST['supplier'], $_POST['ordered-by'], $_POST['order-date'], $_POST['status']);
        echo "done";
    }

    public function updateOrderDetails()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/OrderDetailsModel.php";
        $orddetails = new OrderDetailsModel();
        $orddetails->updateOrderDetails($_POST['od-id'], $_POST['supplier'], $_POST['ordered-by'], $_POST['order-date'], $_POST['status']);
        echo "done";
    }

    public function deleteOrderDetails()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/OrderDetailsModel.php";
        $orddetails = new OrderDetailsModel();
        $orddetails->deleteOrderDetails($_POST['od-id']);
        echo "done";
    }

    public function deleteOrderProducts()
    {
        include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/OrderProductModel.php";
        $ordproduct = new OrderProductModel();
        $ordproduct->deleteOrderProducts($_POST['od-id']);
    }
}
