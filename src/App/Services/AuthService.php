<?php

namespace App\Services; 
use App; 
use App\Models\UserModel;

class AuthService {
    private $userModel;

    function __construct(UserModel $userModel) {
        $this->userModel = $userModel;
        // Initialize the AuthService if needed
    }

    public function authenticate($username, $password) {
        // Implement authentication logic here
    }

    public function check() {
        // Implement logic to check if the user is authenticated
    }

    public function getUser() {
        // Implement logic to get the currently authenticated user
        return App::$currentUser;
    }

    public function logout() {
        // Implement logic to log out the currently authenticated user
    }


}