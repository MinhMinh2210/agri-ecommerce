<?php
require_once "./models/UserModel.php";
require_once "./models/BaseModel.php";
class AuthController
{
    private $UserModel;
    private $BaseModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->BaseModel = new BaseModel();
    }

    public function register()
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

        $email_tmp = "";
        $fullname_tmp = "";
        $username_tmp = "";
        $password_tmp = "";
        $phone_tmp = "";
        $address_tmp = "";
        $password_cf_tmp = "";

        $list_users = $this->UserModel->select_users();

        // Kiểm tra nếu form được submit
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {

            // Lấy dữ liệu từ form
            $email = trim($_POST["email_register"]);
            $full_name = trim($_POST["full_name"]);
            $username = trim($_POST["username"]);
            $password = trim($_POST["password"]);
            $password_confirm = trim($_POST["password_confirm"]);
            $phone = trim($_POST["phone"]);
            $address = trim($_POST["address"]);
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

            if (!preg_match('/^(03|05|07|08|09)\d{8}$/', $phone)) {
                $error['phone'] = 'Số điện thoại không đúng định dạng.';
            }

            if ((strlen($address) > 255)) {
                $error['address'] = 'Địa chỉ không được quá 255 ký tự';
            }

            if (empty(array_filter($error))) {
                // Insert dữ liệu user
                $this->UserModel->user_insert($username, $hashed_password, $full_name, $image, $email, $phone, $address);
                $_SESSION['user_register'] = [
                    'username' => $username,
                    'password' => $password
                ];

                header("Location: index.php?url=dang-nhap");
                exit();
            } else {
                $email_tmp = $email;
                $fullname_tmp = $full_name;
                $username_tmp = $username;
                $password_tmp = $password;
                $password_cf_tmp = $password;
                $phone_tmp = $phone;
                $address_tmp = $address;
                $password_cf_tmp = $password_confirm;
            }
        }
        require_once "./views/user/register.php";
    }

    public function login()
    {
        $username_tmp = '';
        $password_tmp = '';
        $error = '';

        if (isset($_SESSION['user_register'])) {
            $username_tmp = $_SESSION['user_register']['username'];
            $password_tmp = $_SESSION['user_register']['password'];
        }


        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signin"])) {
            $username = trim($_POST["username_login"]);
            $password = trim($_POST["password_login"]);

            if (!empty($username) && !empty($password)) {
                $user = $this->UserModel->get_user_by_username($username);


                if ($user && isset($user[0]['password'])) {

                    if ($user[0]['active'] != 1) {
                        $error = 'Tài khoản đã bị khóa';
                    } else {
                        if (password_verify($password, $user[0]['password'])) {
                            // Lưu thông tin đăng nhập vào Sessison
                            $_SESSION['user']['id'] = $user[0]['user_id'];
                            $_SESSION['user']['username'] = $user[0]['username'];
                            $_SESSION['user']['full_name'] = $user[0]['full_name'];
                            $_SESSION['user']['image'] = $user[0]['image'];
                            $_SESSION['user']['email'] = $user[0]['email'];
                            $_SESSION['user']['phone'] = $user[0]['phone'];
                            $_SESSION['user']['address'] = $user[0]['address'];
                            $_SESSION['user']['password'] = $user[0]['password'];

                            // Xóa session lưu trữ tạm
                            if (isset($_SESSION['user_register'])) unset($_SESSION['user_register']);

                            header("Location: index.php");
                        } else {
                            $error = 'Thông tin đăng nhập không chính xác';
                        }
                    }
                } else {
                    $error = 'Thông tin đăng nhập không chính xác';
                    $username_tmp = $username;
                    $password_tmp = $password;
                }
            } else {
                $error = 'Vui lòng nhập đầy đủ thông tin';
            }
        }

        $html_alert = $this->BaseModel->alert_error_success($error, '');
        require_once "./views/user/login.php";
    }
}
