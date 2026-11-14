<?php
namespace App\Controllers;
use Framework\BaseController;
use App\Models\UserModel;
use Framework\Session;
use App\Services\AuthService;
use App\Services\CSRFService;

use App\Services\ErrorService;
use App\Services\FlashService;
use Framework\FlashMessage;

class AuthController extends BaseController
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        parent::__construct();
        $this->authService = $authService;

    }

    public function loginForm()
    {
        if($this->authService->isAuthenticated()) {
            return redirect('/');
        }
        CSRFService::generateToken();
        return $this->render('Auth/login', [
            'title' => 'Login'
        ]);
    }

    public function login()
    {
        
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $csrfToken = $_POST['csrfToken'] ?? '';

        if (!CSRFService::validateToken($csrfToken)) {
            return redirect('/auth/login');

        }

        $isAuthenticated = $this->authService->authenticate($email, $password);
        if ($isAuthenticated) {
            // Set session or cookie for authenticated user
            // FlashService::setFlash(new FlashMessage('Login successful', FlashMessage::$TYPE_SUCCESS));
            // return redirect('/');
            return $this->withFlash(new FlashMessage('Login successful', FlashMessage::$TYPE_SUCCESS))
                ->redirect('/');
        } else {
            // ErrorService::setErrors(['Invalid email or password']);
            // FlashService::setFlash(new FlashMessage('Invalid email or password', FlashMessage::$TYPE_ERROR));
            // return redirect('/auth/login');
            return $this->withErrors(['Invalid email or password'])
                ->withFlash(new FlashMessage('Invalid email or password', FlashMessage::$TYPE_ERROR))
                ->redirect('/auth/login');
        }
    }

    public function logout()
    {
        //FlashService::setFlash(new FlashMessage('Logged out successfully', FlashMessage::$TYPE_SUCCESS));
        $this->authService->logout();
        return $this->withFlash(new FlashMessage('Logged out successfully', FlashMessage::$TYPE_SUCCESS))->redirect('/auth/login');
    }
}