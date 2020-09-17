<?php

    require_once("base/BaseModel.php");

    class UserModel extends BaseModel {

        private $id;
        private $username;

        public function __construct($id) {

            parent::__construct();

            $this->db->query("SELECT * FROM users WHERE id=" . $id);
        }

        public static function doLogin($username, $password) {

            echo "Sto facendo il login...";
        }

        public function getUsername() {

            return $this->username;
        }

        public function getID() {

            return $this->id;
        }
    }