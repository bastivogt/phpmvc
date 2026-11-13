<?php
namespace App\Controllers;  

use Framework\BaseController;


class PageController extends BaseController {
    public function index() {
        
        d("PageController index called");
        return $this->render("Page/index", ['title' => 'Home']);
    }

    public function notFound() {
        return notFound();
    }   
}