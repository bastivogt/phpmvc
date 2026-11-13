<?php
namespace App\Services;

use Exception;
use Framework\Session;

class CSRFService {
    public static function generateToken() {
        if (!isset($_SESSION)) {
            session_start();
        }
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrfToken'] = $token;
        return $token;
    }

    public static function validateToken($token) {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['csrfToken']) && hash_equals($_SESSION['csrfToken'], $token)) {
            unset($_SESSION['csrfToken']);
            return true;
        }
        return false;
    }

    public static function getToken() {
        if (!isset($_SESSION)) {
            session_start();
            
        }
        return $_SESSION['csrfToken'] ?? null;
    }

    public static function getTokenInputField() {
        $token = self::getToken();
        return '<input type="hidden" name="csrfToken" value="' . htmlspecialchars($token) . '">';
    }
}