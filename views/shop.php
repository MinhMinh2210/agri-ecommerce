<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="index.php"><i class="fa fa-home"></i> Trang chủ</a>
                    <span>Cửa hàng</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="shop__sidebar">
                    <div class="sidebar__categories">
                        <div class="section-title">
                            <h4>TÌM THEO SẢN PHẨM</h4>
                        </div>
                        <div class="categories__accordion">
                            <div class="accordion" id="accordionExample">
                                <?php foreach ($list_categories as $value) {
                                    extract($value);
                                ?>
                                    <div class="card">
                                        <div class="card-heading active">
                                            <a href="category&id=<?= $category_id ?>"><?= $name ?></a>
                                        </div>

                                    </div>
                                <?php
                                }
                                ?>


                            </div>
                        </div>
                    </div>
                    <!-- <div class="sidebar__filter">
                        <div class="section-title">
                            <h4>TÌM THEO GIÁ</h4>
                        </div>
                        <div class="filter-range-wrap">
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="100000" data-max="5000000"></div>
                            <div class="range-slider">
                                <form action="index.html" method="post">

                                    <div class="price-input">
                                        <p>Giá từ:</p> <br>
                                        <input type="text" id="minamount">
                                        <p>đến</p>
                                        <input type="text" id="maxamount"> <br>

                                        
                                        <input type="submit" class="filter-price" name="" value="LỌC GIÁ">
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div> -->
                    <!-- <a href="#">LỌC GIÁ</a> -->


                </div>
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="row">
                    <?php foreach ($list_products as $value) {
                        extract($value);
                        $discount_percentage = $this->ProductModel->discount_percentage($price, $sale_price);
                    ?>
                        <div class="col-lg-4 col-md-6 col-6-rp-mobile">
                            <a href="productdetail&id_sp=<?= $product_id ?>&id_dm=<?= $category_id ?>">
                                <div class="product__item sale">
                                    <div class="product__item__pic set-bg" data-setbg="upload/<?= $image ?>">
                                        <!-- <div class="label sale">Sale</div> -->
                                        <div class="label_right sale">-<?= $discount_percentage ?></div>
                                    </div>
                                    <div class="product__item__text d-flex justify-content-start align-items-center">
                                        <div class="flex-grow-1">
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
                                        <div>
                                            <a href="#" class="btn btn-outline-success"><i class="fa fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    //  Pagination

                    $html_pagination = '';
                    $pagination_next = '';
                    $pagination_prev = '';
                    for ($i = 1; $i <= $numberOfPages; $i++) {
                        if ($i === $currentPage) {
                            $active = 'active';
                        } else {
                            $active = '';
                        }

                        $html_pagination .= '
                                    <a class="' . $active . '" href="shop&page=' . $i . '">' . $i . '</a>
                                ';

                        //  Trang trước
                        if ($currentPage < $numberOfPages) {
                            $pagination_next = '
                                        <a href="shop&page=' . ($currentPage + 1) . '"><i class="fa fa-angle-right"></i></a>
                                    ';
                        }

                        //  Trang sau
                        if ($currentPage > 1) {
                            $pagination_prev = '
                                        <a href="shop&page=' . ($currentPage - 1) . '"><i class="fa fa-angle-left"></i></a>
                                    ';
                        }
                    }
                    ?>

                    <div class="col-lg-12 text-center">
                        <div class="pagination__option">
                            <?= $pagination_prev ?>
                            <?= $html_pagination ?>
                            <?= $pagination_next ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->