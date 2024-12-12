<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VendorHomeController extends Controller
{
    //
        /**
     * Display the home page for supper admin.
     */
    public function index(Request $request): View
    {
        return view('vendor.index', [
            'user' => 'sss',
        ]);
    }

}
