<!-- LIST PRODUCTS -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">
                <a href="products" class="link-not-hover text-success">Danh sách sản phẩm</a>
                / Thùng rác
            </h6>
            <a href="add-product" class="btn btn-success"><i class="fa fa-plus"></i> Thêm sản phẩm</a>
        </div>

        <?php if (count($list_products) > 0) { ?>
            <div class="table-responsive">
                <div class="text-right">
                    <?= $html_alert ?>
                </div>
                <table class="table table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">#</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Giá thường</th>
                            <th scope="col">Giá khuyến mãi</th>
                            <th scope="col">Chỉnh sửa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($list_products as $value) {
                            $i++;
                        ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $value['name'] ?></td>
                                <td>
                                    <img style="max-width: 50px;" src="../upload/<?= $value['image'] ?>" alt="">
                                </td>
                                <td><?= number_format($value['price']) . "đ" ?></td>
                                <td><?= number_format($value['sale_price']) . "đ" ?></td>
                                <td>
                                    <a class="btn btn-sm btn-secondary" href="recycle-product&khoiphuc=<?= $value['product_id'] ?>">
                                        <i class="fa fa-undo"></i> Khôi phục
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
    </div>
<?php } else { ?>
    <p class="text-danger">Thùng rác rỗng</p>
<?php } ?>
</div>