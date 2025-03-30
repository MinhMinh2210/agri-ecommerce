
<!-- Form Start -->
<div class="container-fluid pt-4">
    <form class="row g-4" action="" method="post" enctype="multipart/form-data">

        <div class="col-sm-12 col-xl-9">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">
                    <a href="index.php?quanli=danh-sach-san-pham" class="link-not-hover text-success">Sản phẩm</a>
                    / Thêm sản phẩm
                </h6>
                <?= $html_alert ?>
                <label for="floatingInput">Tên sản phẩm</label>
                <div class="form-floating mb-3">
                    <input type="text" name="name" value="<?= $temp['name'] ?>" class="form-control" id="floatingInput" placeholder="Tên sản phẩm">
                    <span class="text-danger"><?= $error['name'] ?></span>
                </div>

                <label for="floatingInput">Giá bán thường (đ)</label>
                <div class="form-floating mb-3">
                    <input type="number" name="price" value="<?= $temp['price'] ?>" class="form-control" id="floatingInput" placeholder="Giá bán thường (đ)">
                    <span class="text-danger"><?= $error['price'] ?></span>
                </div>

                <label for="floatingInput">Giá khuyến mãi (đ)</label>
                <div class="form-floating mb-3">
                    <input type="number" name="sale_price" value="<?= $temp['sale_price'] ?>" class="form-control" id="floatingInput" placeholder="Giá khuyến mãi (đ)">
                    <span class="text-danger"><?= $error['sale_price'] ?></span>
                </div>

                <label for="floatingInput">Số lượng (nhập số)</label>
                <div class="form-floating mb-3">
                    <input type="number" value="<?= $temp['quantity'] ?>" name="quantity" class="form-control" id="floatingInput" placeholder="Số lượng">
                    <span class="text-danger"><?= $error['quantity'] ?></span>
                </div>

                <label for="text-dark">Mô tả ngắn</label>
                <div class="form-floating mb-3">
                    <textarea name="short_description" class="form-control" placeholder="Mô tả ngắn" id="short_description"><?= $temp['short_description'] ?></textarea>
                </div>

                <label for="floatingTextarea">Chi tiết sản phẩm</label>
                <div class="form-floating">
                    <textarea name="details" class="form-control" placeholder="Mô tả" id="product_details" style="height: 300px;"><?= $temp['details'] ?></textarea>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-xl-3">
            <div class="bg-light rounded h-100 p-4">
                <div class="mb-3">
                    <label for="formFileSm" class="form-label">Hình ảnh (JPG, PNG)</label>
                    <input style="background-color: #fff" class="form-control form-control-sm" name="image" id="formFileSm" type="file">
                    <div class="my-2">
                        <?php if (!empty($image)) : ?>
                            <img src="../upload/<?= $image ?>" style="width: 100%;" class="img-fluid" alt="Product Image">
                        <?php else : ?>
                            <!-- <img src="./img/testimonial-1.jpg" style="width: 100%;" class="img-fluid" alt="Product Placeholder"> -->
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <select name="category_id" class="form-select" id="floatingSelect" required>
                        <?php foreach ($list_categories as $value) : ?>
                            <option value="<?= $value['category_id'] ?>"><?= $value['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <label for="floatingSelect">Chọn danh mục</label>
                </div>

                <h6 class="mb-4">
                    <input name="themsanpham" type="submit" value="Đăng" class="btn btn-success w-100">
                </h6>
            </div>
        </div>
    </form>
</div>
<!-- Form End -->

<style>
    .ck-editor__editable[role="textbox"]:first-child {
        min-height: 300px;
    }

    .ck-content .image {
        max-width: 80%;
        margin: 20px auto;
    }
</style>