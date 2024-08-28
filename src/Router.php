<?php namespace App;

class Router {

    private static array $routes = [];

    private static function addRoute(string $method, string $route, $controller, string $action, array $middlewares){
        self::$routes[] = [
            "method" => $method,
            "route" => $route,
            "controller" => $controller,
            "action" => $action,
            "middlewares" => $middlewares,
        ];
    }

    public static function get(string $route, string $controller, string $action, array $middlewares = []){
        self::addRoute("GET", $route, $controller, $action, $middlewares);
    }
    public static function post(string $route, string $controller, string $action, array $middlewares = []){
        self::addRoute("POST", $route, $controller, $action, $middlewares);

    }
    public static function put(string $route, string $controller, string $action, array $middlewares = []){
        self::addRoute("PUT", $route, $controller, $action, $middlewares);

    }
    public static function delete(string $route, string $controller, string $action, array $middlewares = []){
        self::addRoute("DELETE", $route, $controller, $action, $middlewares);
    }

    public static function dispatch(){
        $path = "/";
        if( isset($_SERVER['PATH_INFO']) ) {
            $path = $_SERVER["PATH_INFO"];
        }

        $method = $_SERVER["REQUEST_METHOD"];

        foreach(self::$routes as $route) {
            $pattern = "#^" . $route['route'] . "$#";
            if( preg_match($pattern, $path, $matches) && $method == $route["method"]) {
                $controller = new $route["controller"];
                $action = $route["action"];

                foreach ($route["middlewares"] as $middleware) {
                    $instance = new $middleware;
                    $instance->before();
                }
                
                array_shift($matches);
                call_user_func_array([$controller, $action], $matches);
                return;
            }
        }

        http_response_code(404);
        echo "No route found for URI: " . $path;
    }
}
