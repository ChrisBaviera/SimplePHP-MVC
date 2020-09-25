<?php

    namespace App\Views\Base;

use App\Application;
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
         * @param boolean $logged Check if login needed
         * @param string $lang The language
         * @param boolean $template True if using the default template
         * @param string $templateName The template to use
         * @return void 
         */
        public static function getView(string $view, array $args = array(), bool $logged = false, string $lang = null, bool $template = true, string $templateName = null) {

            //Page arguments
            foreach($args as $key => $val)
                $$key = $val;

            //Language
            $selectedLang = $lang == null ? (isset($_GET['lang']) ? htmlspecialchars($_GET['lang']) : Globals::DEFAULT_LANGUAGE) : $lang;
            $langPath = "application/languages/" . $selectedLang . ".php";

            //Login Check
            if($logged && !isset($_SESSION['id']))
                header("Location: " . Globals::BASE_URL . $selectedLang . "/" . Globals::ERROR_URL . "errLoginRequired");

            file_exists($langPath) ? require_once($langPath) : require_once("application/languages/" . Globals::DEFAULT_LANGUAGE . ".php"); 
            
            //Page
            if($template)   require_once("application/views/templates/" . Globals::DEFAULT_TEMPLATE . "/header.php");
                            require_once("application/views/pages/" . $view . ".php");
            if($template)   require_once("application/views/templates/" . Globals::DEFAULT_TEMPLATE . "/footer.php");
        }

        public static function getLanguages() {

            $files = scandir("application/languages/");

            for($i=2; $i<count($files); $i++) {

                $lang = explode(".", $files[$i]);
                echo "<a href='" . Globals::BASE_URL . strtolower($lang[0]) . "'><img style='width: 20px; height: 20px; margin: 5px;' src='" . Globals::BASE_URL . Globals::IMAGES . "flags/" . $lang[0] . ".png'></a>";
            }
        }
    }
?>