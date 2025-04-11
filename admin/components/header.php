<?php
$current_page = isset($_GET['quanli']) ? $_GET['quanli'] : 'index';

function isActive($page, $current_page)
{
    return $page == $current_page ? 'active text-success' : 'text-dark';
}
?>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <img src="public_admin/img/logo.png" alt="logo">
                </a>
                <!-- <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="public_admin/img/user-default.png" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Hoang Nam</h6>
                        <span>Admin</span>
                    </div>
                </div> -->

                <!-- SIDE BAR -->
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link <?= $current_page == 'index' ? 'active text-success' : 'text-dark' ?>">
                        <i class="fa fa-tachometer-alt me-2"></i>Trang chủ
                    </a>
                    <a href="orders" class="nav-item nav-link <?= isActive('orders', $current_page) ?>">
                        <i class="fa fa-shopping-basket me-2"></i>Đơn hàng
                    </a>
                    <a href="categories" class="nav-item nav-link <?= isActive('categories', $current_page) ?>">
                        <i class="fa fa-th me-2"></i>Danh mục
                    </a>
                    <a href="products" class="nav-item nav-link <?= isActive('products', $current_page) ?>">
                        <i class="fas fa-box me-2"></i>Sản phẩm
                    </a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-chart-bar me-2"></i> Thống kê
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="statistic-product" class="dropdown-item">Sản phẩm - danh mục</a>
                            <a href="thong-ke-don-hang" class="dropdown-item">Đơn hàng</a>
                        </div>
                    </div>
                    <a href="users" class="nav-item nav-link <?= isActive('users', $current_page) ?>">
                        <i class="fas fa-users me-2"></i>Thành viên
                    </a>
                    <a href="binh-luan" class="nav-item nav-link <?= isActive('binh-luan', $current_page) ?>">
                        <i class="fas fa-comment me-2"></i>Bình luận
                    </a>
                </div>



                <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item">Blank Page</a>
                        </div>
                    </div> -->

            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars text-success"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Tìm kiếm">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <!-- <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> -->
                        <!-- <i class="fa fa-envelope me-lg-2"></i> -->
                        <!-- <span class="d-none d-lg-inline-flex">Tin nhắn</span> -->
                        <!-- </a> -->
                        <!-- <div class="dropdown-menu dropdown-menu-end bg-white border-1 rounded-0 rounded-bottom m-0"> -->
                        <a href="#" class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <!-- <img class="rounded-circle" src="public_admin/img/user-default.png" alt="" style="width: 40px; height: 40px;">
                                <div class="ms-2">
                                    <h6 class="fw-normal mb-0">hello everyone</h6>
                                    <small>15 phút trước</small>
                                </div> -->
                            </div>
                        </a>
                        <!-- <hr class="dropdown-divider"> -->

                        <!-- <a href="#" class="dropdown-item text-center">Xem tất cả</a> -->
                        <!-- </div> -->
                    </div>
                    <div class="nav-item dropdown">
                        <!-- <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> -->
                        <!-- <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Thông báo</span> -->
                        <!-- </a> -->
                        <!-- <div class="dropdown-menu dropdown-menu-end bg-white border-1 rounded-0 rounded-bottom m-0"> -->
                        <!-- <a href="#" class="dropdown-item"> -->
                        <!-- <h6 class="fw-normal mb-0">1 Đơn hàng mới</h6>
                                <small>10:20 20-11-2023</small> -->
                        <!-- </a> -->
                        <!-- <hr class="dropdown-divider"> -->

                        <!-- <a href="#" class="dropdown-item text-center">Xem tất cả</a> -->
                        <!-- </div> -->
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="public_admin/img/user-default.png" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">Tài khoản quản lý</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-white border-1 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">Hồ sơ</a>
                            <a href="dang-xuat" class="dropdown-item">Đăng xuất</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Content start -->