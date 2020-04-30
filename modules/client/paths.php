<?php
    define('ROOT', '/framework-php/');

    //MODULE
    define('PROJECT', ROOT . 'modules/'.$_SESSION["type"].'/');

    //SITE_ROOT
    define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'] . PROJECT);
    
    //SITE_PATH
    define('SITE_PATH', 'http://' . $_SERVER['HTTP_HOST'] . PROJECT);

    //TRANSLATE
    define('TRANSLATE', 'http://' . $_SERVER['HTTP_HOST'] . PROJECT);

    //CSS
    define('CSS_PATH', SITE_PATH . 'view/css/');
    
    //JS
    define('JS_PATH', SITE_PATH . 'view/js/');
    
    //LIBRARIES
    define('LIBRARIES_PATH', SITE_PATH . 'view/libraries/');
    
    //IMG
    define('IMG_PATH', SITE_PATH . 'view/img/');
    
    //PRODUCTION
    define('PRODUCTION', true);
    
    //MODEL
    define('MODEL_PATH', SITE_ROOT . 'model/');
    
    //MODULES
    define('MODULES_PATH', SITE_ROOT . 'modules/');
    
    //VIEW
    define('VIEW_PATH_INC', SITE_ROOT . 'view/inc/');
    
    //RESOURCES
    define('RESOURCES', SITE_ROOT . 'resources/');
    
    //MEDIA
    define('MEDIA_PATH',SITE_ROOT . '/media/');
    
    //UTILS
    define('UTILS', SITE_ROOT . 'utils/');

    //MODULES
    $modules = simplexml_load_file(RESOURCES.'modules.xml');
    $define_name = array('UTILS_','MODEL_PATH_','DAO_','BLL_','MODEL_','JS_VIEW_');
    $define_path = array('utils/','model/','DAO/','BLL/','model/','view/js/');

    foreach ($modules->module as $module) {
        $module = $module->uri;
        for ($d=0; $d < count($define_name); $d++) { 
            define($define_name[$d].strtoupper($module), SITE_ROOT . 'modules/'.strtolower($module).$define_path[$d]);
        }
    }

    //FRIENDLY
    define('URL_AMIGABLES', TRUE);
