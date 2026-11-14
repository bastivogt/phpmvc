<?php
namespace App\Services;

use Framework\Session;
use Framework\FlashMessage;

class FlashService
{
    public static function setFlash(FlashMessage $message)
    {
        Session::set('flash', $message);
    }

    public static function getFlash(): ?FlashMessage
    {
        $message = Session::get('flash');
        Session::remove('flash');
        return $message;
    }

    public static function hasFlash(): bool
    {
        $message = Session::get('flash');
        return !empty($message);
    }
}