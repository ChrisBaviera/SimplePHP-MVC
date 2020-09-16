<?php

    class Application {

        //Please set your url here!
        const BASE_URL          = "http://localhost/example/";

        const VIEWS_PATH        = "core/views/";
        const MODELS_PATH       = "core/models/";
        const CONTROLLERS_PATH  = "core/controllers/";

        private $controller;
        private $method;

        public function __construct() {
            
            //Sanitize GET vars or set default values
            $this->controller = isset($_GET['controller']) ? htmlspecialchars(ucfirst($_GET['controller'])) : "MainController";
            $this->method = isset($_GET['method']) ? htmlspecialchars($_GET['method']) : "index";

            require_once(Application::CONTROLLERS_PATH . "MainController.php");
            
            if(method_exists($this->controller, $this->method))
                call_user_func_array($this->controller . "::" . $this->method, array());
            else
                call_user_func_array("MainController::err404", array()); 
        }
    }

?>