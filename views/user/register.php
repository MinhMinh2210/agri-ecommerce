<style>
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.3);
        z-index: 1;
    }

    .form-group label {
        margin-bottom: 0.1rem;
        font-weight: 500;
    }

    .social-icon {
        background-color: #28a745;
        color: #fff;
        padding: 4px;
        border-radius: 50%;
        font-size: 14px;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.3s;
    }

    .social-icon:hover {
        background-color: #218838;
        text-decoration: none;
        color: #fff;
    }


    .input-group {
        margin-top: 0.4rem;
    }

    .form-row .form-group {
    margin-bottom: 0.4rem; /* hoặc 0.3rem để khớp với các form-group khác */
}

</style>

<div class="position-relative container-fluid min-vh-100 d-flex align-items-center justify-content-center py-5" style="background-image: url('public/img/nen_login.jpg'); background-size: cover; background-position: center;">
    
    <div class="overlay"></div>

    <div class="row w-90 shadow overflow-hidden position-relative" style="background-color: rgba(255,255,255,0.95); z-index: 2; border-radius: 9px;">
        
        <!-- Form Đăng ký -->
        <div class="col-md-8 p-5 bg-white">
            <form action="" method="post" id="register" autocomplete="off">
                <h3 class="font-weight-bold mb-4 text-center text-success">Đăng ký tài khoản</h3>

                <div class="form-group mb-1">
                    <label for="email_res">Địa chỉ Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input name="email_register" type="email" value="<?= $email_tmp ?>" class="form-control" id="email_res" placeholder="Email" required>
                    </div>
                    <span class="text-danger"><?= $error['email'] ?></span>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="full_name">Họ và tên</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input name="full_name" type="text" value="<?= $fullname_tmp ?>" class="form-control" id="full_name" placeholder="Họ và tên" required>
                        </div>
                        <span class="text-danger"><?= $error['fullname'] ?></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="phone">Số điện thoại</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input name="phone" type="text" value="<?= $phone_tmp ?>" class="form-control" id="phone" placeholder="SĐT" required>
                        </div>
                        <span class="text-danger"><?= $error['phone'] ?></span>
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label for="username">Tên đăng nhập</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input name="username" type="text" value="<?= $username_tmp ?>" class="form-control" id="username" placeholder="Tên đăng nhập" required>
                    </div>
                    <span class="text-danger"><?= $error['username'] ?></span>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password_register">Mật khẩu</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input name="password" type="password" value="<?= $password_tmp ?>" class="form-control" id="password_register" placeholder="Mật khẩu" required>
                            <div class="input-group-append">
                                <span class="input-group-text" onclick="password_show_hide_register();">
                                    <i class="fas fa-eye" id="show_eye_register"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye_register"></i>
                                </span>
                            </div>
                        </div>
                        <span class="text-danger"><?= $error['password'] ?></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="password_confirm">Xác nhận mật khẩu</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-check"></i></span>
                            </div>
                            <input name="password_confirm" type="password" value="<?= $password_cf_tmp ?>" class="form-control" id="password_confirm" placeholder="Xác nhận" required>
                        </div>
                        <span class="text-danger"><?= $error['password_confirm'] ?></span>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="address">Địa chỉ</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-map-marker"></i></span>
                        </div>
                        <input name="address" type="text" value="<?= $address_tmp ?>" class="form-control" id="address" placeholder="Địa chỉ" required>
                    </div>
                    <span class="text-danger"><?= $error['address'] ?></span>
                </div>

                <button class="btn btn-success w-100 mb-2" type="submit" name="register">Đăng ký</button>
            </form>
        </div>

        <!-- Welcome Box -->
        <div class="col-md-4 d-flex flex-column justify-content-center align-items-center text-white bg-success py-5 px-3">
            <h3 class="mb-3 text-center font-weight-bold">Chào mừng đến với VegetaBox</h3>
            <p class="mb-3">Bạn đã có tài khoản?</p>
            <a href="login" class="btn btn-outline-light" style="border-radius:6px;">Đăng nhập ngay</a>
        </div>
    </div>
</div>

<script>
    function password_show_hide_register() {
        var password = document.getElementById("password_register");
        var password_confirm = document.getElementById("password_confirm");
        var show_eye = document.getElementById("show_eye_register");
        var hide_eye = document.getElementById("hide_eye_register");
        hide_eye.classList.remove("d-none");
        if (password.type === "password") {
            password.type = "text";
            password_confirm.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "inline";
        } else {
            password.type = "password";
            password_confirm.type = "password";
            show_eye.style.display = "inline";
            hide_eye.style.display = "none";
        }
    }
</script>
