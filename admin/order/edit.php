<div class="container pt-4">
    <article class="card">
        <header class="card-header text-dark">
            <h6>
                <a href="orders" class="link-not-hover text-success">Đơn hàng</a>
                / Chi tiết đơn hàng
            </h6>
        </header>
        <div class="card-body mt-2">

            <ul class="row">
                <?php
                foreach ($order_details as $value) {
                    extract($value);
                ?>
                    <li class="col-md-4">
                        <figure class="itemside mb-3">
                            <div class="aside"><img src="../upload/<?= $product_image ?>" class="img-sm border"></div>
                            <figcaption class="info align-self-center">
                                <p class="title"><?= $product_name ?> <br> </p>
                                <span class="text-danger"><?= number_format($price) ?>₫ </span><span>x<?= $quantity ?></span>
                            </figcaption>
                        </figure>
                    </li>
                <?php
                }
                ?>
            </ul>

            <div class="row">
                <div class="col-lg-6">
                    <div class="bg-light rounded border">
                        <div class="p-4">
                            <h6 class="mb-4">
                                Trạng thái đơn hàng: <span class="text-danger"><?= $order_status ?></span>
                            </h6>

                            <?php
                            function getStatusName($statusValue)
                            {
                                switch ($statusValue) {
                                    case 1:
                                        return 'Chờ xác nhận';
                                    case 2:
                                        return 'Đã xác nhận';
                                    case 3:
                                        return 'Đang giao';
                                    case 4:
                                        return 'Giao thành công';
                                    default:
                                        return 'Không xác định';
                                }
                            }
                            ?>

                            <form action="" method="post">
                                <div class="form-floating mb-3">
                                    <select name="status" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                        <?php
                                        $status_options = [1, 2, 3, 4];
                                        foreach ($status_options as $option_value) {
                                            $selected = ($option_value == $status) ? 'selected' : '';
                                            echo "<option value='$option_value' $selected>";
                                            echo getStatusName($option_value);
                                            echo "</option>";
                                        }
                                        ?>
                                    </select>
                                    <label for="floatingSelect">Trạng thái</label>
                                </div>
                                <input type="hidden" name="order_id" value="<?= $order_id ?>">
                                <h6 class="mb-4">
                                    <input type="submit" name="update_status_order" value="Cập nhật" class="btn btn-success">
                                </h6>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card mb-4 bg-light">
                        <div class="card-body text-dark">
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <p class="mb-0 text-end">Tên khách hàng</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0"><?= $full_name ?></p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <p class="mb-0 text-end">Số điện thoại</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0"><?= $order_phone ?></p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <p class="mb-0 text-end">Địa chỉ giao hàng</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0"><?= $order_address ?></p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <p class="mb-0 text-end">Thời gian</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0"><?= $date_formated ?></p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <p class="mb-0 text-end">Tổng tiền hàng</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0"><?= number_format($total) ?>₫</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <p class="mb-0 text-end">Phí vận chuyển</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0">Miễn phí</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0 text-end">Ghi chú</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="mb-0"><?= $note ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0 text-end">Thành tiền</p>
                                </div>
                                <div class="col-sm-8">
                                    <p style="font-size: 1.5rem;" class="mb-0 text-danger fw-bold"><?= number_format($total) ?>₫</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </article>
</div>