<?php


spl_autoload_register(function ($class) {
    // $file = __DIR__ . '/src/' . str_replace('\\', '/', $class) . '.php';
    $file = srcPath(str_replace('\\', '/', $class) . '.php');
    d($file);
    if (file_exists($file)) {
        require $file;
    }
});