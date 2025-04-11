<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Quản lý</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="public_admin/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="public_admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="public_admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="public_admin/css/style.css" rel="stylesheet">

    <style>
    body {
        font-family: 'Heebo', sans-serif;
    }
    .form-control {
        height: 45px;
        border-radius: 8px;
    }
</style>

</head>

<?php
ob_start();
session_start();
require_once "models_admin/pdo_library.php";
require_once "models_admin/BaseModel.php";
require_once "models_admin/CustomerModel.php";

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (!empty($username) && !empty($password)) {
        $user = $CustomerModel->get_user_admin($username);

        if ($user && isset($user[0]['password'])) {

            if ($user[0]['active'] != 1) {
                $error = 'Tài khoản đã bị khóa';
            } else {
                if (password_verify($password, $user[0]['password'])) {
                    //Lưu thông tin đăng nhập vào Sessison
                    $_SESSION['user_admin']['id'] = $user[0]['user_id'];
                    $_SESSION['user_admin']['username'] = $user[0]['username'];
                    $_SESSION['user_admin']['full_name'] = $user[0]['full_name'];
                    $_SESSION['user_admin']['image'] = $user[0]['image'];
                    $_SESSION['user_admin']['email'] = $user[0]['email'];
                    $_SESSION['user_admin']['phone'] = $user[0]['phone'];
                    $_SESSION['user_admin']['address'] = $user[0]['address'];

                    header("Location: index.php");
                } else {
                    $error = 'Sai tên tài khoản hoặc mật khẩu';
                }
            }
        }
    }
}

$html_alert = $BaseModel->alert_error_success($error, '');

?>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center" style="background-color: #d4edda;">
        <div class="d-flex rounded shadow-lg overflow-hidden"
            style="max-width: 800px; width: 100%; max-height: 500px; background-color: white;">

        <!-- Cột ảnh bên trái -->
        <div class="d-none d-md-block col-md-5 p-0">
            <img src="public_admin/img/nongdan.jpg" alt="Login image" class="img-fluid h-100" style="object-fit: cover;">
        </div>

        <!-- Form đăng nhập bên phải -->
        <div class="col-12 col-md-7 px-5 py-5 d-flex flex-column justify-content-center" >
            <div class="text-center mb-4">
                <img src="public_admin/img/logo.png" alt="Logo" class="mb-2" style="width: 160px; height: auto;">
                <p class="text-muted">Đăng nhập vào tài khoản</p>
            </div>

            <form action="" method="post">
                <?= $html_alert ?>
                <div class="form-group mb-4">
                    <input name="username" type="text" class="form-control" placeholder="Tài khoản" required>
                </div>
                <div class="form-group mb-4">
                    <input name="password" type="password" class="form-control" placeholder="Mật khẩu" required>
                </div>
                <button type="submit" name="login" class="btn btn-dark w-100 mb-3 fw-bold">LOGIN</button>

                <div class="d-flex justify-content-between small mb-3">
                    <a href="#" class="text-muted">Quên mật khẩu?</a>
                </div>
                <p class="text-center small">Nếu chưa có tài khoản? <a href="#" class="text-primary">Đăng ký ở đây</a></p>
                <div class="text-center mt-4 d-flex justify-content-center gap-3">
                    <a href="#" class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color:rgb(88, 163, 90);">
                        <i class="fab fa-facebook-f text-white"></i>
                    </a>
                    <a href="#" class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color:rgb(88, 163, 90);">
                        <i class="fas fa-envelope text-white"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

        <!-- Sign In End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="public_admin/lib/chart/chart.min.js"></script>
    <script src="public_admin/lib/easing/easing.min.js"></script>
    <script src="public_admin/lib/waypoints/waypoints.min.js"></script>
    <script src="public_admin/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="public_admin/lib/tempusdominus/js/moment.min.js"></script>
    <script src="public_admin/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="public_admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="public_admin/js/main.js"></script>
</body>

</html>

<?php
ob_end_flush();
?>