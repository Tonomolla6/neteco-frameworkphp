<?php
class login_dao {
    static $_instance;

    private function __construct() {

    }

    public static function getInstance() {
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function login($db,$data) {
        $sql = "SELECT * FROM login WHERE email = '".$data."'";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function slider_img_change($db,$data) {
        $sql = "SELECT * FROM background_img WHERE id = ".$data[0];
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function slider_subcategoria($db) {
        $sql = "SELECT * FROM subcategories ORDER BY clicks DESC LIMIT 5";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function slider_products($db) {
        $sql = "SELECT * FROM products ORDER BY clicks DESC LIMIT 5";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function update_clicks($db,$data) {
        $sql = "UPDATE " . $data[1] . "SET clicks = (clicks + 1) WHERE id = " .$data[1];
        return $db->ejecutar($sql);
    }

    public function insert_user($db, $data) {
        $sql = "INSERT INTO login (name, email, password, avatar, salary, type) VALUES ('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."', 1000, 'client')";
        return $db->ejecutar($sql);
    }
}
