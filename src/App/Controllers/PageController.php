<?php
namespace App\Controllers;  


class PageController {
    public function index() {
        
        d("PageController index called");
        return view("Page/index");
    }

    public function notFound() {
        http_response_code(404);

        return view("Page/not-found");
    }
}