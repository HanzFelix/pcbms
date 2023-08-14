<?php

// xhttp handling
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    // Construct the full path to your PHP file
    $action = $_GET['action'];
    // Load your application's configurations, models, and other components if needed
    if ($action == 'searchSupplier') {
        include 'app/Controllers/SupplierController.php';
        $suppController = new SupplierController();
        $suppController->searchSupplier();
        exit;
        // Perform the necessary action using the constructed path
    } elseif ($action == 'getSupplier') {
        include 'app/Controllers/SupplierController.php';
        $suppController = new SupplierController();
        $suppController->getSupplier();
        exit;
    } elseif ($action == 'createSupplier') {
        include 'app/Controllers/SupplierController.php';
        $suppController = new SupplierController();
        $suppController->getSupplier();
        exit;
    } elseif ($action == 'updateSupplier') {
        include 'app/Controllers/SupplierController.php';
        $suppController = new SupplierController();
        $suppController->updateSupplier();
        exit;
    } elseif ($action == 'deleteSupplier') {
        include 'app/Controllers/SupplierController.php';
        $suppController = new SupplierController();
        $suppController->deleteSupplier();
        exit;
    } elseif ($action == 'searchProduct') {
        include 'app/Controllers/ProductController.php';
        $prodController = new ProductController();
        $prodController->searchProduct();
        exit;
        // Perform the necessary action using the constructed path
    } elseif ($action == 'getProduct') {
        include 'app/Controllers/ProductController.php';
        $prodController = new ProductController();
        $prodController->getProduct();
        exit;
    } elseif ($action == 'getProductList') {
        include 'app/Controllers/ProductController.php';
        $prodController = new ProductController();
        $prodController->getProductList();
        exit;
    } elseif ($action == 'createProduct') {
        include 'app/Controllers/ProductController.php';
        $prodController = new ProductController();
        $prodController->createProduct();
        exit;
    } elseif ($action == 'updateProduct') {
        include 'app/Controllers/ProductController.php';
        $prodController = new ProductController();
        $prodController->updateProduct();
        exit;
    } elseif ($action == 'deleteProduct') {
        include 'app/Controllers/ProductController.php';
        $prodController = new ProductController();
        $prodController->deleteProduct();
        exit;
    } elseif ($action == 'searchConsignedDetails') {
        include 'app/Controllers/ConsignedProductController.php';
        $cpController = new ConsignedProductController();
        $cpController->searchConsignedDetails();
        exit;
    } elseif ($action == 'getConsignedDetails') {
        include 'app/Controllers/ConsignedProductController.php';
        $cpController = new ConsignedProductController();
        $cpController->getConsignedDetails();
        exit;
    } elseif ($action == 'getConsignedDetailsList') {
        include 'app/Controllers/ConsignedProductController.php';
        $cpController = new ConsignedProductController();
        $cpController->getConsignedDetailsList();
        exit;
    } elseif ($action == 'getConsignedProductList') {
        include 'app/Controllers/ConsignedProductController.php';
        $cpController = new ConsignedProductController();
        $cpController->getConsignedProductList();
        exit;
    } elseif ($action == 'getConsignedProduct') {
        include 'app/Controllers/ConsignedProductController.php';
        $cpController = new ConsignedProductController();
        $cpController->getConsignedProduct();
        exit;
    }
}

// form submission handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['submit'] === 'login') {
        include 'app/Controllers/UserController.php';
        $userController = new UserController();
        $userController->login();
        exit; // Prevent further execution of this script
    }
}

// navigation and view handling
$request = $_SERVER['REQUEST_URI'];
if ($request === '/' || $request === '/login') {
    include 'resources/views/login.php';
} elseif ($request === '/manage') {
    include 'resources/views/manage/dashboard.php';
} elseif ($request === '/manage/delivery') {
    include 'resources/views/manage/delivery.php';
} elseif ($request === '/manage/product') {
    include 'resources/views/manage/product.php';
} elseif ($request === '/manage/supplier') {
    include 'resources/views/manage/supplier.php';
} else {
    // Handle 404 Not Found or other cases
    http_response_code(404);
    echo 'Page not found.';
}
