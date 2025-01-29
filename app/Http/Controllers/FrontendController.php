<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class FrontendController extends Controller{
    public function home (): View
    {
        return view('frontend/home');
    }

    public function product (): View
    {
        return view('frontend/shop');
    }
    public function detail (): View
    {
        return view('frontend/detail');
    }
    public function contact (): View
    {
        return view('frontend/contact');
    }
    public function checkout (): View
    {
        return view('frontend/checkout');
    }
    public function cart (): View
    {
        return view('frontend/cart');
    }
    
    
}
