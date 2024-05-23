<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

class DashboardController extends Controller
{
    protected function authenticated()
    {
        if(Auth::user()->user_role == 2)
        {
        return redirect('admin/dashboard')->with('status','Welcome to Dashboard');
        }
        
        else
        {
        return redirect('welcome');
        }
    }

    
    public function index()
    {
        if(Auth::user()->user_role == 2)
        {
        return view('admin/dashboard');
        }
    }
}
