<?php

namespace App\Http\Controllers\Admin;

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
        return view('superAdmin.index', [
            'user' => 'sss',
        ]);
    }

}
