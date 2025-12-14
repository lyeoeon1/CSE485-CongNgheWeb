<?php
class Router {
    private $routes = [];
    
    public function get($pattern, $callback) {
        $this->addRoute('GET', $pattern, $callback);
    }
    
    public function post($pattern, $callback) {
        $this->addRoute('POST', $pattern, $callback);
    }
    
    private function addRoute($method, $pattern, $callback) {
        $this->routes[] = [
            'method' => $method,
            'pattern' => $pattern,
            'callback' => $callback
        ];
    }
    
    public function dispatch() {
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        
        // Remove base path if exists
        $basePath = '/cse485/BTTH2';
        if (strpos($requestUri, $basePath) === 0) {
            $requestUri = substr($requestUri, strlen($basePath));
        }
        
        if (empty($requestUri)) {
            $requestUri = '/';
        }
        
        foreach ($this->routes as $route) {
            if ($route['method'] !== $requestMethod) {
                continue;
            }
            
            $pattern = '#^' . $route['pattern'] . '$#';
            if (preg_match($pattern, $requestUri, $matches)) {
                array_shift($matches); // Remove full match
                $this->callAction($route['callback'], $matches);
                return;
            }
        }
        
        // 404 Not Found
        http_response_code(404);
        echo "404 - Page Not Found";
    }
    
    private function callAction($callback, $params = []) {
        if (is_string($callback)) {
            list($controller, $method) = explode('@', $callback);
            $controllerInstance = new $controller();
            call_user_func_array([$controllerInstance, $method], $params);
        }
    }
}
?>