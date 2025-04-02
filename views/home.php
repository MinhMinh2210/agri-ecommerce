<!-- Banner Section Begin -->
<div class="row mt-5" style="width: 95%; margin: 0 auto;">
    <div class=" col-sm-12">
        <div id="header-carousel" class="" data-ride="">
            <div class="carousel-inner" style="border-radius: 10px;">
                <div class="carousel-item active">
                    <img class="img-fluid" src="public/img/banner/bn.png" alt="Image">

                </div>

                <div class="carousel-item">
                    <img class="img-fluid" src="public/img/banner/bn3.png" alt="Image">

                </div>
            </div>

        </div>
    </div>

</div>

<!-- Services Section Begin -->
<section class="services spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa-solid fa-truck"></i>
                    <h6>Giao hàng nhanh chóng</h6>
                    <p>Không lo về thời gian</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa-solid fa-money-bill-wave"></i>
                    <h6>Luôn có ưu đãi</h6>
                    <p>Giá rẻ nhất thị trường</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa-solid fa-phone-volume"></i>
                    <h6>Hỏi gì cũng trả lời</h6>
                    <p>Hỗ trợ bởi công nghệ</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa-solid fa-comments-dollar"></i>
                    <h6>Giao dịch nhanh chóng</h6>
                    <p>Thanh toán an toàn 100%</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section End -->

<section class="container my-3">
</section>
<!-- Banner Section End -->


<!-- Product Section Begin -->
<section class="product spad" style="background-color: #F4F4F9;">

    <div class="container" style="background-color: #ffffff; border-radius: 10px;">

        <div class="row pt-3 justify-content-center">
            <div class="text-center">
                <div class="section-title text-center">
                    <h4>Sản phẩm nổi bật</h4>
                </div>
            </div>

        </div>
        <div class="row property__gallery">
            <?php foreach ($listProducts as $product) {
                extract($product);

                $discount_percentage = $this->ProductModel->discount_percentage($price, $sale_price);
            ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix sach-1">
                    <a href="productdetail&id_sp=<?= $product_id ?>&id_dm=<?= $category_id ?>">

                        <div class="product__item sale">
                            <div class="product__item__pic set-bg" data-setbg="upload/<?= $image ?>">
                                <!-- <div class="label sale">Sale</div> -->
                                <div class="label_right sale">-<?= $discount_percentage ?></div>
                            </div>
                            <div class="product__item__text">
                                <div class="product__price"><?= number_format($sale_price) . "₫" ?> <span><?= number_format($price) . "đ" ?></span></div>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <h6 class="text-truncate-1"><a href=""><?= $name ?></a></h6>
                            </div>
                        </div>
                    </a>
                </div>

            <?php
            }
            ?>



            <div class="col-lg-12 text-center mb-4">
                <a href="shop" class="btn btn-outline-success">Xem thêm</a>
            </div>
        </div>

    </div>
    <section class="container cate-home" style="background-color: #ffffff; border-radius: 10px;">
        <!-- CATE END-->
        <div class="section-title pt-2 text-center" style="margin: 30px 0;">
            <h4>Danh mục sản phẩm</h4>
        </div>

        <div class="row g-1 mb-4 mt-2 pb-4 justify-content-center">
            <?php foreach ($listCategories as $value) {
                extract($value);
                $link = 'category&id=' . $category_id;
            ?>
                <div class="col-lg-2 col-md-3 col-sm-6 text-center p-1 cate-gory">
                    <a href="<?= $link ?>"><img style="width: 50%;" src="upload/<?= $image ?>" alt=""></a>
                    <div class="mt-2">
                        <a class="cate-name text-dark" href="<?= $link ?>"><?= $name ?></a>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
    </section>
</section>


<!-- Banner Section Begin -->
<div>
    <img src="public/img/banner/bn3.png" alt="banner">
</div>
<!-- Banner Section End -->