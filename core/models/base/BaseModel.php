<?php

    class BaseModel {

        protected $db;

        public function __construct() {

            $db = new PDO("mysql:host=".Application::DB_HOST.";dbname=".Application::DB_NAME, Application::DB_USER, Application::DB_PASS);
        }

        public function query($string) {

            $this->db->query($string);
        }
    }

?>