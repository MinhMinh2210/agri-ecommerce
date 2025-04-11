<?php

?>

<!-- Form Start -->
<div class="container-fluid pt-4">
    <form class="row g-4" action="" method="post" enctype="multipart/form-data">

        <div class="col-sm-12 col-xl-9">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">
                    <a href="products" class="link-not-hover text-success">Sản phẩm</a>
                    / Cập nhật sản phẩm
                </h6>
                <?= $html_alert ?>

                <!-- Product Name -->
                <label for="floatingInput">Tên sản phẩm</label>
                <div class="form-floating mb-3">
                    <input type="text" name="name" value="<?= $name ?>" class="form-control" id="floatingInput" placeholder="Tên sản phẩm">
                    <span class="text-danger"><?= $error['name'] ?></span>
                </div>

                <!-- Price -->
                <label for="floatingInput">Giá bán thường (đ)</label>
                <div class="form-floating mb-3">
                    <input type="number" name="price" value="<?= $price ?>" class="form-control" id="floatingInput" placeholder="Giá bán thường (đ)">
                    <span class="text-danger"><?= $error['price'] ?></span>
                </div>

                <!-- Sale Price -->
                <label for="floatingInput">Giá khuyến mãi (đ)</label>
                <div class="form-floating mb-3">
                    <input type="number" name="sale_price" value="<?= $sale_price ?>" class="form-control" id="floatingInput" placeholder="Giá khuyến mãi (đ)">
                    <span class="text-danger"><?= $error['sale_price'] ?></span>
                </div>

                <!-- Quantity -->
                <label for="floatingInput">Số lượng (nhập số)</label>
                <div class="form-floating mb-3">
                    <input type="number" value="<?= $quantity ?>" name="quantity" class="form-control" id="floatingInput" placeholder="Số lượng">
                    <span class="text-danger"><?= $error['quantity'] ?></span>
                </div>

                <!-- Short Description -->
                <label for="text-dark">Mô tả ngắn</label>
                <div class="form-floating mb-3">
                    <textarea name="short_description" class="form-control" placeholder="Mô tả ngắn" id="short_description"><?= $short_description ?></textarea>
                </div>

                <!-- Product Details -->
                <label for="floatingTextarea">Chi tiết sản phẩm</label>
                <div class="form-floating">
                    <textarea name="details" class="form-control" placeholder="Mô tả" id="product_details" style="height: 300px;"><?= $details ?></textarea>
                </div>

            </div>
        </div>

        <!-- Image and Category -->
        <div class="col-sm-12 col-xl-3">
            <div class="bg-light rounded h-100 p-4">
                <!-- Image Upload -->
                <div class="mb-3">
                    <label for="formFileSm" class="form-label">Hình ảnh (JPG, PNG)</label>
                    <input style="background-color: #fff" class="form-control form-control-sm" name="image" id="formFileSm" type="file">
                    <div class="my-2">
                        <img src="../upload/<?= $image ?>" style="width: 100%;" class="img-fluid" alt="">
                    </div>
                </div>

                <!-- Category Dropdown -->
                <div class="form-floating mb-3">
                    <select name="category_id" class="form-select" id="floatingSelect" required>
                        <?php
                        foreach ($list_categories as $cate) {
                            extract($cate);
                            $selected = ($category_id == $product['category_id']) ? 'selected' : '';
                            echo "<option value='$category_id' $selected>$name</option>";
                        }
                        ?>
                    </select>
                    <label for="floatingSelect">Chọn danh mục</label>
                </div>

                <!-- Buttons -->
                <h6 class="mb-4">
                    <input name="update_product" type="submit" value="Cập nhật" class="btn btn-success w-100">
                    <a href="recycle-product&xoatam=<?= $product_id ?>" class="btn btn-danger w-100 mt-2">Xóa tạm</a>
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