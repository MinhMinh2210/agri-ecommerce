<?php
require_once "./models_admin/ProductModel.php";
require_once "./models_admin/CategoryModel.php";
require_once "./models_admin/BaseModel.php";
class ProductController
{
    private $ProductModel;
    private $CategoryModel;
    private $BaseModel;

    public function __construct()
    {
        $this->ProductModel = new ProductModel();
        $this->CategoryModel = new CategoryModel();
        $this->BaseModel = new BaseModel();
    }

    //Hàm hiển thị danh sách sản phẩm
    public function list()
    {

        if (isset($_POST['search'])) {
            $keyword = $_POST['keyword'];
            $cate_id = $_POST['search_cate'];
        } else {
            $keyword = '';
            $cate_id = 0;
        }

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        $list_categories = $this->CategoryModel->select_all_categories();
        $list_products = $this->ProductModel->select_list_products($keyword, $cate_id, $page, 5);
        $count_recycle = $this->ProductModel->select_recycle_products();

        // Phân trang
        $all_products = $this->ProductModel->select_products();
        $totalProducts = count($all_products); // Tổng số sản phẩm
        $productsPerPage = 5; // sản phẩm trên 1 trang

        // Tính số trang
        $totalProducts = intval($totalProducts);
        $productsPerPage = intval($productsPerPage);
        $numberOfPages = ceil($totalProducts / $productsPerPage);

        $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

        $html_pagination = '';
        $pagination_next = '';
        $pagination_prev = '';
        for ($i = 1; $i <= $numberOfPages; $i++) {
            if ($i === $currentPage) {
                $active = 'active';
            } else {
                $active = '';
            }

            $html_pagination .= '
                <li class="page-item ' . $active . '">
                    <a class="page-link" href="products&page=' . $i . '">' . $i . '</a>
                </li>
            ';

            //  Next
            if ($currentPage < $numberOfPages) {
                $pagination_next = '
                    <li class="page-item">
                        <a class="page-link text-success" href="products&page=' . ($currentPage + 1) . '">
                             <i class="fa fa-angle-right text-success"></i>
                        </a>
                    </li>
                ';
            }

            //  Prev
            if ($currentPage > 1) {
                $pagination_prev = '
                <li class="page-item">
                    <a class="page-link text-success" href="products&page=' . ($currentPage - 1) . '">
                        <i class="fa fa-angle-left text-success"></i> 
                    </a>
                </li>
                ';
            }
        }
        require_once "product/list.php";
    }

    //Hàm add sản phẩm
    public function add()
    {
        $list_categories = $this->CategoryModel->select_all_categories();
        $list_products = $this->ProductModel->select_products();

        $error = array(
            'name' => '',
            'image' => '',
            'quantity' => '',
            'price' => '',
            'sale_price' => '',
        );

        $temp = array(
            'name' => '',
            'image' => '',
            'quantity' => '',
            'price' => '',
            'sale_price' => '',
            'details' => '',
            'short_description' => '',
        );

        $success = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["themsanpham"])) {
            $name = trim($_POST["name"]);
            $category_id = $_POST["category_id"];
            $image = $_FILES["image"]['name'];

            $quantity = $_POST["quantity"];
            $price = $_POST["price"];
            $sale_price = $_POST["sale_price"];
            $details = isset($_POST["details"]) ? $_POST["details"] : '';
            $short_description = isset($_POST["short_description"]) ? $_POST["short_description"] : '';

            // Kiểm tra tên sản phẩm đã tồn tại chưa
            foreach ($list_products as $value) {
                if ($value['name'] == $name) {
                    $error['name'] = 'Tên sản phẩm đã tồn tại.<br>';
                    break;
                }
            }

            if (empty($name)) {
                $error['name'] = 'Tên sản phẩm không được để trống';
            }

            if (strlen($name) > 255) {
                $error['name'] = 'Tên sản phẩm tối đa 255 ký tự';
            }

            if ($price < 0) {
                $error['price'] = 'Giá bán thường phải lớn hơn 0';
            }
            if ($quantity < 0) {
                $error['quantity'] = 'Số lượng phải lớn hơn 0';
            }
            if ($sale_price < 0) {
                $error['sale_price'] = 'Giá tiền khuyến mãi phải lớn hơn 0';
            }
            if ($sale_price > $price) {
                $error['sale_price'] = 'Giá khuyến mãi không được lớn hơn giá bán thường';
            }

            if (empty($image)) {
                $image = "default-product.jpg";
            }

            if (empty(array_filter($error))) {
                $target_dir = "../upload/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);

                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                }

                try {
                    $result = $this->ProductModel->insert_product($category_id, $name, $image, $quantity, $price, $sale_price, $details, $short_description);
                    $success = 'Thêm sản phẩm thành công';
                } catch (Exception $e) {
                    $error_message = $e->getMessage();
                    echo 'Thêm sản phẩm thất bại: ' . $error_message;

                    $success = 'Thêm sản phẩm thất bại';
                }
            } else {
                $temp['name'] = $name;
                $temp['price'] = $price;
                $temp['sale_price'] = $sale_price;
                $temp['quantity'] = $quantity;
                $temp['short_description'] = $short_description;
                $temp['details'] = $details;
            }
        }

        $html_alert = $this->BaseModel->alert_error_success('', $success);
        require_once "product/add.php";
    }

    //Hàm sửa sản phẩm
    public function edit()
    {
        $error = array(
            'name' => '',
            'image' => '',
            'quantity' => '',
            'price' => '',
            'sale_price' => '',
        );

        $list_categories = $this->CategoryModel->select_all_categories();
        $list_products = $this->ProductModel->select_products();

        if (isset($_GET['id'])) {
            $product_id = $_GET['id'];

            // Fetch product data
            $product = $this->ProductModel->select_product_by_id($product_id);
            extract($product);
        } else {
            header("Location: products");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_product"])) {
            $name = trim($_POST["name"]);
            $category_id = $_POST["category_id"];
            $image = $_FILES["image"]['name'];

            $quantity = $_POST["quantity"];
            $price = $_POST["price"];
            $sale_price = $_POST["sale_price"];
            $details = isset($_POST["details"]) ? $_POST["details"] : '';
            $short_description = isset($_POST["short_description"]) ? $_POST["short_description"] : '';

            // Validate form fields
            if (strlen($name) > 255) {
                $error['name'] = 'Tên sản phẩm tối đa 255 ký tự';
            }

            if ($price < 0) {
                $error['price'] = 'Giá bán thường phải lớn hơn 0';
            }
            if ($quantity < 0) {
                $error['quantity'] = 'Số lượng phải lớn hơn 0';
            }
            if ($sale_price < 0) {
                $error['sale_price'] = 'Giá tiền khuyến mãi phải lớn hơn 0';
            }
            if ($sale_price > $price) {
                $error['sale_price'] = 'Giá khuyến mãi không được lớn hơn giá bán thường';
            }

            // If no errors, update product
            if (empty(array_filter($error))) {
                // Handle image upload
                if (!empty($image)) {
                    $target_dir = "../upload/";
                    $target_file = $target_dir . basename($_FILES["image"]["name"]);
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        // Image uploaded successfully
                    }
                } else {
                    // Use the existing image if no new image is uploaded
                    $image = $product['image'];
                }

                try {
                    // Update product in the database
                    $result = $this->ProductModel->update_product($category_id, $name, $image, $quantity, $price, $sale_price, $details, $short_description, $product_id);
                    setcookie('success_update', 'Cập nhật sản phẩm thành công', time() + 5, '/');
                    header("Location: update-product&id=" . $product_id);
                    exit;
                } catch (Exception $e) {
                    $error_message = $e->getMessage();
                    echo 'Cập nhật sản phẩm thất bại: ' . $error_message;
                }
            }
        }

        $success = '';
        if (isset($_COOKIE['success_update']) && !empty($_COOKIE['success_update'])) {
            $success = $_COOKIE['success_update'];
        }

        $html_alert = $this->BaseModel->alert_error_success('', $success);
        require_once "product/edit.php";
    }

    //Hàm xóa sản phẩm
    public function delete()
    {
        $success = '';
        if (isset($_GET['xoatam']) && $_GET['xoatam'] > 0) {
            $product_id = $_GET['xoatam'];

            $this->ProductModel->update_product_not_active($product_id);
            $success = '1 sản phẩm đã thêm vào thùng rác';
        }

        if (isset($_GET['khoiphuc'])) {
            $product_id = $_GET['khoiphuc'];

            $this->ProductModel->update_product_active($product_id);
            $success = '1 sản phẩm đã được khôi phục';
        }

        // Xóa vĩnh viễn
        if (isset($_GET['xoa'])) {
            $product_id = $_GET['xoa'];
            $this->ProductModel->delete_product($product_id);
            $success = 'Đã xóa thành công 1 sản phẩm';
        }

        $list_products = $this->ProductModel->select_recycle_products();

        $html_alert = $this->BaseModel->alert_error_success('', $success);
        require_once "product/delete.php";
    }
}
