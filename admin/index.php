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
        case 'danh-sach-san-pham':
            $controller = new ProductController();
            $controller->list();
            break;
        case 'them-san-pham':
            $controller = new ProductController();
            $controller->add();
            break;
        case 'cap-nhat-san-pham':
            $controller = new ProductController();
            $controller->edit();
            break;
        case 'thung-rac-san-pham':
            $controller = new ProductController();
            $controller->delete();
            break;

        // Category management
        case 'danh-sach-danh-muc':
            $controller = new CategoryController();
            $controller->list();
            break;
        case 'them-danh-muc':
            $controller = new CategoryController();
            $controller->add();
            break;
        case 'cap-nhat-danh-muc':
            $controller = new CategoryController();
            $controller->edit();
            break;

        // Order management
        case 'danh-sach-order':
            $controller = new OrderController();
            $controller->list();
            break;
        case 'danh-sach-don-cho':
            $controller = new OrderController();
            $controller->unconfirmed();
            break;
        case 'cap-nhat-order':
            $controller = new OrderController();
            $controller->edit();
            break;

        // Customer and account management
        case 'log-out':
            unset($_SESSION['user_admin']);
            header("Location: login.php");
            break;
        case 'danh-sach-khach-hang':
            $controller = new CustomerController();
            $controller->list();
            break;
        case 'them-tai-khoan':
            $controller = new CustomerController();
            $controller->add();
            break;

        // Statistics and reporting
        case 'thong-ke-san-pham':
            require_once "statistic/products.php";
            break;
        case 'thong-ke-order':
            require_once "statistic/orders.php";
            break;
        case 'bieu-do-luot-ban':
            require_once "statistic/chart-order.php";
            break;
        case 'top-luot-ban':
            require_once "statistic/top-orders.php";
            break;
        case 'luot-ban-theo-ngay':
            require_once "statistic/chart-order-date.php";
            break;
        case 'xuat-exel':
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
