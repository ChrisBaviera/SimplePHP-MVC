<?php

    namespace App\Controllers;

    use App\Models\Base\BaseModel as Model;

    class Base extends Base\BaseController {

        public function __construct() {

            parent::__construct();
        }

        public function index() {

            echo "<p>Hello, World!</p>";
        }
    }