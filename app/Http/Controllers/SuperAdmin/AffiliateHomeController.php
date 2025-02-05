<?php

namespace App\Http\Controllers\SuperAdmin;

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
        return view('superadmin.affiliate.index', [
            'user' => 'sss',
        ]);
    }
}
