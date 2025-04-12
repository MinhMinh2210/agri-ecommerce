<style>
    /* Overlay mờ */
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.3);
        z-index: 1;
    }

    /* Icon bo tròn nền xanh */
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

    .form-group label {
        margin-bottom: 0rem; /* hoặc 0.2rem tuỳ cảm giác */
    }

</style>

<div class="position-relative container-fluid min-vh-100 d-flex align-items-center justify-content-center" style="background-image: url('public/img/nen_login.jpg'); background-size: cover; background-position: center;">
    
    <!-- Overlay -->
    <div class="overlay"></div>

    <!-- Content -->
    <div class="row w-75 shadow overflow-hidden position-relative" style="background-color: rgba(255,255,255,0.95); z-index: 2; border-radius: 9px;">
        <!-- Form Login -->
        <div class="col-md-6 p-5 bg-white">
            <form action="" method="post" id="login" autocomplete="off">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="font-weight-bold mb-0">Đăng nhập</h3>
                    <div class="d-flex">
                        <a href="#" class="social-icon mx-1"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon mx-1"><i class="fas fa-envelope"></i></a>
                    </div>
                </div>

                <?= $html_alert ?>

                <div class="form-group">
                    <label for="username" class="text-uppercase mb-2">Tài khoản</label>
                    <input name="username_login" type="text" value="<?= $username_tmp ?>" class="form-control" id="username" placeholder="Nhập tài khoản" required>
                </div>

                <div class="form-group">
                    <label for="password" class="text-uppercase">Mật khẩu</label>
                    <div class="input-group">
                        <input name="password_login" type="password" value="<?= $password_tmp ?>" class="form-control" id="password" placeholder="Nhập mật khẩu" required>
                        <div class="input-group-append">
                            <span class="input-group-text" onclick="password_show_hide();">
                                <i class="fas fa-eye" id="show_eye"></i>
                                <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="remember">
                    <label class="form-check-label text-success" for="remember">Nhớ mật khẩu</label>
                </div>

                <button type="submit" class="btn btn-success w-100" name="signin">Đăng nhập</button>
            </form>
        </div>

        <!-- Welcome Box -->
        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center text-white bg-success py-5 px-3">
            <h3 class="text-center">Chào mừng đến với</h3>
            <h2 class="mb-3 text-center font-weight-bold">VegetaBox</h2>
            <p class="mb-3">Bạn có tài khoản chưa?</p>
            <a href="register" class="btn btn-outline-light" style="border-radius:6px;">Đăng ký ngay</a>
        </div>
    </div>
</div>

<script>
    function password_show_hide() {
        var x = document.getElementById("password");
        var show_eye = document.getElementById("show_eye");
        var hide_eye = document.getElementById("hide_eye");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "inline";
        } else {
            x.type = "password";
            show_eye.style.display = "inline";
            hide_eye.style.display = "none";
        }
    }
</script>
