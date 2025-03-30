<?php
require_once "./config/Database.php";
class CartModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function select_all_carts($user_id)
    {
        $sql = "SELECT * FROM carts WHERE user_id = $user_id ORDER BY cart_id DESC";

        return $this->db->query($sql);
    }

    public function select_cart_by_id($product_id, $user_id)
    {
        $sql = "SELECT * FROM carts WHERE product_id = $product_id AND user_id = $user_id";

        return $this->db->queryOne($sql);
    }

    public function select_mini_carts($user_id, $limit)
    {
        $sql = "SELECT * FROM carts WHERE user_id = $user_id ORDER BY cart_id DESC LIMIT $limit";

        return $this->db->query($sql);
    }

    public function count_cart($user_id)
    {
        $sql = "SELECT cart_id FROM carts WHERE user_id = $user_id";

        return $this->db->query($sql);
    }

    public function insert_cart($product_id, $user_id, $product_name, $product_price, $product_quantity, $product_image)
    {
        $sql = "INSERT INTO carts 
           (product_id, user_id, product_name, product_price, product_quantity, product_image)
            VALUES (?,?,?,?,?,?)";

        $this->db->execute($sql, $product_id, $user_id, $product_name, $product_price, $product_quantity, $product_image);
    }

    public function update_cart($product_qty, $product_id, $user_id)
    {
        $sql = "UPDATE carts SET 
            product_quantity = $product_qty 
            WHERE product_id = $product_id AND user_id = $user_id";

        $this->db->execute($sql);
    }

    public function delete_product_in_cart($product_id, $user_id)
    {
        $sql = "DELETE FROM carts WHERE product_id = ? AND user_id = ?";
        $this->db->execute($sql, $product_id, $user_id);
    }

    public function delete_cart_by_id($cart_id)
    {
        $sql = "DELETE FROM carts WHERE cart_id = ?";
        $this->db->execute($sql, $cart_id);
    }
}

$CartModel = new CartModel();
