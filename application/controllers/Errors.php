<?php

    namespace App\Controllers;

    class Errors extends Base\BaseController {

        public function __construct() {

            parent::__construct();
        }

        public function err404() {

            echo "Pagina di errore 404";
        }

        public function errLoginRequired() {

            echo "Pagina di errore Login:<br>Eseguire il login per continuare";
        }

        public function errLoginIncorrectForm() {

            echo "Pagina di errore Login:<br>Form non riconosciuto";
        }

        public function errLoginIncorrectData() {

            echo "Pagina di errore Login:<br>Username o Password errati";
        }
    }