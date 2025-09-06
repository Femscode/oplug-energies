<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index() {
        return view('frontend.index');
    }
    public function shop() {
        return view('frontend.shop');
    }
    public function productDetails() {
        return view('frontend.product-details');
    }
    public function cart() {
        return view('frontend.cart');
    }
    public function checkout() {
        return view('frontend.checkout');
    }
    public function about() {
        return view('frontend.about-us');
    }
    public function contact() {
        return view('frontend.contact-us');
    }
}
