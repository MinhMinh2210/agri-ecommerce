<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Danh sách tài khoản</h6>
            <a href="them-tai-khoan" class="btn btn-success"><i class="fa fa-plus"></i> Thêm tài khoản</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0" id="users-list">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">#</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Vai trò</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($list_users as $value) {
                        extract($value);
                        $i++;
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td>
                                <img style="max-width: 50px;" src="../upload/<?= $image ?>" alt="">
                            </td>
                            <td><?= $full_name ?></td>
                            <td><?= $email ?></td>
                            <td><?= $phone ?></td>
                            <td>
                                <?php
                                if ($role == 0) {
                                    echo "Khách hàng";
                                } elseif ($role == 1) {
                                    echo "Nhân viên";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    td {
        height: 50px;
    }
</style>