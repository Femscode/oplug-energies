<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
      public function index() {
        return view('admin.index');
    }
    public function orders() {
        return view('admin.orders');
    }
    public function products() {
        return view('admin.products');
    }
    public function add_product() {
        return view('admin.add-product');
    }
    public function settings() {
        return view('admin.settings');
    }
    public function changePassword() {
        return view('admin.change-password');
    }
}
