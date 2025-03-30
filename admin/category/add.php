<!-- Form Start -->
<div class="container-fluid pt-4" style="margin-bottom: 110px;">

    <form class="row g-4" action="" method="post" enctype="multipart/form-data">

        <div class="col-sm-12 col-xl-9">

            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">
                    <a href="index.php?quanli=danh-sach-danh-muc" class="link-not-hover text-success">Danh mục</a>
                    / Thêm danh mục
                </h6>
                <?= $html_alert ?>
                <label for="floatingInput">Tên danh mục</label>
                <div class="form-floating mb-4">
                    <input name="name" type="text" class="form-control" id="floatingInput">
                    <span class="text-danger"><?= $error['name'] ?></span>
                </div>

                <label for="floatingSelect">Trạng thái</label>
                <div class="form-floating mb-3">
                    <select name="status" class="form-select" id="floatingSelect"
                        aria-label="Floating label select example">
                        <option selected value="1">Hiển thị</option>
                        <option value="0">Tạm ẩn</option>
                    </select>

                </div>

            </div>
        </div>
        <div class="col-sm-12 col-xl-3">
            <div class="bg-light rounded h-100 p-4">
                <div class="mb-3">
                    <label for="formFileSm" class="form-label">Hình ảnh (JPG, PNG)</label><br>
                    <span class="text-danger"><?= $error['image'] ?></span>
                    <input style="background-color: #fff" name="image" class="form-control form-control-sm"
                        id="formFileSm" type="file">
                    <!-- <div class="my-2">
                        <img src="./img/book-1.jpg" width="100%" class="img-thumbnail" alt="">
                    </div> -->
                </div>
                <h6 class="mb-4">
                    <input type="submit" name="add_category" value="Đăng" class="btn btn-custom text-success">

                </h6>

            </div>
        </div>




    </form>
</div>
<!-- Form End -->