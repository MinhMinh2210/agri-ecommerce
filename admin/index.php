<?php
ob_start();
session_start();

// Redirect to login if the user is not logged in
if (!isset($_SESSION['user_admin'])) {
    header("Location: login.php");
    exit();
}

// Including necessary files
require_once "controllers_admin/ProductController.php";
require_once "controllers_admin/OrderController.php";
require_once "controllers_admin/CategoryController.php";
require_once "controllers_admin/CustomerController.php";
require_once "models_admin/BaseModel.php";
require_once "models_admin/CategoryModel.php";
require_once "models_admin/ProductModel.php";
require_once "models_admin/CustomerModel.php";
require_once "models_admin/OrderModel.php";

// Include header components
require_once "components/head.php";
require_once "components/header.php";

// Default home page if no query parameter is set
if (!isset($_GET['url'])) {
    require_once "home.php";
} else {
    switch ($_GET['url']) {
        // Product management
        case 'products':
            $controller = new ProductController();
            $controller->list();
            break;
        case 'add-product':
            $controller = new ProductController();
            $controller->add();
            break;
        case 'update-product':
            $controller = new ProductController();
            $controller->edit();
            break;
        case 'recycle-product':
            $controller = new ProductController();
            $controller->delete();
            break;

        // Category
        case 'categories':
            $controller = new CategoryController();
            $controller->list();
            break;
        case 'add-category':
            $controller = new CategoryController();
            $controller->add();
            break;
        case 'update-category':
            $controller = new CategoryController();
            $controller->edit();
            break;

        // Order management
        case 'orders':
            $controller = new OrderController();
            $controller->list();
            break;
        case 'waiting-orders':
            $controller = new OrderController();
            $controller->unconfirmed();
            break;
        case 'update-order':
            $controller = new OrderController();
            $controller->edit();
            break;

        // Customer and account management
        case 'log-out':
            unset($_SESSION['user_admin']);
            header("Location: login.php");
            break;
        case 'users':
            $controller = new CustomerController();
            $controller->list();
            break;
        case 'add-user':
            $controller = new CustomerController();
            $controller->add();
            break;

        // Statistics and reporting
        case 'statistic-product':
            require_once "statistic/products.php";
            break;
        case 'statistic-order':
            require_once "statistic/orders.php";
            break;
        case 'chart-order':
            require_once "statistic/chart-order.php";
            break;
        case 'top-orders':
            require_once "statistic/top-orders.php";
            break;
        case 'chart-order-date':
            require_once "statistic/chart-order-date.php";
            break;
        case 'export_excel':
            require_once "export_exel/export_orders.php";
            break;

        // 404 error page
        default:
            require_once "components/404.php";
            break;
    }
}

// Include footer component
require_once "components/footer.php";

ob_end_flush();
