<?php
  function loadModel($model_path, $model_name, $function, $arrArgument = '',$arrArgument2 = ''){
        $model = $model_path . $model_name . '.class.singleton.php';
        
        if (file_exists($model)) {
            include_once($model);
            $modelClass = $model_name;

            if (!method_exists($modelClass, $function)){
                throw new Exception();
            }

            $obj = $modelClass::getInstance();
            if (isset($arrArgument)){
                if (isset($arrArgument2)) {
                    //return $obj->$function($arrArgument,$arrArgument2);
                    return call_user_func(array($obj, $function),$arrArgument,$arrArgument2);
                }
                //return $obj->$function($arrArgument);
                return call_user_func(array($obj, $function),$arrArgument);
            }   
            
        } else {
            throw new Exception();
        }
    }

    function loadView($rutaVista = '', $templateName = '') {
        $view_path = SITE_ROOT . $rutaVista . $templateName;

        require_once VIEW_PATH_INC . "head.php";
        require_once VIEW_PATH_INC . "menu.php";
        if (file_exists($view_path)) {
            include_once(SITE_ROOT . $rutaVista . "head.php");
            include_once($view_path);
            require_once VIEW_PATH_INC . "footer.html";
        } else
            errorView();
    }

    function errorView() {
        require_once VIEW_PATH_INC . "404.php";
        require_once VIEW_PATH_INC . "footer.html";
    }
