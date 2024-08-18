<?php namespace App;

class Router {

    private static array $routes = [];

    private static function addRoute(string $method, string $route, $controller, string $action){
        self::$routes[] = [
            "method" => $method,
            "route" => $route,
            "controller" => $controller,
            "action" => $action
        ];
    }

    public static function get(string $route, string $controller, string $action){
        self::addRoute("GET", $route, $controller, $action);
    }
    public static function post(string $route, string $controller, string $action){
        self::addRoute("POST", $route, $controller, $action);

    }
    public static function put(string $route, string $controller, string $action){
        self::addRoute("PUT", $route, $controller, $action);

    }
    public static function delete(string $route, string $controller, string $action){
        self::addRoute("DELETE", $route, $controller, $action);
    }

    public static function dispatch(){
        $path = "/";
        if( isset($_SERVER['PATH_INFO']) ) {
            $path = $_SERVER["PATH_INFO"];
        }

        $method = $_SERVER["REQUEST_METHOD"];

        foreach(self::$routes as $route) {
            $pattern = "#^" . $route['route'] . "$#";
            if( preg_match($pattern, $route['route'], $matches) && $method == $route["method"]) {
                $controller = new $route["controller"];
                $action = $route["action"];
                
                array_shift($matches);
                call_user_func_array([$controller, $action], $matches);
                return;
            }
        }

        http_response_code(404);
        echo "No route found for URI: " . $path;
    }
}