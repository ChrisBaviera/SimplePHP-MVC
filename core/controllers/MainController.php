<?php

    require_once("base/BaseController.php");

    class MainController extends BaseController {

        public function __construct() {

            parent::__construct();
        }

        public function index() {

            parent::getView("main");
        }

        public function login() {

            require_once("core/models/UserModel.php");
            UserModel::doLogin("Prova", "test");
        }
    }

?>