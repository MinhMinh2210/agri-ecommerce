<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="index.php"><i class="fa fa-home"></i> Trang chủ</a>
                    <a href="cua-hang">Sản phẩm </a>
                    <a href="category&id=<?= $id_danhmuc ?>">
                        <?php foreach ($name_catgoty as $value) {
                            if ($value['category_id'] == $id_danhmuc) {
                                echo $value['name'];
                            }
                        } ?>
                    </a>
                    <span><?= $name ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__left product__thumb nice-scroll">
                        <!-- <a class="pt active" href="#product-1">
                            <img src="upload/<?= $image ?>" alt="">
                        </a>
                        <a class="pt" href="#product-2">
                            <img src="upload/<?= $image ?>" alt="">
                        </a> -->
                        <!-- <a class="pt" href="#product-3">
                                <img src="img/product/conan-1.jpg" alt="">
                            </a> -->

                    </div>
                    <div class="product__details__slider__content">
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-hash="product-1" class="product__big__img" src="upload/<?= $image ?>" alt="">
                            <!-- <img data-hash="product-2" class="product__big__img" src="upload/<?= $image ?>" alt="">
                            <img data-hash="product-3" class="product__big__img" src="upload/<?= $image ?>" alt=""> -->

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product__details__text">
                    <h3 class="d-flex align-items-center">
                        <?= $name ?>
                        <div class="rating" style="margin-left: 20px;">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </h3>
                    <span>
                        Danh mục: <?php foreach ($name_catgoty as $value) {
                                        if ($value['category_id'] == $id_danhmuc) {
                                            echo $value['name'];
                                        }
                                    } ?>
                    </span>

                    <div class="product__details__price">
                        <?= $this->ProductModel->formatted_price($sale_price); ?>
                        <span class="ml-2">
                            <?= $this->ProductModel->formatted_price($price); ?>
                        </span>
                        <div class="label_right ml-2"><?= $discount_percentage ?></div>
                    </div>

                    <div class="short__description">
                        <?= $short_description ?>
                    </div>

                    <div class="product__details__button">

                        <?php if (isset($_SESSION['user'])) { ?>
                            <form action="cart" method="post">
                                <div class="input-group d-flex align-items-center">
                                    <span class="text-dark">Số lượng</span>
                                    <div class="input-next-cart d-flex mx-4">
                                        <input type="button" value="-" class="button-minus" data-field="quantity">
                                        <input type="number" step="1" max="50" value="1" name="product_quantity" class="quantity-field-cart">
                                        <input type="button" value="+" class="button-plus" data-field="quantity">
                                    </div>
                                    <span class="text-dark">Kho: <?= $quantity ?></span>

                                </div>

                                <input value="<?= $product_id ?>" type="hidden" name="product_id">
                                <input value="<?= $_SESSION['user']['id'] ?>" type="hidden" name="user_id">
                                <input value="<?= $name ?>" type="hidden" name="name">
                                <input value="<?= $image ?>" type="hidden" name="image">
                                <input value="<?= $sale_price ?>" type="hidden" name="price">
                                <!-- <input value="1" type="hidden" name="product_quantity"> -->
                                <input value="<?= $image ?>" type="hidden" name="image">

                                <div class="quantity">
                                    <button name="add_to_cart" style="border: none;" type="submit" class="cart-btn btn-primary">Thêm giỏ hàng <i class="fa-solid fa-cart-plus"></i></button>
                                    <button name="add_to_cart" type="submit" style="height: 50px;" class="btn btn-outline-success">Mua ngay <span class="icon_bag_alt"></span></button>
                                </div>
                            </form>
                        <?php } else { ?>
                            <div class="input-group d-flex align-items-center">
                                <span class="text-dark">Số lượng</span>
                                <div class="input-next-cart d-flex mx-4">
                                    <input type="button" value="-" class="button-minus" data-field="quantity">
                                    <input type="number" step="1" max="50" value="1" name="product_quantity" class="quantity-field-cart">
                                    <input type="button" value="+" class="button-plus" data-field="quantity">
                                </div>
                                <span class="text-dark">Kho: <?= $quantity ?></span>
                            </div>
                            <div class="quantity">
                                <button name="add_to_cart" onclick="alert('Vui lòng dăng nhập để thực hiện chức năng');" style="border: none;" type="submit" class="cart-btn btn-primary">
                                    <span class="icon_bag_alt"></span> <a href="login" style="color: #ffffff;">Thêm vào giỏ</a>
                                </button>
                                <button name="add_to_cart" onclick="alert('Vui lòng dăng nhập để thực hiện chức năng');" type="submit" style="background-color: #ca1515; border: none;" class="cart-btn">
                                    <span class="icon_bag_alt"></span> <a href="login" style="color: #ffffff;">Mua ngay</a>
                                </button>
                            </div>
                        <?php } ?>
                        <ul>
                            <li><a href="#" class="text-dark"><i class="fa-solid fa-heart"></i></a></li>
                            <li><a href="#"><span class="icon_adjust-horiz"></span></a></li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Mô tả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Bình luận ( <?= count($list_comments) ?> )</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <h6>Mô tả</h6>
                            <p><?= $details ?></p>
                            <p></p>
                        </div>

                        <!-- Bình luận   -->
                        <?php include_once "views/comments.php"; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="related__title">
                    <h5>SẢM PHẨM TƯƠNG TỰ</h5>
                </div>
            </div>
            <?php
            foreach ($similar_product as $value) {
                if (is_array($value)) {
                    extract($value);
                    $discount_percentage = $this->ProductModel->discount_percentage($price, $sale_price);
                }

            ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix">
                    <div class="product__item sale">
                        <div class="product__item__pic set-bg" data-setbg="upload/<?= $image ?>">

                            <div class="label_right sale">-<?= $discount_percentage ?></div>
                            <ul class="product__hover">
                                <li><a href="upload/<?= $image ?> " class="image-popup"><span class="arrow_expand"></span></a></li>
                                <li>
                                    <a href="productdetail&id_sp=<?= $product_id ?>&id_dm=<?= $category_id ?>"><span class="icon_search_alt"></span></a>
                                </li>

                                <li>
                                    <form action="blog.html" method="post">
                                        <input type="hidden" name="product_id">
                                        <input type="hidden" name="user_id">
                                        <input type="hidden" name="name">
                                        <input type="hidden" name="price">
                                        <input type="hidden" name="quantity">
                                        <input type="hidden" name="image">
                                        <button type="submit" name="add_to_cart">
                                            <a href="#"><span class="icon_bag_alt"></span></a>
                                        </button>
                                    </form>
                                </li>

                            </ul>

                        </div>
                        <div class="product__item__text">
                            <h6 class="text-truncate-1">
                                <a href="productdetail&id_sp=<?= $product_id ?>&id_dm=<?= $category_id ?>">
                                    <?= $name ?>
                                </a>
                            </h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price"><?= $this->ProductModel->formatted_price($sale_price); ?> <span><?= $this->ProductModel->formatted_price($price); ?> </span></div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>




        </div>
    </div>
    </div>
</section>
<!-- Product Details Section End -->


<style>
    .label_right {
        font-size: 14px;
        color: #ffffff;
        font-weight: 700;
        display: inline-block;
        padding: 2px 8px;
        text-transform: uppercase;
        background: #ca1515;
        border-radius: 5px;
    }
</style>