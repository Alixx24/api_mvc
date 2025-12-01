<?php

namespace Application\Core;

class Router
{
    private $routes = [];

    public function add(string $method, string $path, callable $handler): void
    {
        $method = strtoupper($method);
        $this->routes[$method][$path] = $handler;
    }

   public function dispatch(string $method, string $path): void
{
    $method = strtoupper($method);
    if (isset($this->routes[$method][$path])) {
        $handler = $this->routes[$method][$path];
        call_user_func($handler);
    } else {
        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Route not found']);
        exit;
    }
}

}
