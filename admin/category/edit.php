<!-- Form Start -->
<div class="container-fluid pt-4" style="margin-bottom: 110px;">

    <form class="row g-4" action="" method="post" enctype="multipart/form-data">

        <div class="col-sm-12 col-xl-9">

            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">
                    <a href="index.php?quanli=danh-sach-danh-muc" class="link-not-hover text-success">Danh mục</a>
                    / Cập nhật danh mục
                </h6>
                <?= $html_alert ?>
                <label for="floatingInput">Tên danh mục</label>
                <div class="form-floating mb-4">
                    <input name="name" type="text" value="<?= $name ?>" class="form-control" id="floatingInput">
                    <span class="text-danger"><?= $error['name'] ?></span>
                </div>

                <label for="floatingSelect">Trạng thái</label>
                <div class="form-floating mb-3">
                    <select name="status" class="form-select" id="floatingSelect">
                        <?php if ($status == 1) { ?>
                            <option selected value="1">Hiển thị</option>
                            <option value="0">Tạm ẩn</option>
                        <?php } else { ?>
                            <option value="1">Hiển thị</option>
                            <option selected value="0">Tạm ẩn</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-xl-3">
            <div class="bg-light rounded h-100 p-4">
                <div class="mb-3">
                    <label for="formFileSm" class="form-label">Hình ảnh (JPG, PNG)</label> <br>
                    <span class="text-danger"><?= $error['image'] ?></span>
                    <input style="background-color: #fff" name="image" class="form-control form-control-sm" id="formFileSm" type="file">
                    <div class="my-2">
                        <img src="../upload/<?= $image ?>" width="100%" class="img-thumbnail" alt="Ảnh danh mục">
                    </div>
                </div>
                <h6 class="mb-4">
                    <button type="submit" name="update_category" class="btn btn-success w-100">Cập nhật</button>
                </h6>
            </div>
        </div>

    </form>
</div>
<!-- Form End -->