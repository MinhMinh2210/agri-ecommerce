<?php
require_once "models/CartModel.php";
require_once "models/ProductModel.php";
require_once "models/CategoryModel.php";
require_once "models/BaseModel.php";

class CartController
{
    private $CartModel;
    private $BaseModel;
    private $ProductModel;
    private $CategoryModel;

    public function __construct()
    {
        $this->ProductModel = new ProductModel();
        $this->CartModel = new CartModel();
        $this->BaseModel = new BaseModel();
        $this->CategoryModel = new CategoryModel();
    }

    public function list()
    {
        $success = '';
        $error = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_to_cart"])) {
            $this->addToCart();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_cart"]) && isset($_SESSION['user'])) {
            $this->updateCart();
        }

        if (isset($_GET['xoa'])) {
            $this->deleteCartItem();
        }

        // Lấy danh sách giỏ hàng
        $list_carts = [];
        $count_carts = 0;
        if (isset($_SESSION['user'])) {
            $cartData = $this->getCartList();
            $list_carts = $cartData['list_carts'];
            $count_carts = $cartData['count_carts'];
        }

        // Lấy danh sách danh mục
        $categories = $this->CategoryModel->select_name_categories();  

        require_once "views/cart.php";
    }

    private function addToCart()
    {
        $product_id = $_POST["product_id"];
        $user_id = $_POST["user_id"];
        $product_name = $_POST["name"];
        $product_price = $_POST["price"];
        $product_quantity = $_POST["product_quantity"];
        $product_image = $_POST["image"];

        // Kiểm tra sản phẩm trong giỏ hàng
        $product = $this->CartModel->select_cart_by_id($product_id, $user_id);
        if ($product && is_array($product)) {
            $current_quantity = $product['product_quantity'];
            $new_quantity = $current_quantity + $product_quantity;
            $this->CartModel->update_cart($new_quantity, $product_id, $user_id);
            $_SESSION['success'] = 'Đã cập nhật số lượng cho sản phẩm: ' . $product_name;
        } else {
            $this->CartModel->insert_cart($product_id, $user_id, $product_name, $product_price, $product_quantity, $product_image);
            $_SESSION['success'] = "Đã thêm sản phẩm vào giỏ hàng";
        }
        header("Location: cart");
        exit();
    }

    private function updateCart()
    {
        $user_id = $_SESSION['user']['id'];
        $product_id = $_POST["product_id"];
        $new_quantity = $_POST["quantity"];
        $index = 0;

        for ($i = 0; $i < count($product_id); $i++) {
            $id = $product_id[$i];
            $quantity = $new_quantity[$i];

            if ($quantity <= 0) {
                $this->CartModel->delete_product_in_cart($id, $user_id);
                $index++;
            } else {
                $this->CartModel->update_cart($quantity, $id, $user_id);
            }
        }

        $_SESSION['success'] = ($index > 0) ? 'Đã xóa ' . $index . ' sản phẩm ra khỏi giỏ hàng' : 'Cập nhật thành công';
        header("Location: cart");
        exit();
    }

    private function deleteCartItem()
    {
        $cart_id = $_GET['xoa'];
        $this->CartModel->delete_cart_by_id($cart_id);
        $_SESSION['success'] = 'Đã xóa 1 sản phẩm';
        header("Location: cart");
        exit();
    }

    private function getCartList()
    {
        $user_id = $_SESSION['user']['id'];
        $list_carts = $this->CartModel->select_all_carts($user_id);
        $count_carts = count($this->CartModel->count_cart($user_id));

        return [
            'list_carts' => $list_carts,
            'count_carts' => $count_carts
        ];
    }
}
