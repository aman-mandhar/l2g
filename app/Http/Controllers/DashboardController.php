<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('panels.admin_panel.main');
    }
    public function admin()
   {
       return view('panels.admin_panel.main');
   }
    public function vendor()
    {
         return view('panels.vendor_panel.main');
    }

}         
