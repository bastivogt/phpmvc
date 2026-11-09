<?php
namespace App\Controllers;  


class PageController {
    public function index() {
        
        d("PageController index called");
        return view("Page/index", ['title' => 'Home']);
    }

    public function notFound() {
        return notFound();
    }   
}