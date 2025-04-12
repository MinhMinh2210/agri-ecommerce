<!-- Breadcrumb Begin -->
<?php



?>
<?php
if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['id'];
    $list_carts = $this->CartModel->select_all_carts($user_id);
    $count_cart = count($this->CartModel->count_cart($user_id));
?>
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="index.php"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Thanh toán</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-between align-items-center mb-4">
                    <!-- <h6 class="coupon__link"><span class="icon_tag_alt mr-1"></span>Tiến hành thanh toán đơn hàng <a class="text-primary" href="cart">Trở lại giỏ hàng</a> </h6> -->
                    <div><h2 class="text__title">Thanh toán đơn hàng</h2></div>
                    <div class="cart__btn mt-2 mb-3 rounded-circle">
                        <a href="cart" class="rounded">Trở lại giỏ hàng</a>
                    </div>
                </div>
            </div>
            <form action="" method="post" class="checkout__form">
                <?php
                if ($success != '') {
                    $alert = $BaseModel->alert_error_success($error, $success);
                    echo $alert;
                }
                ?>
                <div class="row">
                <div class="col-lg-6">
                        <div class="checkout__order">
                            <h5>ĐƠN HÀNG</h5>
                            <div class="checkout__order__product">
                                <ul>
                                    <li>
                                        <span class="top__text">Sản phẩm</span>
                                        <span class="top__text__right">Tổng</span>
                                    </li>
                                    <?php
                                    $i = 0;
                                    $totalPayment = 0; 
                                    foreach ($list_carts as $value) {
                                        extract($value);
                                        $totalPrice = ($product_price * $product_quantity);
                                        $totalPayment += $totalPrice;
                                        $i++;

                                        
                                    ?>
                                        <li>
                                            <!-- Thông tin insert vào orders -->
                                            <input type="hidden" name="user_id" value="<?= $user_id ?>">
                                            <input type="hidden" name="address" value="<?= $_SESSION['user']['address'] ?>">
                                            <input type="hidden" name="phone" value="<?= $_SESSION['user']['phone'] ?>">
                                            <input type="hidden" name="total_checkout" value="<?= $totalPayment ?>">
                                            <!-- Thông tin insert vào orderdetails -->
                                            <input type="hidden" name="product_id[]" value="<?= $product_id ?>">
                                            <input type="hidden" name="quantity[]" value="<?= $product_quantity ?>">
                                            <input type="hidden" name="price[]" value="<?= $product_price ?>">
                                        

                                            <?= $i ?>.
                                            <?= $product_name ?>
                                            <a class="text-primary">x<?= $product_quantity ?></a>
                                            <span><?= number_format($totalPrice) ?>đ</span>
                                            <!-- <div style="display: flex; align-items: center;">
                                                <?php if ($product_images): ?>
                                                    <img class="product-img" src="uploads/<?= htmlspecialchars($product_images) ?>" alt="<?= $product_name ?>">
                                                <?php endif; ?>
                                                <span><?= $i ?>. <?= $product_name ?></span>
                                                <a class="text-primary"> x<?= $product_quantity ?></a>
                                                <span><?= number_format($totalPrice) ?>đ</span>
                                            </div> -->
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="checkout__order__total">
                                <ul>

                                    <li>Tổng <span><?= number_format($totalPayment) ?>đ</span></li>
                                </ul>
                            </div>
                            <!-- <div class="checkout__order__widget">
                                <label for="paypal">
                                    Thanh toán khi nhận hàng
                                    <input type="checkbox" id="paypal">
                                    <span class="checkmark"></span>
                                </label>
                            </div> -->
                            <div class="checkout__order__widget text-center mb-2" style="color: #53a551;">
                                    <strong>Thanh toán khi nhận hàng</strong>
                                </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h5>Thông tin Khách hàng</h5>
                        <div class="row g-3">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Họ tên <span>*</span></p>
                                    <input type="text" disabled name="full_name" value="<?= $_SESSION['user']['full_name'] ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="checkout__form__input">
                                    <p>Số điện thoại <span>*</span></p>
                                    <input disabled type="text" name="phone" value="<?= $_SESSION['user']['phone'] ?>">
                                </div>
                            </div>
                            <div class="col-lg-12">

                                <div class="checkout__form__input">
                                    <p>Địa chỉ <span>*</span></p>
                                    <input disabled type="text" value="<?= $_SESSION['user']['address'] ?>">

                                </div>

                            </div>
                            
                            <div class="col-lg-12">
                                <div class="checkout__form__input">
                                    <p>Ghi chú<span></span></p>
                                    <input type="text" name="note">
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                            <?php if ($count_cart > 0) { ?>
                               
                                <button type="button" class="site-btn w-75" data-toggle="modal" data-target="#checkout-1">
                                    ĐẶT HÀNG
                                </button>
                                <!-- Modal thanh toán-->
                                <div class="modal fade" id="checkout-1" tabindex="-1" role="dialog" aria-labelledby="checkout-1" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4>Xác nhận đặt hàng</h4>
                                            </div>
                                            <div class="modal-body text-dark">
                                                Bạn có muốn tiếp tục đặt hàng ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                                <button type="submit" name="checkout" class="btn btn-primary">Xác nhận</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            <?php } else { ?>
                                <div class="checkout__order__widget text-center text-primary mb-2">
                                    Chưa có sản phẩm trong giỏ hàng
                                </div>
                                <a href="shop" class="site-btn btn">Xem sản phẩm</a>
                            <?php } ?>
                            </div>

                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
    </section>
    <!-- Checkout Section End -->
<?php } else { ?>
    <div class="row" style="margin-bottom: 400px;">
        <div class="col-lg-12 col-md-12">
            <div class="container-fluid mt-5">
                <div class="row rounded justify-content-center mx-0 pt-5">
                    <div class="col-md-6 text-center">
                        <h4 class="mb-4">Vui lòng đăng nhập để có thể thanh toán</h4>
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="login">Đăng nhập</a>
                        <a class="btn btn-secondary rounded-pill py-3 px-5" href="index.php">Trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<style>
    .text__title{
        color: #53a551;
    }
    .cart__btn a:hover {
        background-color: #53a551;
        color: #FFF;
        transition: 0.2s;
    }

    .checkout__form .checkout__form__input input {
        color: #000000;
    }

    .checkout__form .checkout__form__input input:focus {
        border: 1px solid #999999;
    }
</style>