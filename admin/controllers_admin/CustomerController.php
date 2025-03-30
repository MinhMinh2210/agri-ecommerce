<?php 
require_once "./models_admin/CustomerModel.php";
require_once "./models_admin/BaseModel.php";

class CustomerController {
    // Models
    private $CustomerModel;
    private $BaseModel;

    public function __construct()
    {
        $this->CustomerModel = new CustomerModel();
        $this->BaseModel = new BaseModel();
    }

    //Hàm liệt kê danh sách thành viên
    public function list()
    {
        $list_users = $this->CustomerModel->select_all_users();
        require_once "customer/list.php";
    }

    //Hàm thêm thông tin thành viên
    public function add()
    {
        $error = array(
            'email' => '',
            'fullname' => '',
            'username' => '',
            'password' => '',
            'password_confirm' => '',
            'phone' => '',
            'address' => '',
        );
        
        $temp = array(
            'email' => '',
            'full_name' => '',
            'username' => '',
            'password' => '',
            'password_confirm' => '',
            'phone' => '',
            'address' => '',
        );
        $success = '';
        
        $list_users = $this->CustomerModel->select_users();
        
        // Kiểm tra nếu form được submit
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_user"])) {
        
            // Lấy dữ liệu từ form
            $email = trim($_POST["email"]);
            $full_name = trim($_POST["full_name"]);
            $username = trim($_POST["username"]);
            $password = trim($_POST["password"]);
            $password_confirm = trim($_POST["password_confirm"]);
            $phone = trim($_POST["phone"]);
            $address = trim($_POST["address"]);
            $role = $_POST["role"];
            $image = "user-default.png";
        
            //MÃ hóa password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
            foreach ($list_users as $user) {
                if ($user['email'] == $email) {
                    $error['email'] = 'Email đã được đăng ký.';
                    break;
                }
            }
        
            if ((strlen($email) > 255)) {
                $error['email'] = 'Email không được quá 255 ký tự';
            }
        
            if ((strlen($full_name) > 255)) {
                $error['fullname'] = 'Họ tên không được quá 255 ký tự';
            }
        
            foreach ($list_users as $user) {
                if ($user['username'] == $username) {
                    $error['username'] = 'Tên đăng nhập đã tồn tại.';
                    break;
                }
            }
        
            foreach ($list_users as $user) {
                if ($user['phone'] == $phone) {
                    $error['phone'] = 'Số điện thoại đã được đăng ký.';
                    break;
                }
            }
        
            if ($password != $password_confirm) {
                $error['password_confirm'] = 'Nhập lại mật khẩu không trùng khớp';
            }
        
            if (strlen($password) < 8) {
                $error['password'] = 'Mật khẩu phải chứa ít nhất 8 ký tự.';
            }
        
            if (!preg_match('/^(03|05|07|08|09)(([0-9]){8})/', $phone)) {
                $error['phone'] = 'Số điện thoại không đúng định dạng.';
            }
        
            if ((strlen($address) > 255)) {
                $error['address'] = 'Địa chỉ không được quá 255 ký tự';
            }
        
            if (empty(array_filter($error))) {
                //Insert dữ liệu user
                $this->CustomerModel->user_insert($username, $hashed_password, $full_name, $image, $email, $phone, $address, $role);
                $success = 'Thêm tải khoản thành công';
            } else {
                $temp['email'] = $email;
                $temp['full_name'] = $full_name;
                $temp['username'] = $username;
                $temp['password'] = $password;
                $temp['password'] = $password;
                $temp['phone'] = $phone;
                $temp['address'] = $address;
                $temp['password_confirm'] = $password_confirm;
            }
        }
        $html_alert = $this->BaseModel->alert_error_success('', $success);
        require_once "customer/add.php";
    }
}
?>