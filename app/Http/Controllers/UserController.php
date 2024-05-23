<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use App\Models\City;
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
        $users = User::with('user_role')->get();
        $cities = City::all();  
        $roles = UserRole::all();
        return view('users.index', compact('users', 'roles', 'cities'));
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

    public function getReferralName(Request $request)
    {
    $referralMobileNumber = $request->input('referralMobileNumber');
    $referralUser = User::where('mobile_number', $referralMobileNumber)->first();

    return response()->json(['name' => $referralUser ? $referralUser->name : null]);

    }

    public function getReferralId(Request $request)
{
    $referralMobileNumber = $request->input('referralMobileNumber');
    
    // Query the User model by mobile_number column
    $referralUser = User::where('mobile_number', $referralMobileNumber)->first();

    return response()->json(['id' => $referralUser ? $referralUser->id : null]);
}

    public function create()
    {
        $users = User::all();
        $cities = City::all();  
        $roles = UserRole::all();
        return view('users.create', compact('roles'), compact('cities'), compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|numeric|digits:10|unique:users',
            'ref_mobile_number' => 'required|numeric|digits:10',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'user_role' => 'required|exists:user_roles,id',
            'city' => 'required|string|max:255',
            'gst_no' => 'nullable|string|max:255',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile_number' => $request->mobile_number,
            'ref_mobile_number' => $request->ref_mobile_number,
            'city' => $request->city,
            'user_role' => $request->user_role,
            'gst_no' => $request->gst_no,
        ]);
        $user->save();

    
            // You can redirect the user wherever you want after creation
            return redirect()->route('users.create')->with('success', 'User created successfully!');
        }
   

    

    public function edit($user)
    {
        $user = User::find($user);
        $cities = City::all();
        $roles = UserRole::all();
        return view('users.role', compact('user', 'roles', 'cities'));
    }

    public function update(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'mobile_number' => 'required|integer|unique:users,mobile_number,'.$id,
            'user_role' => 'required|exists:user_roles,id',
            'city' => 'required|string|max:255',
            'gst_no' => 'nullable|string|max:255',
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
