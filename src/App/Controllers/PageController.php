<?php
namespace App\Controllers;  

use Framework\BaseController;
use Framework\View;


class PageController extends BaseController {


    public function __construct()
    {
        parent::__construct();
  
    }
    public function index() {
        
        return $this->render("Page/index", ['title' => 'Home']);
    }

    public function notFound() {
        return notFound();
        // http_response_code(404);
        // return $this->render("Page/not-found", ['title' => '404 - Not Found']);
    }   
}