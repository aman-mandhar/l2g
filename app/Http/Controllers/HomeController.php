<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('/login');
    }

    public function admindashboard()
    {
        return view('layouts.panels.admin_panel.main');
    }

    public function vendordashboard()
    {
        return view('layouts.panels.vendor_panel.main');
    }

    public function admin()
    {
        return view('layouts.panels.user_panel.main');
    }


}
