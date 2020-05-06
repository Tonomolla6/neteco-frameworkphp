<?php
  function loadModel($model_path, $model_name, $function, $data = ""){
        $model = $model_path . $model_name . '.class.singleton.php';
        $db = db::getInstance();

        if (file_exists($model)) {
            include_once($model);
            $modelClass = $model_name;

            if (!method_exists($modelClass, $function)){
                throw new Exception();
            }

            $obj = $modelClass::getInstance();
            if (empty($data))
                return call_user_func(array($obj, $function),$db);
            else
                return call_user_func(array($obj, $function),$db,$data);
        } else {
            throw new Exception();
        }
    }

    function loadView($rutaVista = '', $templateName = '') {
        require_once VIEW_PATH_INC . "head.php";
        require_once VIEW_PATH_INC . "menu.php";
        $count = 0;

        for ($t=0; $t < count($templateName); $t++) { 
            $view_path = SITE_ROOT . $rutaVista . $templateName[$t];
            if (file_exists($view_path))
                $count++;
        }
        
        if ($count == count($templateName)) {
            for ($t=0; $t < count($templateName); $t++)
                include_once SITE_ROOT . $rutaVista . $templateName[$t];
        } else
            errorView();

        require_once VIEW_PATH_INC . "footer.html";
    }

    function errorView() {
        require_once VIEW_PATH_INC . "head.php";
        require_once VIEW_PATH_INC . "menu.php";
        require_once VIEW_PATH_INC . "404.php";
        require_once VIEW_PATH_INC . "footer.html";
    }
