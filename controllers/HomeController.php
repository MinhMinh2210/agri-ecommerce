<?php
require_once "models/ProductModel.php";
require_once "models/CategoryModel.php";

class HomeController {
    private $ProductModel;
    private $CategoryModel;

    public function __construct() {
        $this->ProductModel = new ProductModel();
        $this->CategoryModel = new CategoryModel();
    }
    public function index() {
        $this->ProductModel = new ProductModel();
        $this->CategoryModel = new CategoryModel();

        $listProducts = $this->ProductModel->select_products_limit(8);
        $listCategories = $this->CategoryModel->select_categories_limit(8);
        
        require_once "views/home.php";
    }
}
?>
