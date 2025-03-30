<!-- LIST PRODUCTS -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Danh mục</h6>
            <a href="them-danh-muc" class="btn btn-success"><i class="fa fa-plus"></i> Thêm danh mục</a>
        </div>

        <div class="table-responsive">
            <?= $html_alert ?>

            <table class="table table-bordered table-hover mb-0" id="categories-list">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Chỉnh sửa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($list_catgories as $value) {
                        $i++;
                        extract($value);
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td style="min-width: 200px;"><?= $category_name ?></td>
                            <td>
                                <img style="max-width: 50px;" src="../upload/<?= $category_image ?>" alt="Ảnh danh mục">
                            </td>
                            <td><?= $qty_product ?></td>
                            <td style="min-width: 100px;">
                                <?php
                                $trangThai = 'Tạm ẩn';
                                if ($category_status == 1) {
                                    $trangThai = 'Hiển thị';
                                    echo '<span class="badge bg-success">' . $trangThai . '</span>';
                                } else {
                                    echo '<span class="badge bg-danger">' . $trangThai . '</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a href="#" class="text-dark" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="index.php?quanli=cap-nhat-danh-muc&id=<?= $cate_id ?>">Sửa</a></li>
                                        <li><a class="dropdown-item text-danger" href="danh-sach-danh-muc&xoa=<?= $cate_id ?>&qty_pd=<?= $qty_product ?>">Xóa</a></li>
                                    </ul>
                                </div>
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