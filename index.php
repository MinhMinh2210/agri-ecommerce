<?php
ob_start();
session_start();


require_once "models/BaseModel.php";
require_once "controllers/HomeController.php";
require_once "controllers/ProductController.php";
require_once "controllers/CartController.php";
require_once "controllers/OrderController.php";
require_once "controllers/AuthController.php";
require_once "models/ProductModel.php";
require_once "models/CategoryModel.php";
require_once "models/UserModel.php";
require_once "models/CommentModel.php";
require_once "models/CartModel.php";
require_once "models/OrderModel.php";
require_once "models/PostModel.php";
define('BASE_URL', '');
define('URL_MOMO', 'http://localhost/WEBNONGSAN/cam-on');
define('URL_ORDER', 'http://localhost/WEBNONGSAN/don-hang');

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
        case 'chitietsanpham':
            $controller = new ProductController();
            $controller->detail();
            break;
        case 'danh-muc-san-pham':
            $controller = new ProductController();
            $controller->getByCategory();
            break;
        case 'lien-he':
            require_once "views/contact.php";
            break;
        case 'cart':
            $controller = new CartController();
            $controller->list();
            break;
        case 'thanh-toan':
            $controller = new OrderController();
            $controller->checkout();
            break;
        case 'thanh-toan-momo':
            require_once "views/checkout/checkout_momo.php";
            break;
        case 'cam-on':
            require_once "views/thanks.php";
            break;
        case 'don-hang':
            $controller = new OrderController();
            $controller->order_history();
            break;
        case 'chi-tiet-don-hang':
            $controller = new OrderController();
            $controller->order_details();
            break;
        // User
        case 'dang-nhap':
            $controller = new AuthController();
            $controller->login();
            break;
        case 'dang-ky':
            $controller = new AuthController();
            $controller->register();
            break;
        case 'dang-xuat':
            unset($_SESSION['user']);
            header("Location: index.php");
            break;
        case 'thong-tin-tai-khoan':
            require_once "views/user/user-infor.php";
            break;
        case 'ho-so':
            require_once "views/user/edit-profile.php";
            break;
        case 'doi-mat-khau':
            require_once "views/user/change-password.php";
            break;
        case 'quen-mat-khau':
            require_once "views/user/forgot-password.php";
            break;
        case 'khoi-phuc-mat-khau':
            require_once "views/user/password-recovery.php";
            break;

        //Bài viết
        case 'bai-viet':
            require_once "views/blog/blogs.php";
            break;
        case 'chi-tiet-bai-viet':
            require_once "views/blog/blog-details.php";
            break;
        case 'danh-muc-bai-viet':
            require_once "views/blog/blog-by-category.php";
            break;
        //Bài viết
        case 'tim-kiem':
            $controller = new ProductController();
            $controller->search();
            break;

        default:
            require_once "views/not-page.php";
            break;
    }
}

require_once "components/footer.php";



ob_end_flush();
?>
<br>