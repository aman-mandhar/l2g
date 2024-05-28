<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Http\Requests\StoreItemRequest; // Example form request
use App\Http\Requests\UpdateItemRequest; // Example form request
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    
    
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function search(Request $request)
    {
        $search = $request->get('search');
        $users = User::orwhere('name', 'like', '%' .$search. '%')
        ->orwhere('mobile_number', 'like', '%'.$search.'%')
        ->orwhere('ref_mobile_number', 'like', '%'.$search.'%')
        ->orwhere('email', 'like', '%'.$search.'%')->get();
        return view('users.show', ['users' => $users],);
    }

    public function create()
    {
        $users = User::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|numeric|digits:10|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile_number' => $request->mobile_number,
            'user_role' => 2,
        ]);
        $user->save();
            // You can redirect the user wherever you want after creation
            return redirect()->route('users.create')->with('success', 'User created successfully!');
        }
   

    

    public function edit($user)
    {
        $user = User::find($user);
        return view('users.role', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|numeric|digits:10|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Update the user
        $user = User::findOrFail($id); // Find user of id = $id
        $user->update($validatedData);

        // You can redirect the user wherever you want after updation
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    public function destroy($user)
    {
        $user = User::find($user);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }

    
}
