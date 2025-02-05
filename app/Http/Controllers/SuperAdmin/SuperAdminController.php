<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SuperAdminController extends Controller
{
    //
        /**
     * Display the home page for supper admin.
     */
    public function index(Request $request): View
    {
        return view('superadmin.index', [
            'user' => 'sss',
        ]);
    }

}
