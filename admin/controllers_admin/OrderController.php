<?php
require_once "./models_admin/OrderModel.php";
require_once "./models_admin/BaseModel.php";

class OrderController {
    // Models
    private $OrderModel;
    private $BaseModel;

    public function __construct()
    {
        $this->OrderModel = new OrderModel();
        $this->BaseModel = new BaseModel();
    }

    //Hàm liệt kê danh sách đơn hàng
    public function list()
    {
        $list_orders = $this->OrderModel->select_list_orders_admin();
        require_once "order/list.php";
    }

    //Hàm liệt kê danh sách đơn hàng chưa xác nhận
    public function unconfirmed()
    {
        $list_orders = $this->OrderModel->select_orders_unconfirmed();
        require_once "order/unconfirmed.php";
    }

    //Hàm sửa thông tin đơn hàng
    public function edit()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $order_id = $_GET['id'];
        } else {
        }
        $order_details = $this->OrderModel->getFullOrderInformation($order_id);
        foreach ($order_details as $value) {
            extract($value);
        }
        
        // Trang thái đơn hàng
        $order_status = 'Chưa xác nhận';
        if ($status == 2) {
            $order_status = 'Đã xác nhận';
        } elseif ($status == 3) {
            $order_status = 'Đang giao';
        } elseif ($status == 4) {
            $order_status = 'Giao thành công';
        }
        
        $date_formated = $this->BaseModel->date_format($order_date, '');
        
        // Cập nhật trạng thái
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_status_order"])) {
            $status = $_POST["status"];
            $order_id = $_POST["order_id"];
            $this->OrderModel->update_status_order($status, $order_id);
            header("Location: index.php?quanli=cap-nhat-don-hang&id=$order_id");
        }        
        require_once "order/edit.php";
    }
}
?>