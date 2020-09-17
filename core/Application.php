<?php

    class Application {

        //Please set your url here!
        const BASE_URL          = "http://localhost/example/";

        const VIEWS_PATH        = "core/views/";
        const MODELS_PATH       = "core/models/";
        const CONTROLLERS_PATH  = "core/controllers/";

        const ERRORS_CONTROLLER = "Errors";
        const ERR404_ROUTE      = "Errors::err404";

        const DB_HOST = "localhost";
        const DB_NAME = "simple_php_mvc";
        const DB_USER = "root";
        const DB_PASS = "";

        private $controller;
        private $method;

        public function __construct() {

            //Require Errors Handler
            require_once(self::CONTROLLERS_PATH . self::ERRORS_CONTROLLER . ".php");
            
            //Sanitize GET vars or set default values
            $this->controller = isset($_GET['controller']) ? htmlspecialchars(ucfirst($_GET['controller'])) : "MainController";
            $this->method = isset($_GET['method']) ? htmlspecialchars($_GET['method']) : "index";

            if(file_exists(self::CONTROLLERS_PATH . $this->controller . ".php")) {

                require_once(self::CONTROLLERS_PATH . $this->controller . ".php");
            
                if(method_exists($this->controller, $this->method)) 
                    call_user_func_array($this->controller . "::" . $this->method, array());
                else 
                    call_user_func_array(self::ERR404_ROUTE, array());

            }
            else call_user_func_array(self::ERR404_ROUTE, array());
        }
    }

?>