<?php

class Route {
    private static $routes = [
        'get' => [],
        'post' => [],
        'patch' => [],
        'put' => [],
        'delete' => [],
        'options' => [],
        'head' => [],
    ];
    private static $availableMethods = ['get', 'post', 'patch', 'put', 'delete', 'options', 'head'];

    const ROUTE_URL = 0;
    const ROUTE_ACTION = 1;

    const ROUTE_ACTION_CONTROLLER = 0;
    const ROUTE_ACTION_HANDLER = 1;

    public static function getRoute() {
        
        $requestUri = self::currentRoute();
        $requestMethod = strtolower($_SERVER['REQUEST_METHOD']);

        if(isset($_POST['_method'])) {
            $requestMethod = $_POST['_method'];
        }

        if(array_key_exists($requestUri, self::$routes[$requestMethod]))
            return self::$routes[$requestMethod][$requestUri];
        
       include 'app/views/404.php';
    }

    public static function __callStatic($name, $arguments)
    {
        self::checkIfAvailableRequestMethod($name);
        $handlerController = $arguments[self::ROUTE_ACTION];

        if(!$handlerController)
            sendResponse(['message' => "Please provide a [controller, method] handlers", 'error' => true]);

        self::checkExistance($name, $arguments[self::ROUTE_URL], $handlerController[self::ROUTE_ACTION_HANDLER]);
        self::addRoute($name, $arguments[self::ROUTE_URL], 
            $handlerController[self::ROUTE_ACTION_CONTROLLER], $handlerController[self::ROUTE_ACTION_HANDLER]);
    }

    private static function checkIfAvailableRequestMethod($methodName) {
         $isSupported = in_array($methodName, self::$availableMethods);
         if(!$isSupported)
            return sendResponse(['message' => "Undefined $methodName request routing method", "error" => true]);
    }

    private static function checkExistance($requestMethod, $routeName) {
        if(array_key_exists($routeName, self::$routes[$requestMethod]))
            return sendResponse(['message' => "Request method $requestMethod for $routeName has already been added", 'error' => true]);
    }

    private static function addRoute($routeMethod, $routeName, $controller, $handler) {
        self::$routes[$routeMethod][$routeName] = $controller ? [$controller, $handler] : $handler; 
    }

    public static function currentRoute() {
        return explode('?', $_SERVER['REQUEST_URI'])[0];
    }
}