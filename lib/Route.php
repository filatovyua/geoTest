<?php
class Route{
       
    public static function Start(){
        
        $method = $_SERVER['REQUEST_METHOD'];
        $action = "index";
        $routes = explode('/', $_SERVER['REQUEST_URI']);        
        if (!empty($routes[1])) {
            $action = explode("?", $routes[1])[0];
        }
        if (!method_exists('Controller', $action)){
            self::ErrorPage404();
        }
        try {
            Factory::Controller($method)->$action(); 
        } catch (Exception $ex) {
            echo json_encode(["success"=>0, "message"=>$ex->getMessage()]);
        }
    }   
    
    public static function ErrorPage404(){
        //http_response_code(404);
        include 'views/template_404.php';
        die();
    }
    
}
