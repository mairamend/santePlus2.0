<?php 
class Router {
    private $routes = [] ;
    public function add($url,$controller,$method){
        $this->routes[$url] = [
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function run() {
        $urlDemandee = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if(array_key_exists($urlDemandee,$this->routes)){
            $route = $this->routes[$urlDemandee];
            $controllerName = $route['controller'];
            $methodName = $route['method'];
            // On intancie le controller et on appelle la méthode

            if(class_exists($controllerName)){
                $controller = new $controllerName;
                if(method_exists($controller,$methodName)){
                    return $controller->$methodName();
                }
            }
        }
        http_response_code(404);
        echo "<h1>404 - Page non trouvée</h1>";
    }
}