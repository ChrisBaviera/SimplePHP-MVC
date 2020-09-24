<?php

    namespace App\Controllers;

    use App\Models\Base\BaseModel as Model;
    use App\Views\Base\BaseView as View;

    class Base extends Base\BaseController {

        public function __construct() {

            parent::__construct();
        }

        public function index() {

            View::getView("index");

            echo "<p>Hello, World!</p>";
        }
    }