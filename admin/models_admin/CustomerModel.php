<?php
require_once "../config/Database.php";

    class CustomerModel {
        private $db;
        public function __construct() {
            $this->db = new Database();
        }
        public function select_users() {
            $sql = "SELECT username, full_name, email, phone FROM users";

            return $this->db->query($sql);
        }

        public function select_all_users() {
            $sql = "SELECT * FROM users ORDER BY user_id DESC";

            return $this->db->query($sql);
        }

        public function user_insert($username, $password, $full_name, $image, $email, $phone, $address, $role) {
            $sql = "INSERT INTO users(username, password, full_name, image, email, phone, address, role) VALUES(?,?,?,?,?,?,?,?)";

            $this->db->execute($sql, $username, $password, $full_name, $image, $email, $phone, $address, $role);
        }

        public function get_user_admin($username) {
            $sql = "SELECT * FROM users WHERE username = ? AND role = 1";

            return $this->db->query($sql, $username);
        }

    }

    $CustomerModel = new CustomerModel();
?>