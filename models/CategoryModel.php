<?php
require_once "./config/Database.php";
class CategoryModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    
    public function select_categories_limit($limit)
    {
        $sql = "SELECT * FROM categories WHERE status = 1 AND category_id > 1  ORDER BY category_id ASC LIMIT $limit";

        return $this->db->query($sql);
    }

    public function select_all_categories()
    {
        $sql = "SELECT * FROM categories ORDER BY category_id";

        return $this->db->query($sql);
    }

    public function select_name_categories()
    {
        $sql = "SELECT category_id, name FROM categories";

        return $this->db->query($sql);
    }
}

$CategoryModel = new CategoryModel();
