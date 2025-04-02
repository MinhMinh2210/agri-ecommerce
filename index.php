<?php
ob_start();
session_start();


require_once "models/BaseModel.php";
require_once "controllers/HomeController.php";
require_once "controllers/ProductController.php";
require_once "controllers/CartController.php";
require_once "controllers/OrderController.php";
require_once "controllers/AuthController.php";
define('BASE_URL', '');
define('URL_MOMO', 'http://localhost/WEBNONGSAN/cam-on');
define('URL_ORDER', 'http://localhost/WEBNONGSAN/order');

require_once "components/head.php";
require_once "components/header.php";


if (!isset($_GET['url'])) {
    $controller = new HomeController();
    $controller->index();
} else {
    switch ($_GET['url']) {
        case 'shop':
            $controller = new ProductController();
            $controller->index();
            break;
        case 'productdetail':
            $controller = new ProductController();
            $controller->detail();
            break;
        case 'category':
            $controller = new ProductController();
            $controller->getByCategory();
            break;
        case 'contact':
            require_once "views/contact.php";
            break;
        case 'cart':
            $controller = new CartController();
            $controller->list();
            break;
        case 'checkout':
            $controller = new OrderController();
            $controller->checkout();
            break;
        case 'checkout-momo':
            require_once "views/checkout/checkout_momo.php";
            break;
        case 'ordersuccess':
            require_once "views/thanks.php";
            break;
        case 'order':
            $controller = new OrderController();
            $controller->order_history();
            break;
        case 'orderdetail':
            $controller = new OrderController();
            $controller->order_details();
            break;
        // User
        case 'login':
            $controller = new AuthController();
            $controller->login();
            break;
        case 'register':
            $controller = new AuthController();
            $controller->register();
            break;
        case 'log-out':
            unset($_SESSION['user']);
            header("Location: index.php");
            break;
        case 'user-infor':
            require_once "views/user/user-infor.php";
            break;
        case 'edit-ptofile':
            require_once "views/user/edit-profile.php";
            break;
        case 'search':
            $controller = new ProductController();
            $controller->search();
            break;

        default:
            require_once "views/not-found.php";
            break;
    }
}

require_once "components/footer.php";



ob_end_flush();
?>
<br>