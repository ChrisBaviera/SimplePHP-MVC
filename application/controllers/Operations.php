<?php

    namespace App\Controllers;

use App\Globals;
use App\Models\Base\BaseModel as Model;

    class Operations extends Base\BaseController {

        public function __construct() {

            parent::__construct();
        }

        public function doLogin() {

            if(!isset($_POST['username']) || !isset($_POST['password']))
                header("Location: " . Globals::BASE_URL . Globals::DEFAULT_LANGUAGE . "/" . Globals::ERROR_URL . "errLoginIncorrectForm");
                
            //Insert here login processing code according to db
            $_SESSION['id'] = 0;

            //Login SUCCESS
            header("Location: " . Globals::BASE_URL);
        }
    }