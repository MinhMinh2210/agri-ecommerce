

<?php
ob_start();
session_start();
if (!isset($_SESSION['user_admin'])) {
    header("Location: login.php");
    exit();
}
require_once "models_admin/pdo_library.php";
require_once "models_admin/BaseModel.php";
require_once "models_admin/CategoryModel.php";
require_once "models_admin/ProductModel.php";
require_once "models_admin/CustomerModel.php";
require_once "models_admin/OrderModel.php";
require_once "models_admin/PostModel.php";
require_once "models_admin/CommentModel.php";

require_once "components/head.php";
require_once "components/header.php";



if (!isset($_GET['quanli'])) {
    require_once "home.php";
} else {
    switch ($_GET['quanli']) {
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
        // Danh mục
        case 'danh-sach-danh-muc':

            require_once "category/list.php";
            break;
        case 'them-danh-muc':

            require_once "category/add.php";
            break;
        case 'cap-nhat-danh-muc':

            require_once "category/edit.php";

            break;
        // Đơn hàng    

        case 'danh-sach-don-hang':

            require_once "order/list.php";
            break;
        case 'danh-sach-don-cho':

            require_once "order/unconfirmed.php";
            break;
        case 'cap-nhat-don-hang':

            require_once "order/edit.php";
            break;
        // Bài viết
        // case 'danh-sach-bai-viet':

        //     require_once "bai-viet/list.php";
        //     break;
        // case 'them-bai-viet':

        //     require_once "bai-viet/add.php";
        //     break;
        // case 'cap-nhat-bai-viet':
        //     require_once "bai-viet/edit.php";
        //     break;
        // case 'danh-muc-bai-viet':

        //     require_once "bai-viet/category.php";
        //     break;
        // case 'cap-nhat-danh-muc-bai-viet':

        //     require_once "bai-viet/edit_catgory.php";
        //     break;
        //Tài khoản
        case 'dang-xuat':
            unset($_SESSION['user_admin']);
            header("Location: login.php");
            break;


        // Khách hàng & Tài khoản
        case 'danh-sach-khach-hang':

            require_once "customer/list.php";
            break;
        case 'them-tai-khoan':

            require_once "customer/add.php";
            break;

        // Bình luận  
        case 'binh-luan':
            require_once "comment/list.php";
            break;
        case 'chi-tiet-binh-luan':
            require_once "comment/edit.php";
            break;
        // Thống kê  
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


        default:
            require_once "components/404.php";
            break;
    }
}

require_once "components/footer.php";



ob_end_flush();
?>


