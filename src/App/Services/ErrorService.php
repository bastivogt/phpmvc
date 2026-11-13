<?php
namespace App\Services;

use Framework\Session;

class ErrorService
{
    public static function setErrors(array $errors)
    {
        Session::set('errors', $errors);
    }

    public static function getErrors(): array
    {
        $errors = Session::get('errors');
        Session::set('errors', []);
        return $errors;
    }

    public static function hasErrors(): bool
    {
        $errors = Session::get('errors');
        return !empty($errors);
    }
}