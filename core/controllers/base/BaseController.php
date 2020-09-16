<?php

    class BaseController {

        public function __construct() {


        }

        protected function getView($view, $template = true) {

            if($template)   include(Application::VIEWS_PATH . "template/header.php");
                            include(Application::VIEWS_PATH . "pages/" . $view . ".php");
            if($template)   include(Application::VIEWS_PATH . "template/footer.php");
        }
    }

?>