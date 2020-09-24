<?php

    namespace App\Views\Base;

    use App\Globals;

    class BaseView {

        private function __construct() {

            //This class cannot be instantiated
        }

        public static function getView(string $view, array $args = array(), bool $template = true, string $lang = null) {

            foreach($args as $key => $val)
                $$key = $val;

                //Language array
                require_once("application/languages/" . $lang == null ? Globals::DEFAULT_LANGUAGE : $lang . ".php");

                //Page
                if($template)   require_once("application/views/templates/" . Globals::DEFAULT_TEMPLATE . "/header.php");
                                require_once("application/views/pages/" . $view . ".php");
                if($template)   require_once("application/views/templates/" . Globals::DEFAULT_TEMPLATE . "/footerc.php");
        }
    }
?>