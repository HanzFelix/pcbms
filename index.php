<?php

// Defined routes and their corresponding actions
$routes = [
    'searchSupplier' => 'SupplierController@searchSupplier',
    'getSupplier' => 'SupplierController@getSupplier',
    'getSupplierOptions' => 'SupplierController@getSupplierOptions',
    'createSupplier' => 'SupplierController@createSupplier',
    'updateSupplier' => 'SupplierController@updateSupplier',
    'deleteSupplier' => 'SupplierController@deleteSupplier',

    'searchProduct' => 'ProductController@searchProduct',
    'getProduct' => 'ProductController@getProduct',
    'getProductList' => 'ProductController@getProductList',
    'getProductOptions' => 'ProductController@getProductOptions',
    'createProduct' => 'ProductController@createProduct',
    'updateProduct' => 'ProductController@updateProduct',
    'deleteProduct' => 'ProductController@deleteProduct',

    'searchConsignedDetails' => 'ConsignedProductController@searchConsignedDetails',
    'getConsignedDetails' => 'ConsignedProductController@getConsignedDetails',
    'getConsignedDetailsList' => 'ConsignedProductController@getConsignedDetailsList',
    'createConsignedDetails' => 'ConsignedProductController@createConsignedDetails',
    'updateConsignedDetails' => 'ConsignedProductController@updateConsignedDetails',
    'deleteConsignedDetails' => 'ConsignedProductController@deleteConsignedDetails',

    'getConsignedProductList' => 'ConsignedProductController@getConsignedProductList',
    'getConsignedProduct' => 'ConsignedProductController@getConsignedProduct',
    'updateConsignedProduct' => 'ConsignedProductController@updateConsignedProduct',
    'createConsignedProduct' => 'ConsignedProductController@createConsignedProduct',
    'deleteConsignedProduct' => 'ConsignedProductController@deleteConsignedProduct',
    'deleteConsignedProducts' => 'ConsignedProductController@deleteConsignedProducts',
];

// xhttp handling
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $action = $_GET['action'];
    if (isset($routes[$action])) {
        list($controllerName, $method) = explode('@', $routes[$action]);
        include 'app/Controllers/' . $controllerName . '.php';
        $controller = new $controllerName();
        $controller->$method();
        exit;
    }
}

// form submission handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['submit'] === 'login') {
        include 'app/Controllers/UserController.php';
        $userController = new UserController();
        $userController->login();
        exit;
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
} elseif ($request === '/logout') {
    include 'app/Controllers/UserController.php';
    $userController = new UserController();
    $userController->logout();
    exit;
} else {
    // Handle 404 Not Found or other cases
    http_response_code(404);
    echo 'Page not found.';
}
