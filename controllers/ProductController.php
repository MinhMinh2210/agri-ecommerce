<?php
require_once "models/ProductModel.php";
require_once "models/CategoryModel.php";
require_once "models/CommentModel.php";

class ProductController
{
    private $ProductModel;
    private $CategoryModel;
    private $CommentModel;

    public function __construct()
    {
        $this->ProductModel = new ProductModel();
        $this->CategoryModel = new CategoryModel();
        $this->CommentModel = new CommentModel();
    }

    public function index()
    {

        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $list_products = $this->ProductModel->select_list_products($page, 9);
        $list_categories = $this->CategoryModel->select_all_categories();

        // Phân trang
        $qty_product = $this->ProductModel->count_products();
        $totalProducts = count($qty_product);
        $productsPerPage = 9;
        $numberOfPages = ceil($totalProducts / $productsPerPage);
        $currentPage = $page;

        require_once "views/shop.php";
    }

    public function getByCategory()
    {


        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $category_id = $_GET['id'];
            $list_products = $this->ProductModel->select_products_by_cate($category_id);
        } else {
            header("Location: index.php");
        }

        $list_catgories = $this->CategoryModel->select_all_categories();

        require_once "views/shop-by-category.php";
    }

    public function detail()
    {
        if (isset($_GET['id_sp'])) {
            $id_sp = $_GET['id_sp'];
            $id_danhmuc = $_GET['id_dm'];

            $product_details = $this->ProductModel->update_views($id_sp);

            $product_details = $this->ProductModel->select_products_by_id($id_sp);
            $similar_product = $this->ProductModel->select_products_similar($id_danhmuc);
            $name_catgoty = $this->CategoryModel->select_name_categories();
        }
        extract($product_details);
        $discount_percentage = $this->ProductModel->discount_percentage($price, $sale_price);

        $list_comments = $this->CommentModel->select_comments_by_id($product_id);
        require_once "views/productdetail.php";
    }

    public function search()
    {
        $list_products = '';
        // Sản phẩm theo tên
        if (isset($_GET['query']) && !empty($_GET['query'])) {
            $query = trim($_GET['query']);
            $list_products = $this->ProductModel->search_products($query);
        }

        // Sản phẩm theo giá
        if (isset($_GET['from_price']) && isset($_GET['to_price'])) {
            $from_price = $_GET['from_price'];
            $to_price = $_GET['to_price'];

            $list_products = $this->ProductModel->search_products_by_price($from_price, $to_price);
        }

        // Giá cao và thấp nhất của sản phẩm
        $min_max_price = $this->ProductModel->get_min_max_prices();

        $list_catgories = $this->CategoryModel->select_all_categories();
        require_once "views/search.php";
    }
}
