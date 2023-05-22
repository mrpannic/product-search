<?php

class AuthController extends BaseController {

    public function showLogin() {
        view('login');
    }

    public function login() {
        $credentials = Request::only(['username', 'password']);
        $sql = "SELECT id, password FROM users WHERE username = ?";
        $user = self::$db->executePrepared($sql, [$credentials['username']]);

        if(!$user || !password_verify(Request::get('password'), $user['password'])) {
            view('invalid-action', [
                'action_short' => 'Invalid credentials',
                'action' => 'Username or password mismatch',
                'description' => 'Sorry, you have entered wrong username or password.',
                'route_name' => 'login',
                'redirect_url' => '/login'
            ]);
            return;
        }

        $token= $this->createToken($credentials['username'], $user['id']);
        setcookie("token", $token, 0);
        $this->redirect('users');
    }

    public function showRegister() {
        view('register');
    }

    public function register() {
        $data = Request::only(['username', 'password', 'first_name', 'last_name']);

        $sql = "SELECT id from users where username = ?";
        $id = self::$db->executePrepared($sql, [$data['username']]);
        if($id) {
            view('invalid-action', [
                'action_short' => 'User exists',
                'action' => 'Username already taken',
                'description' => 'Sorry, but the username you have entered is already taken',
                'route_name' => 'registration page',
                'redirect_url' => '/register'
            ]);
            return;
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users (username, password, first_name, last_name) values (?, ?, ?, ?)";
        self::$db->executePrepared($sql, array_values($data));

        $sql = "SELECT id FROM users WHERE username = ?";
        $user = self::$db->executePrepared($sql, [$data['username']]);

        $token = $this->createToken($data['username'], $user['id']);
        setcookie("token", $token);
        $this->redirect('users');
    }

    public function logout() {
        $token = getCookie('token');
        self::$db->executePrepared("DELETE FROM tokens WHERE token = ?", [$token]);
    }

    private function createToken($username, $userId) {
        $token = hash("sha256", $username . time());
        self::$db->executePrepared("INSERT INTO tokens (token, user_id) VALUES (?, ?)", [$token, $userId]);
        return $token;
    }

    public function startPage() {
        $this->redirect('/login');
    }
}