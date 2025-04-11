<?php
require_once "./models_admin/CategoryModel.php";
require_once "./models_admin/BaseModel.php";

class CategoryController
{
    // Models
    private $CategoryModel;
    private $BaseModel;

    public function __construct()
    {
        $this->CategoryModel = new CategoryModel();
        $this->BaseModel = new BaseModel();
    }

    //Hàm liệt kê danh sách danh mục sản phẩm
    public function list()
    {
        $list_catgories = $this->CategoryModel->getCategoryProductCount();

        $success = '';
        $error = '';
        if (isset($_GET['xoa']) && isset($_GET['qty_pd'])) {
            $category_id = $_GET['xoa'];
            $quantity_product = $_GET['qty_pd'];

            if ($quantity_product <= 0) {
                $this->CategoryModel->delete_category($category_id);

                setcookie('success_delete', 'Đã xóa thành công 1 danh mục', time() + 5, '/');
                header("Location: categories");
            } else {
                $error = 'Không thể xóa danh mục tồn tại sản phẩm';
            }
        }

        if (isset($_COOKIE['success_delete']) && !empty($_COOKIE['success_delete'])) {
            $success = $_COOKIE['success_delete'];
        }

        $html_alert = $this->BaseModel->alert_error_success($error, $success);
        require_once "category/list.php";
    }

    //Hàm thêm danh mục sản phẩm
    public function add()
    {
        $list_name_cate = $this->CategoryModel->select_name_categories();

        $success = '';
        $error = array(
            'name' => '',
            'image' => '',
        );

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_category"])) {
            $name = trim($_POST["name"]);
            $status = $_POST["status"];
            $image = $_FILES["image"]['name'];

            //Kiểm tra tên danh mục đã tồn tại chưa
            foreach ($list_name_cate as $value) {
                if ($value['name'] == $name) {
                    $error['name'] .= 'Tên danh mục đã tồn tại.<br>';
                    break;
                }
            }

            if (empty($name)) {
                $error['name'] .= 'Vui lòng nhập tên danh mục';
            }

            if (strlen($name) > 255) {
                $error['name'] .= 'Tên danh mục tối đa 255 ký tự';
            }

            if (empty($image)) {
                $image = "default-product.jpg";
            }

            if (!empty($image)) {
                $img_valid = $this->BaseModel->is_image_valid($image);
                if (!$img_valid) {
                    $error['image'] = 'File ảnh không hợp lệ chỉ được tải ảnh định dạng JPG, PNG';
                }
            }


            if (empty(array_filter($error))) {
                $target_dir = "../upload/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);

                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                }

                try {
                    $result = $this->CategoryModel->insert_categories($name, $image, $status);
                    $success = 'Thêm danh mục thành công';
                } catch (Exception $e) {
                    $error_message = $e->getMessage();
                    echo 'Thêm danh mục thất bại: ' . $error_message;
                }
            }
        }

        $html_alert = $this->BaseModel->alert_error_success($error['image'], $success);
        require_once "category/add.php";
    }

    //Hàm sửa danh mục sản phẩm
    public function edit()
    {
        $success = '';
        $error = array(
            'name' => '',
            'image' => '',
        );

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $category_id = $_GET['id'];

            $category_one = $this->CategoryModel->select_category_by_id($category_id);
            extract($category_one);
        } else {
            header("Location: categories");
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_category"])) {
            $name = trim($_POST["name"]);
            $status = $_POST["status"];
            $image = $_FILES["image"]['name'];

            if (strlen($name) > 255) {
                $error['name'] = 'Tên danh mục tối đa 255 ký tự';
            }

            // Kiểm tra hình ảnh
            if (!empty($image)) {
                $img_valid = $this->BaseModel->is_image_valid($image);
                if (!$img_valid) {
                    $error['image'] = 'File ảnh không hợp lệ';
                }
            }

            if (empty(array_filter($error))) {
                $target_dir = "../upload/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);

                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                }

                try {
                    $result = $this->CategoryModel->update_category($name, $image, $status, $category_id);
                    setcookie('success_update', 'Cập nhật danh mục thành công', time() + 5, '/');
                    header("Location: update-category&id=" . $category_id);
                } catch (Exception $e) {
                    $error_message = $e->getMessage();
                    echo 'Cập nhật sản phẩm thất bại: ' . $error_message;
                    setcookie('success_update', 'Cập nhật danh mục thất bại', time() + 5, '/');
                }
            }
        }

        if (isset($_COOKIE['success_update']) && !empty($_COOKIE['success_update'])) {
            $success = $_COOKIE['success_update'];
        }

        $html_alert = $this->BaseModel->alert_error_success($error['image'], $success);
        require_once "category/edit.php";
    }
}
