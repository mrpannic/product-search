<?php

function handleRequest(){

    try {
        $handler = Route::getRoute();

        if(is_array($handler)) {
            [$controller, $handler] = $handler;
            sendResponse((new $controller)->$handler());
        }

    }
    catch (Exception $e) {
        sendResponse(['message' => $e->getMessage(), 'error' => true]);
    }
}

function sendResponse($data) {
    if(!$data) return '';
    echo json_encode($data);
    exit;
}

function requestBody() {
    parse_str(file_get_contents('php://input'), $vars);
    return $vars;
}

function view($fileName, $data = []) {
    include VIEWS_PATH . "$fileName.php";
}

function getCookie($key) {
    if(isset($_COOKIE[$key]))
        return $_COOKIE[$key];
    
    return null;
}