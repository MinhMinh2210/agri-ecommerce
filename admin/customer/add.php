<div class="container-fluid pt-4" style="margin-bottom: 110px;">
    <form class="row g-4" action="" method="post" enctype="multipart/form-data">
        <div class="col-sm-12 col-xl-9">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">
                    <a href="index.php?quanli=danh-sach-khach-hang" class="link-not-hover text-success">Tài khoản</a>
                    / Thêm tài khoản
                </h6>
                <?= $html_alert ?>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control" value="<?= $temp['email'] ?>" required>
                    <span class="text-danger"><?= $error['email'] ?></span>
                </div>

                <div class="mb-3">
                    <label for="full_name">Họ và tên</label>
                    <input name="full_name" type="text" class="form-control" value="<?= $temp['full_name'] ?>" required>
                    <span class="text-danger"><?= $error['fullname'] ?></span>
                </div>

                <div class="mb-3">
                    <label for="username">Tên đăng nhập</label>
                    <input name="username" type="text" value="<?= $temp['username'] ?>" class="form-control" required>
                    <span class="text-danger"><?= $error['username'] ?></span>
                </div>

                <div class="mb-3">
                    <label for="password">Mật khẩu</label>
                    <input name="password" type="password" value="<?= $temp['password'] ?>" class="form-control" required>
                    <span class="text-danger"><?= $error['password'] ?></span>
                </div>

                <div class="mb-3">
                    <label for="password_confirm">Xác nhận mật khẩu</label>
                    <input name="password_confirm" type="password" value="<?= $temp['password_confirm'] ?>" class="form-control" required>
                    <span class="text-danger"><?= $error['password_confirm'] ?></span>
                </div>

                <div class="mb-3">
                    <label for="phone">Số điện thoại</label>
                    <input name="phone" type="text" value="<?= $temp['phone'] ?>" class="form-control" required>
                    <span class="text-danger"><?= $error['phone'] ?></span>
                </div>

                <div class="mb-3">
                    <label for="address">Địa chỉ</label>
                    <input name="address" type="text" value="<?= $temp['address'] ?>" class="form-control" required>
                    <span class="text-danger"><?= $error['address'] ?></span>
                </div>

                <div class="mb-3">
                    <label for="role">Vai trò</label>
                    <select name="role" class="form-select" id="role" aria-label="Floating label select example">
                        <option selected value="0">Khách hàng</option>
                        <option value="1">Nhân viên</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-xl-3">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">
                    <input type="submit" name="add_user" value="Thêm tài khoản" class="btn btn-success w-100">
                </h6>
            </div>
        </div>

    </form>
</div>

<style>
    .err {
        display: inline-block;
        height: 22px;
    }
</style>