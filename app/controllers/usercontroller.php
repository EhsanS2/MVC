<?php

namespace App\Controllers;
use App\Controller;
use App\User;

class UserController extends Controller{
    public function showAction() {
        dd(new User);
    }
}