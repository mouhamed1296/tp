<?php
namespace App;

class Router {
    private array $handlers;
    private $notFoundHandler;
    private const GET_METHOD = 'GET';
    private const POST_METHOD = 'POST';
    private const PATH_BASE = "/tp";

    public function get(string $path, $handler): void 
    {
        $this->addHandler($path, self::GET_METHOD, $handler);
    }

    public function post(string $path, $handler):void 
    {
        $this->addHandler($path, self::POST_METHOD, $handler);
    }

    private function addHandler(string $path, string $method, $handler): void
    {
        $this->handlers[$method.$path] = [
            'path' => self::PATH_BASE.$path,
            'method' => $method,
            'handler' => $handler
        ];
    }

    public function addNotFoundHandler($handler) : void
    {
        $this->notFoundHandler = $handler;
    }

    public function run() 
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];
        $method = $_SERVER['REQUEST_METHOD'];

        $callback = null;
        foreach($this->handlers as $handler){
            if ($handler['path'] === $requestPath && $handler['method'] === $method) {
                $callback = $handler['handler'];
            }
        }

        if (is_array($callback)){
            //$parts = explode('::', $callback);
            $classname = array_shift($callback);
            $handler = new $classname;
            $method = array_shift($callback);
            $callback=[$handler, $method];
        }

        if(!$callback){
            header("HTTP/1.0 404 Not Found");
            if(!empty($this->notFoundHandler)){
                $callback = $this->notFoundHandler;
            }
        }

        call_user_func_array($callback, [
            array_merge($_GET, $_POST, $_FILES)
        ]);

        //var_dump($requestPath);
    }
}