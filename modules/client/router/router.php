<?php
    ob_start();
    session_start();

    function handlerRouter() {
        // Comprobamos el modulo por post y por get.
        if (!empty($_POST['module']))
            $URI_module = $_POST['module'];
        else {
            if (!empty($_GET['module']))
                $URI_module = $_GET['module'];
            else
                $URI_module = 'home';
        }

        // Comprobamos la funcion por post y por get.
        if (!empty($_POST['function']))
            $URI_function = $_POST['function'];
        else {
            if (!empty($_GET['function']))
                $URI_function = $_GET['function'];
            else
                $URI_function = false;
        }
        handlerModule($URI_module, $URI_function);
    }

    function handlerModule($URI_module, $URI_function) {
        // Importamos los modulos.
        $modules = simplexml_load_file(RESOURCES.'modules.xml');
        $exist = false;
        
        // Comprobamos que existen.
        foreach ($modules->module as $module) {
            if ($URI_module == $module->uri) {
                $exist = true;
                $NAME_module = $module->name;

                $path = MODULES_PATH . $NAME_module . "/controller/controller_" . $NAME_module . ".class.php";
                if (file_exists($path)) {
                    require_once $path;
                    $controllerClass = "controller_" . $NAME_module;
                    $obj = new $controllerClass;
                } else
                    errorView();

                handlerfunction($NAME_module, $obj, $URI_function);
                break;
            }
        }
        if (!$exist)
            errorView();
    }

    function handlerfunction($NAME_module, $obj, $URI_function) {

        // Comprobamos que tiene funcion o no.
        if (!empty($URI_function)) {
            // Importamos las funciones del modulo.
            $functions = simplexml_load_file(MODULES_PATH . $uri_module . "/resources/function.xml");
            $exist = false;

            foreach ($functions->function as $function) {
                if (($URI_function === (String) $function->uri)) {
                    $exist = true;
                    $event = (String) $function->name;
                    break;
                }
            }

            if (!$exist)
                errorView();
            else
                call_user_func(array($obj, $event));
        } else
            call_user_func(array($obj, "view"));
    }

    handlerRouter();