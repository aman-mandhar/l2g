<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Shop;
use App\Models\User;

class ShopController extends Controller
{
    // Get all vendors

    public function index()
    {
        $shops = Shop::all();
        return view('vendors.index', compact('vendors'));
    }

    // Create a new vendor

    public function create()
    {
        return view('shops.create');
    }
    
    public function createnew(Request $request)
    {
        $user = User::where('mobile_number', $request->mobile_number)->first();
        return view('shops.create-new', compact('user'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'add' => 'required',
            'shop_name' => 'required',
            'mobile_no' => 'required',
            'email' => 'required',
            'gst_no' => 'required',
            'aadhar_no' => 'nullable',
            'pan_no' => 'nullable',
            'msme_no' => 'nullable',
            'upi_id' => 'nullable',
            'bank_name' => 'nullable',
            'branch_name' => 'nullable',
            'ifsc_code' => 'nullable',
            'account_no' => 'nullable',
            'account_holder_name' => 'nullable',
            'account_type' => 'nullable',
            'aadhar_front' => 'nullable',
            'aadhar_back' => 'nullable',
            'pan_card' => 'nullable',
            'gst_certificate' => 'nullable',
            'msme_certificate' => 'nullable',
            'cancel_cheque' => 'nullable',
            'photo' => 'nullable'
        ]);

        $shop = new Shop();
        $shop->user_id = $request->user_id;
        $shop->add = $request->add;
        $shop->shop_name = $request->shop_name;
        $shop->mobile_no = $request->mobile_no;
        $shop->email = $request->email;
        $shop->aadhar_no = $request->aadhar_no;
        $shop->pan_no = $request->pan_no;
        $shop->gst_no = $request->gst_no;
        $shop->msme_no = $request->msme_no;
        $shop->upi_id = $request->upi_id;
        $shop->bank_name = $request->bank_name;
        $shop->branch_name = $request->branch_name;
        $shop->ifsc_code = $request->ifsc_code;
        $shop->account_no = $request->account_no;
        $shop->account_holder_name = $request->account_holder_name;
        $shop->account_type = $request->account_type;
        $shop->aadhar_front = $request->aadhar_front;
        $shop->aadhar_back = $request->aadhar_back;
        $shop->pan_card = $request->pan_card;
        $shop->gst_certificate = $request->gst_certificate;
        $shop->msme_certificate = $request->msme_certificate;
        $shop->cancel_cheque = $request->cancel_cheque;
        $shop->photo = $request->photo;
        $shop->save();

        return redirect()->route('admindashboard')
            ->with('success', 'Vendor created successfully.');
    }

    // Show a vendor

    public function show(Shop $shop)
    {
        return view('shops.show', compact('shop'));
    }

    // Edit a vendor

    
    // Delete a vendor

    public function destroy(Shop $shop)
    {
        $shop->delete();

        return redirect()->route('shops.index')
            ->with('success', 'Vendor deleted successfully');
    }

    // Get all vendors of a user

    public function userVendors(User $user)
    {
        $shops = Shop::where('user_id', $user->id)->get();
        return view('shops.index', compact('shops'));
    }
}
