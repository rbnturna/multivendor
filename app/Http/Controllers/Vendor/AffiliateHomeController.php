<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AffiliateHomeController extends Controller
{
    //
        /**
     * Display the home page for supper admin.
     */
    public function index(Request $request): View
    {
        return view('vendor.affiliate.index', [
            'user' => 'sss',
        ]);
    }
}
