<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-7 order-2">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="/index.php"><img src="public/img/Logo.png" alt="Logo" style="height: 60px;"></a>
                    </div>
                    <p>Thu Duc City, Ho Chi Minh City</p>
                    <p>+84 353 13 7872</p>

                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-5 order-4">
                <div class="footer__widget">
                    <h6>KHÁM PHÁ</h6>
                    <ul>
                        <li><a href="#">Trang chủ</a></li>
                        <li><a href="#">Cửa hàng</a></li>
                        <li><a href="#">Mua sắm</a></li>
                        <li><a href="#">Giỏ hàng</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 order-4">
                <div class="footer__widget">
                    <h6>DANH MỤC</h6>
                    <ul>
                        <li><a href="#">Rau củ quả</a></li>
                        <li><a href="#">Nông nghiệp</a></li>
                        <li><a href="#">Phương pháp</a></li>
                        <li><a href="#">Vitamin</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-8 col-sm-8 order-1">
                <div class="footer__newslatter">
                    <h6>ĐĂNG KÝ NHẬN ƯU ĐÃI</h6>
                    <form action="#">
                        <input type="text" placeholder="Email hoặc Số điện thoại">
                        <button type="submit" class="site-btn">GỬI</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</footer>
<!-- Footer Section End -->

<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form action="search" method="get" class="search-model-form">
            <input type="search" name="query" id="search-input" placeholder="TÌM KIẾM.....">
        </form>
    </div>
</div>
<!-- Search End -->

<!-- Toatr -->
<script>
    $(document).ready(function() {
        $("#toastr-success-top-right").on("click", function() {
            toastr.success("Đã thêm vào giỏ hàng", "Thành công", {
                closeButton: true,
                debug: false,
                newestOnTop: false,
                progressBar: true,
                positionClass: "toast-top-right",
                preventDuplicates: false,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                timeOut: "5000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut"
            });
        });
    });
</script>

<!-- Js Plugins -->
<script src="public/js/jquery-3.3.1.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<script src="public/js/jquery.magnific-popup.min.js"></script>
<script src="public/js/jquery-ui.min.js"></script>
<script src="public/js/mixitup.min.js"></script>
<script src="public/js/jquery.countdown.min.js"></script>
<script src="public/js/jquery.slicknav.js"></script>
<script src="public/js/owl.carousel.min.js"></script>
<script src="public/js/jquery.nicescroll.min.js"></script>
<script src="public/js/main.js"></script>

<!-- dialogflow -->
<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger
    intent="WELCOME"
    chat-title="NongSanChatbot"
    agent-id="c8356ff6-bb20-44e1-93fe-9e0db7d0ec8b"
    language-code="vi"></df-messenger>

</body>

</html>