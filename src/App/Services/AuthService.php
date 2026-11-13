<?php

namespace App\Services; 
use App; 
use App\Models\UserModel;
use Framework\Session;

class AuthService {
    private $userModel;

    function __construct(UserModel $userModel) {
        $this->userModel = $userModel;
        
    }

    public function authenticate($email, $password) {
        $isAuthenticated = $this->userModel->authenticate($email, $password);
        if ($isAuthenticated) {
            $user = $this->userModel->findOneByEmail($email);
            Session::set('currentUserID', $user->id);
        }
        return $isAuthenticated;
    }

    public function isAuthenticated() {
        return Session::has('currentUserID');
    }

    public function getCurrentUser() {
        // Implement logic to get the currently authenticated user
        return $this->userModel->findOne(Session::get('currentUserID'));
    }



    public function logout() {
        // Implement logic to log out the currently authenticated user
        Session::remove('currentUserID');
    }


}