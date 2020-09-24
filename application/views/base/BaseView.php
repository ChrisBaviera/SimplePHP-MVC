<?php

    namespace App\Views\Base;

    use App\Globals;

    class BaseView {

        private function __construct() {

            //This class cannot be instantiated
        }

        public static function getView(string $view, array $args = array(), string $lang = null, bool $template = true) {

            //Page arguments
            foreach($args as $key => $val)
                $$key = $val;

            //Language
            $langPath = $lang == null ? (isset($_GET['lang']) ? htmlspecialchars($_GET['lang']) : Globals::DEFAULT_LANGUAGE) : $lang;
            
            if(file_exists("application/languages/" .$langPath . ".php")) require_once("application/languages/" . $langPath . ".php");
            else require_once("application/languages/" . Globals::DEFAULT_LANGUAGE . ".php"); 
            
            //Page
            if($template)   require_once("application/views/templates/" . Globals::DEFAULT_TEMPLATE . "/header.php");
                            require_once("application/views/pages/" . $view . ".php");
            if($template)   require_once("application/views/templates/" . Globals::DEFAULT_TEMPLATE . "/footer.php");
        }
    }
?>