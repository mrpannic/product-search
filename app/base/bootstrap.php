<?php

define('APP_PATH',   "app/");
define('BASE_PATH', APP_PATH . "base/");
define('CONTROLLERS_PATH', APP_PATH . "controllers/");
define('BASE_CLASSES_PATH', BASE_PATH . "classes/");
define('VIEWS_PATH', APP_PATH . "views/");
define('SERVICES_PATH', APP_PATH . "services/");


function classAutoload($className) {
    $classFilepaths = [BASE_CLASSES_PATH, CONTROLLERS_PATH, SERVICES_PATH];
    foreach($classFilepaths as $classFilepath) {
        $filePath = $classFilepath . $className . ".php";
        if(file_exists($filePath)) {
            require_once $filePath;
            break;
        }
    }
}

spl_autoload_register('classAutoload');

require_once('helpers.php');
require_once('app/routes.php');
require_once('app/config/database.php');
require_once('app/config/item-search-config.php');