<?php
require_once "models/BaseModel.php";
require_once "models/OrderModel.php";
require_once "models/CartModel.php";
class OrderController
{
    private $CartModel;
    private $BaseModel;
    private $OrderModel;

    public function __construct()
    {
        $this->CartModel = new CartModel();
        $this->BaseModel = new BaseModel();
        $this->OrderModel = new OrderModel();
    }

    public function checkout()
    {
        $success = '';
        $error = '';
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["checkout"])) {
                // Table orders
                $user_id = $_POST["user_id"];
                $total = $_POST["total_checkout"];
                $address = $_POST["address"];
                $phone = $_POST["phone"];
                $note = $_POST["note"];

                // Table orderdetails
                $arr_product_id = $_POST["product_id"];
                $arr_quantity = $_POST["quantity"];
                $arr_price = $_POST["price"];

                // Bước 1: Insert dữ liệu vào orders
                $this->OrderModel->insert_orders($user_id, $total, $address, $phone, $note);
                // Bước 2: Lấy order_id mới tạo để thểm vào 
                $result_select = $this->OrderModel->select_order_id();
                $order_id = $result_select['order_id'];

                if (!empty($order_id)) {
                    // Insert orderdetails
                    for ($i = 0; $i < count($arr_product_id); $i++) {
                        $product_id = $arr_product_id[$i];
                        $quantity = $arr_quantity[$i];
                        $price = $arr_price[$i];

                        $this->OrderModel->insert_orderdetails($order_id, $product_id, $quantity, $price);
                    }
                    // Sau khi đặt hàng xóa giỏ hàng
                    $this->OrderModel->delete_cart_by_user_id($user_id);
                    header("Location: ordersuccess");
                }
            }
            require_once "views/checkout.php";
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            echo $error_message;
        }
    }

    public function order_history()
    {
        require_once "views/my-order.php";
    }

    public function order_details()
    {
        require_once "views/my-orderdetails.php";
    }
}
