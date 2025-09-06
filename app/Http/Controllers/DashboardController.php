<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
   
    public function index() {
        return view('user.index');
    }
    public function order() {
        return view('user.order');
    }
    public function changePassword() {
        return view('user.change-password');
    }
}
