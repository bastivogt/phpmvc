<?php

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

