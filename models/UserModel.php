<?php
require_once "./config/Database.php";
    class UserModel {
        private $db;

        public function __construct()
        {
            $this->db = new Database(); 
        }
        public function select_users() {
            $sql = "SELECT username, full_name, email, phone FROM users";

            return $this->db->query($sql);
        }

        public function select_email_in_users($email) {
            $sql = "SELECT * FROM users WHERE email = ?";

            return $this->db->queryOne($sql, $email);
        }

        public function user_insert($username, $password, $full_name, $image, $email, $phone, $address) {
            $sql = "INSERT INTO users(username, password, full_name, image, email, phone, address) VALUES(?,?,?,?,?,?,?)";

            $this->db->execute($sql, $username, $password, $full_name, $image, $email, $phone, $address);
        }

        public function get_user_by_username($username) {
            $sql = "SELECT * FROM users WHERE username = ?";

            return $this->db->query($sql, $username);
        }

        public function update_password($new_password, $user_id) {
            $sql = "UPDATE users SET password = ? WHERE user_id = ?";

            $this->db->execute($sql, $new_password, $user_id);
        }

        public function reset_password($new_password, $email) {
            $sql = "UPDATE users SET password = ? WHERE email = ?";

            $this->db->execute($sql, $new_password, $email);
        }

        public function update_user($full_name, $address, $phone, $image, $user_id) {
            $sql = "UPDATE users SET 
            full_name = '".$full_name."',";

            if ($image != '') {
                $sql .= " image = '".$image."',";
            }
    
            $sql .= " address = '".$address."', phone = '".$phone."'
                    WHERE user_id = ".$user_id;

            

            $this->db->execute($sql);
        }
    }

    $UserModel = new UserModel();
?>