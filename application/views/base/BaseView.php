<?php

    namespace App\Views\Base;

    use App\Globals;

    class BaseView {

        private function __construct() {

            //This class cannot be instantiated
        }

        /**
         * 
         * Get the selected view
         *
         * @param string $view The name of the view
         * @param array $args The variables to be used in the page
         * @param string $lang The language
         * @param boolean $template True if using the default template
         * @return void 
         */
        public static function getView(string $view, array $args = array(), string $lang = null, bool $template = true) {

            //Page arguments
            foreach($args as $key => $val)
                $$key = $val;

            //Language
            $selectedLang = $lang == null ? (isset($_GET['lang']) ? htmlspecialchars($_GET['lang']) : Globals::DEFAULT_LANGUAGE) : $lang;
            $langPath = "application/languages/" . $selectedLang . ".php";

            file_exists($langPath) ? require_once($langPath) : require_once("application/languages/" . Globals::DEFAULT_LANGUAGE . ".php"); 
            
            //Page
            if($template)   require_once("application/views/templates/" . Globals::DEFAULT_TEMPLATE . "/header.php");
                            require_once("application/views/pages/" . $view . ".php");
            if($template)   require_once("application/views/templates/" . Globals::DEFAULT_TEMPLATE . "/footer.php");
        }
    }
?>