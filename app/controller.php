<?php

namespace App;
use App\View;

//main class for controller

class Controller {
    function __construct() {
    }

    protected function render($viewPath , $data=[]) {
        View::render($viewPath, $data);
    }
    
}