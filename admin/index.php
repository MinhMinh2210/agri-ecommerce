<?php
ob_start();
session_start();

// Redirect to login if the user is not logged in
if (!isset($_SESSION['user_admin'])) {
    header("Location: login.php");
    exit();
}

// Including necessary files
require_once "models_admin/pdo_library.php";
require_once "models_admin/BaseModel.php";
require_once "models_admin/CategoryModel.php";
require_once "models_admin/ProductModel.php";
require_once "models_admin/CustomerModel.php";
require_once "models_admin/OrderModel.php";
require_once "models_admin/PostModel.php";
require_once "models_admin/CommentModel.php";

// Include header components
require_once "components/head.php";
require_once "components/header.php";

// Default home page if no query parameter is set
if (!isset($_GET['quanli'])) {
    require_once "home.php";
} else {
    switch ($_GET['quanli']) {
        // Product management
        case 'danh-sach-san-pham':
            require_once "product/list.php";
            break;
        case 'them-san-pham':
            require_once "product/add.php";
            break;
        case 'cap-nhat-san-pham':
            require_once "product/edit.php";
            break;
        case 'thung-rac-san-pham':
            require_once "product/recycle-bin.php";
            break;

        // Category management
        case 'danh-sach-danh-muc':
            require_once "category/list.php";
            break;
        case 'them-danh-muc':
            require_once "category/add.php";
            break;
        case 'cap-nhat-danh-muc':
            require_once "category/edit.php";
            break;

        // Order management
        case 'danh-sach-don-hang':
            require_once "order/list.php";
            break;
        case 'danh-sach-don-cho':
            require_once "order/unconfirmed.php";
            break;
        case 'cap-nhat-don-hang':
            require_once "order/edit.php";
            break;

        // Customer and account management
        case 'dang-xuat':
            unset($_SESSION['user_admin']);
            header("Location: login.php");
            break;
        case 'danh-sach-khach-hang':
            require_once "customer/list.php";
            break;
        case 'them-tai-khoan':
            require_once "customer/add.php";
            break;

        // Comment management
        case 'binh-luan':
            require_once "comment/list.php";
            break;
        case 'chi-tiet-binh-luan':
            require_once "comment/edit.php";
            break;

        // Statistics and reporting
        case 'thong-ke-san-pham':
            require_once "statistic/products.php";
            break;
        case 'thong-ke-don-hang':
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
