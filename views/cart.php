<?php if (isset($_SESSION['user'])) { ?>
    <div class="breadcrumb-option" style="display: flex; justify-content: space-between; align-items: center; position: relative;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="breadcrumb__links">
                        <a href="index.php"><i class="fa fa-home"></i> Trang chủ</a>
                        <a href="shop"> Cửa hàng</a>
                        <span>Giỏ hàng</span>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn update__btn" style="position: absolute; right: 0; top: 0;">
                        <!-- <a href="#"><span class="icon_loading"></span>Cập nhật giỏ hàng</a> -->

                        <button name="update_cart" type="submit"><span class="icon_loading"></span>Cập nhật giỏ hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kiểm tra giỏ hàng có sản phẩm không -->
    <?php if (count($list_carts) > 0) { ?>
        <!-- Shop Cart Section Begin -->
        <section class="shop-cart spad">
            <div class="container">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-lg-8">
                            <!-- <form action="" method="post"> -->
                            <div class="shop__cart__table">
                                <?= $alert = $this->BaseModel->alert_error_success($error, $success) ?>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>SẢN PHẨM</th>
                                            <th>GIÁ</th>
                                            <th>SỐ LƯỢNG</th>
                                            <th>TỔNG</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $totalPayment = 0;
                                        foreach ($list_carts as $value) {
                                            extract($value);
                                            $totalPrice = ($product_price * $product_quantity);
                                            //Tổn thanh toán
                                            $totalPayment += $totalPrice;
                                            // Lấy id danh mục của sản phẩm để hiện thị đường dẫn sang trang ctsp
                                            $product = $this->ProductModel->select_cate_in_product($product_id);

                                        ?>
                                            <tr>
                                                <td class="cart__product__item">
                                                    <a href="productdetail&id_sp=<?= $product_id ?>&id_dm=<?= $product['category_id'] ?>">
                                                        <img src="upload/<?= $product_image ?>" alt="">
                                                    </a>
                                                    <div class="cart__product__item__title">
                                                        <h6 class="text-truncate-1" style="font-size: 17px;">
                                                            <a href="productdetail&id_sp=<?= $product_id ?>&id_dm=<?= $product['category_id'] ?>" class="text-dark">
                                                                <?= $product_name ?>
                                                            </a>
                                                        </h6>
                                                        <?php
                                                            // Lấy category_id của sản phẩm
                                                            $category_id = $this->ProductModel->select_cate_in_product($product_id)['category_id'];

                                                            // Tìm tên danh mục tương ứng
                                                            $category_name = "Không xác định";
                                                            foreach ($categories as $cat) {
                                                                if ($cat['category_id'] == $category_id) {
                                                                    $category_name = $cat['name'];
                                                                    break;
                                                                }
                                                            }
                                                        ?>
                                                        <div class="cart__category__name">
                                                            <span style="font-style: italic; font-size: 14px;"><?= $category_name ?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="cart__price"><?= number_format($product_price) ?>đ</td>
                                                <input type="hidden" name="product_id[]" value="<?= $product_id ?>">
                                                <td class="cart__quantity">
                                                    <div class="input-group float-left">
                                                        <div class="input-next-cart d-flex ">
                                                            <input type="button" value="-" class="button-minus" data-field="quantity">
                                                            <input type="number" step="1" max="" value="<?= $product_quantity ?>" name="quantity[]" class="quantity-field-cart">
                                                            <input type="button" value="+" class="button-plus" data-field="quantity">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="cart__total"><?= number_format($totalPrice) ?>đ</td>
                                                <td class="cart__close">
                                                    <a href="cart&xoa=<?= $cart_id ?>">
                                                        <span><i class="fa-solid fa-trash"></i></span>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- </form> -->
                        </div>

                        <!-- THÔNG TIN CHỐT SẢN PHẨM -->
                        <div class="col-lg-4">
                            <div class="cart__total__procced">
                                <h6>Tổng tiền</h6>
                                <ul>
                                    <li>Số lượng <span><?= $count_carts ?> sản phẩm</span></li>
                                    <!-- Tổng thanh toán -->
                                    <li>Tổng <span><?= number_format($totalPayment) ?>đ</span></li>
                                </ul>
                                <a href="checkout" class="primary-btn">THANH TOÁN</a>
                                <!-- <a href="checkout-momo" class="btn-momo primary-btn mt-3">THANH TOÁN MOMO</a> -->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="cart__btn">
                                <a href="shop">Tiếp tục mua sắm</a>
                            </div>
                        </div>
                        <!-- <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="cart__btn update__btn" style="position: absolute; right: 0; top: 0;">
                                <button name="update_cart" type="submit"><span class="icon_loading"></span>Cập nhật giỏ hàng</button>
                            </div>
                        </div> -->
                    </div>
                </form>
                
            </div>
        </section>
        <!-- Shop Cart Section End -->
    <?php } else { ?>
        <div class="row" style="margin-bottom: 400px;">
            <div class="col-lg-12 col-md-12">
                <div class="container-fluid mt-5">
                    <div class="row rounded justify-content-center mx-0 pt-5">
                        <div class="col-md-6 text-center">
                            <h4 class="mb-4">Chưa có sản phẩm nào trong giỏ hàng</h4>
                            <a class="btn btn-primary rounded-pill py-3 px-5" href="index.php?url=shop">Xem sản phẩm</a>
                            <a class="btn btn-secondary rounded-pill py-3 px-5" href="index.php">Trang chủ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

<?php } else { ?>
    <div class="row" style="margin-bottom: 400px;">
        <div class="col-lg-12 col-md-12">
            <div class="container-fluid mt-5">
                <div class="row rounded justify-content-center mx-0 pt-5">
                    <div class="col-md-6 text-center">
                        <h4 class="mb-4">Vui lòng đăng nhập để có thể mua hàng</h4>
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="index.php?url=login">Đăng nhập</a>
                        <a class="btn btn-secondary rounded-pill py-3 px-5" href="index.php">Trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<style>
    .cart__btn a:hover {
        background-color: rgb(9, 174, 47);
        color: #fff;
        transition: 0.2s;
    }

    .cart__btn button:hover {
        background-color: rgb(10, 166, 73);
        color: #fff;
        transition: 0.2s;
    }

    .btn-momo {
        background-color: #D82D8B;
        color: #fff;
    }

    .btn-momo:hover {
        opacity: 0.8;
        color: #fff;
    }
</style>