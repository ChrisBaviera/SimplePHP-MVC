<?php

    namespace App;

    class Application {

        public function __construct() {

            $controller = isset($_GET['controller']) ? htmlspecialchars($_GET['controller']) : Globals::DEFAULT_CONTROLLER;
            $method     = isset($_GET['method'])     ? htmlspecialchars($_GET['method'])     : Globals::DEFAULT_METHOD;
            $lang       = isset($_GET['lang'])       ? htmlspecialchars($_GET['lang'])       : Globals::DEFAULT_LANGUAGE;

            $args = array();
            if(isset($_GET['arg'])) 
                $args[] = htmlspecialchars($_GET['arg']);

            $controllerPath = "application/controllers/" . $controller . ".php";
            @include_once($controllerPath);

            if(file_exists($controllerPath) && method_exists("App\Controllers\\" . $controller, $method))
                call_user_func_array("App\Controllers\\" . $controller . "::" . $method, $args);
            else 
                header("Location: " . Globals::ERROR_URL . "err404");
        }
    }
?>