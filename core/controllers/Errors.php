<?php   

    require_once("base/BaseController.php");

    class Errors extends BaseController {

        public function __construct() {

            parent::__construct();
        }

        public function err404() {

            parent::getView("errors/404", false);
        }
    }