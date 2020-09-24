<?php

    namespace App\Controllers;

    class Errors extends Base\BaseController {

        public function __construct() {

            parent::__construct();
        }

        public function err404() {

            echo "Pagina di erroro 404";
        }
    }