<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->
    <?php
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']['id'];
        $count_carts = count($CartModel->count_cart($user_id));
    }

    ?>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
            <li><a href="#"><span class="icon_heart_alt"></span>
                    <div class="tip">2</div>
                </a></li>
            <li><a href="#"><span class="icon_bag_alt"></span>
                    <div class="tip">2</div>
                </a></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="index.php"><img src="public/img/logo.png" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>

        <?php if (isset($_SESSION['user'])) { ?>
            <div class="offcanvas__auth acount">
                <a href="?url=thong-tin-tai-khoan">
                    <img src="upload/<?= $_SESSION['user']['image'] ?>" alt=""><?= $_SESSION['user']['username'] ?>
                </a>
            </div>
        <?php
        } else {
        ?>
            <div class="offcanvas__auth">
                <a href="?url=dang-nhap">Đăng nhập</a>
                <a href="?url=dang-ky">Đăng ký</a>
            </div>
        <?php
        }
        ?>

    </div>
    <!-- Offcanvas Menu End -->
    <!-- Top Header -->
    <div class="py-1 text-white bg-success" style="font-size: 12px;">
        <div class="container d-flex justify-content-between">
            <span> +0123456789, Thành phố Hồ Chí Minh</span>
            <span>📧 contact@cleanagri.com</span>
        </div>
    </div>
    <!-- Header Section Begin -->
    <header class="header border-top" style="background-color:rgb(233, 248, 233);">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo">
                        <a href="index.php"><img style="max-height: 38px;" src="public/img/Logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <nav class="header__menu">
                        <ul id="navigation">
                            <li><a href="index.php">TRANG CHỦ&nbsp;<i class="fa-solid fa-chevron-down py-2 d-inline-block" style="font-size: 11px;"></i></a></li>

                            <li><a href="index.php?url=shop">Cửa hàng&nbsp;<i class="fa-solid fa-chevron-down py-2 d-inline-block" style="font-size: 11px;"></i></a></li>
                            <li><a href="#">Đặt hàng&nbsp;<i class="fa-solid fa-chevron-down py-2 d-inline-block" style="font-size: 11px;"></i></a>
                                <ul class="dropdown">

                                    <li><a href="index.php?url=cart">Giỏ hàng</a></li>
                                    <li><a href="index.php?url=thanh-toan">Thanh toán</a></li>
                                    <li><a href="index.php?url=don-hang">Đơn mua</a></li>
                                </ul>
                            </li>
                            <!-- <li><a href="index.php?url=bai-viet">Blog&nbsp;<i class="fa-solid fa-chevron-down py-2 d-inline-block" style="font-size: 11px;"></i></a></li> -->
                            <li><a href="index.php?url=lien-he">Về chúng tôi&nbsp;<i class="fa-solid fa-chevron-down py-2 d-inline-block" style="font-size: 11px;"></i></a></li>





                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__right">
                        <?php if (isset($_SESSION['user'])) { ?>
                            <ul class="header__right__widget">
                                <li><span class="icon_search search-switch"></span></li>

                                <li><a id="p" href="cart"><i class="fa-solid fa-cart-shopping"></i>
                                        <div class="tip"><?= $count_carts ?></div>
                                    </a></li>
                            </ul>
                        <?php } else { ?>

                            <ul></ul>
                        <?php } ?>

                        <?php if (isset($_SESSION['user'])) { ?>
                            <div class="header__right__auth acount">
                                <a href="index.php?url=thong-tin-tai-khoan">
                                    <img src="upload/<?= $_SESSION['user']['image'] ?>" alt=""><?= $_SESSION['user']['username'] ?>
                                </a>

                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="header__right__auth">
                                <a href="index.php?url=dang-nhap" class="btn btn-success text-white rounded-pill px-4 py-2 mb-0 text-capitalize">Đăng nhập</a>
                            </div>
                        <?php
                        }
                        ?>


                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <script>
        const currentPath = window.location.href.replace("http://localhost/WEBNONGSAN/", "");
        const activeLink = document.querySelector(`#navigation li a[href="${currentPath}"]`);
        activeLink.parentElement.classList.add("active");
    </script>