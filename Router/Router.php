<?php

class Router
{
    private $routes = [];

    function get($uri, $action)
    {
        $this->routes[$uri] = [
            'method' => 'GET',
            'action' => $action
        ];
    }

    function post($uri, $action)
    {
        $this->routes[$uri] = [
            'method' => 'POST',
            'action' => $action
        ];
    }

    function put($uri, $action)
    {
        $this->routes[$uri] = [
            'method' => 'PUT',
            'action' => $action
        ];
    }

    function delete($uri, $action)
    {
        $this->routes[$uri] = [
            'method' => 'DELETE',
            'action' => $action
        ];
    }

    public function dispatch()
    {
        $request_method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // safer parse
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        foreach ($this->routes as $routeUri => $route) {
            if ($uri === $routeUri && $request_method === $route['method']) {
                $action = $route['action'];
                $controllerName = $action[0];
                $methodName = $action[1];

                // Before using the controller, require its file
                $controllerPath = __DIR__ . '/../Controllers/' . $controllerName . '.php';
                if (file_exists($controllerPath)) {
                    require_once $controllerPath;
                } else {
                    http_response_code(500);
                    echo "Controller file not found: $controllerPath";
                    exit;
                }

                $controller = new $controllerName();
                
                if (!method_exists($controller, $methodName)) {
                    http_response_code(500);
                    echo "Method $methodName not found in controller $controllerName.";
                    exit;
                }

                $controller->$methodName($id);
                exit;
            }
        }

        // If no route matches
        http_response_code(404);
        require_once __DIR__ . '/../views/errors/404.php'; // safer path
    }
}
