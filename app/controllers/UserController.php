<?php

class UserController extends BaseController {
    public function index() {
        $sql = "SELECT id, username, first_name, last_name FROM users";
        $users = self::$db->execute($sql, true);
        view('users', compact('users'));
    }

    public function edit() {
        $id = Request::get('id');
        $sql = "SELECT id, username, first_name, last_name FROM users WHERE id = ?";
        $user = self::$db->executePrepared($sql, [$id]);
        view('update-user', compact('user'));
    }

    public function create() {
        view('create-user');
    }

    public function store() {
        $data = Request::only(['username', 'password', 'first_name', 'last_name']);
        
        $sql = "SELECT id from users where username = ?";
        $id = self::$db->executePrepared($sql, [$data['username']]);

        if($id) {
            view('invalid-action', [
                'action_short' => 'User exists',
                'action' => 'Username already taken',
                'description' => 'Sorry, but the username you have entered is already taken',
                'route_name' => 'user creation page',
                'redirect_url' => '/users/create'
            ]);
            return;
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, first_name, last_name) values (?, ?, ?, ?)";
        self::$db->executePrepared($sql, array_values(array_values($data)));
        $this->redirect('/users');
    }

    public function update() {
        $data = Request::only(['username', 'password', 'first_name', 'last_name', 'id']);
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET 
            username = ?, 
            password = ?, 
            first_name = ?, 
            last_name = ?
            WHERE id = ?";

        self::$db->executePrepared($sql, array_values($data));
    }

    public function delete() {
        $id = Request::get('id');
        $sql = "DELETE FROM users WHERE id = ?";
        self::$db->executePrepared($sql, [$id]);
    }
}