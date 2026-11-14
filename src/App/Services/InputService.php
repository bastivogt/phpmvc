<?php
namespace App\Services;

use Framework\Session;

// check if working with session inputs correctly
class InputService {

    public static function set(array $data): void
    {
        Session::set("inputs", $data);  
    }

    public static function get(string $key, $default = null): mixed
    {
        $inputs = Session::get("inputs");
        $result = $inputs[$key] ?? $default;
        unset($inputs[$key]);
        Session::set("inputs", $inputs);
        return $result;
    }

}