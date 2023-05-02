<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/TrainingController.php';
require_once 'src/controllers/UserDetailsController.php';
require_once 'src/controllers/AdminController.php';
class Routing {
    public static $routes;

    public static function get($url,$controller){
        self::$routes[$url] = $controller;
    }

    public static function post($url,$controller){
        self::$routes[$url] = $controller;
    }

    public static function run($url){
       /* $action= explode("/",$url)[0];
        $param = explode("/",$url)[1];
        
        if(!array_key_exists($action,self::$routes)){
            die("Wrong url");
        }
        
        $controller=self::$routes[$action];
        $object = new $controller;
        $action = $action ?: 'index';
        if($param != null){
            $object->$action($param);
        }
        else {
            $object->$action();
        }*/
        $urlParts = explode("/", $url);
        $action = $urlParts[0];

        if (!array_key_exists($action, self::$routes)) {
            die("Wrong url!");
        }

        $controller = self::$routes[$action];
        $object = new $controller;
        $action = $action ?: 'index';

        $id = $urlParts[1] ?? '';
        $secId = $urlParts[2] ?? '';
        $object->$action($id,$secId);
    }


}

?>