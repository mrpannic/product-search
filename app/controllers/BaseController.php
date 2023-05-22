<?php

class BaseController {
    public static $db = null;


    public function __construct() {
        if(!self::$db)
            self::$db = new Database();
        
        $this->checkIfAuthorized();
    }

    public function redirect($location) {
        header("Location: " . $location);
    }

    private function checkIfAuthorized() {
        $allowedUnauthorizedRoutes = ['/login', '/register'];
        $token = getCookie('token');
        $route = Route::currentRoute();

        $id = false;
        if($token)
            $id = self::$db->executePrepared("SELECT user_id FROM tokens WHERE token = ?", [$token]);

        if(!$id && !in_array($route, $allowedUnauthorizedRoutes)) 
            $this->redirect('/login');
    }
}