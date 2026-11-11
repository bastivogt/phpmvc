<?php

namespace App\Services; 
use App; 

class AuthService {

    public static function authenticate($username, $password) {
        // Implement authentication logic here
    }

    public static function check() {
        // Implement logic to check if the user is authenticated
    }

    public static function getUser() {
        // Implement logic to get the currently authenticated user
        return App::$currentUser;
    }

    public static function logout() {
        // Implement logic to log out the currently authenticated user
    }


}