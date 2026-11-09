<?php

/**
 * Get the base path
 * 
 * @param string $path
 * @return string
 */
function srcPath($path = "")
{
    //return __DIR__ . "/" . $path;
    $bp = dirname(__DIR__) . "/" . $path;
    return $bp;
}


/**
 * Load a view
 * 
 * @param string $name
 * @return void
 */
function view(string $name, array $context = []): void
{
    $file = srcPath("App/Views/$name.view.php");

    if (file_exists($file)) {
        ob_start();
        extract($context);
        require $file;
        $tpl = ob_get_clean();
        echo $tpl;
    } else {
        echo "View '$name' not found";
    }
}

function d(mixed $var) {
    echo '<pre style="background-color: #272727; color: #91ff02; padding: 10px;">';
    var_dump($var);
    echo '</pre>';
}

function dd(mixed $var) {
    d($var);
    die();
}


function esc(string | null $str): string {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

function redirect(string $url) {
    header("Location: $url");
    exit;
}


function back() {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

function currentUrl(): string {
    $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $requestUri = $_SERVER['REQUEST_URI'];
    return "$scheme://$host$requestUri";
}

function previousUrl(): string {
    return $_SERVER['HTTP_REFERER'] ?? '';
}

function notFound() {
    http_response_code(404);
    require 'views/404.php';
    exit;
}

