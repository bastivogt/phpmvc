<?php
namespace Framework;

class Router {
    private $routes = [];

    public function addRoute($method,$pattern, $callback) {
        $this->routes[] = [
            'method' => $method,
            'pattern' => $pattern,
            'callback' => $callback
        ];
    }

    public function get($pattern, $callback) {
        $this->addRoute('GET', $pattern, $callback);
    }   

    public function post($pattern, $callback) {
        $this->addRoute('POST', $pattern, $callback);
    }

    public function put($pattern, $callback) {
        $this->addRoute('PUT', $pattern, $callback);
    }

    public function delete($pattern, $callback) {
        $this->addRoute('DELETE', $pattern, $callback);
    }


    public function dispatch($method,$url) {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($route['pattern'], $url, $matches)) {
                $controller = $route['callback'][0];
                $method = $route['callback'][1];
                if(class_exists($controller) && method_exists($controller, $method)) {
                    $controllerInstance = new $controller();
                    $matches = array_filter(
                        $matches,
                        fn($key) => is_string($key),
                        ARRAY_FILTER_USE_KEY
                    );
                    return $controllerInstance->$method(...$matches);
                }
            }
        }
        return null;
    }
}



// class Router {
//     private $routes = [];

//     public function __construct() {
//         $this->routes = [];
//     }

//     public function addRoute($method, $pattern, $callback) {
//         $this->routes[] = [
//             'method' => $method,
//             'pattern' => $pattern,
//             'callback' => $callback
//         ];
//     }

//     public function get($pattern, $callback) {
//         $this->addRoute('GET', $pattern, $callback);
//     }

//     public function post($pattern, $callback) {
//         $this->addRoute('POST', $pattern, $callback);
//     }

//     public function put($pattern, $callback) {
//         $this->addRoute('PUT', $pattern, $callback);
//     }

//     public function delete($pattern, $callback) {
//         $this->addRoute('DELETE', $pattern, $callback);
//     }

//     public function dispatch($url) {
//         foreach ($this->routes as $route) {
//             if (preg_match($route['pattern'], $url, $matches)) {
//                 $matches = array_filter(
//                     $matches,
//                     fn($key) => is_string($key),
//                     ARRAY_FILTER_USE_KEY
//                 );
//                 if(isset($route['callback']) && is_callable($route['callback'])) {
//                     return call_user_func($route['callback'], $matches);
                    
//                 }
//                 $controller = $route['callback'][0];
//                 $method = $route['callback'][1];
//                 if(class_exists($controller) && method_exists($controller, $method)) {
//                     $controllerInstance = new $controller();
//                     return $controllerInstance->$method(...$matches);
//                 }
//             }
//         }
//         return null;
//     }
// }