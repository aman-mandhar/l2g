<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\User;

use Illuminate\Http\Request;

class VendorController extends Controller
{
    // Get all vendors

    public function index()
    {
        $vendors = Vendor::all();
        return view('vendors.index', compact('vendors'));
    }

    // Create a new vendor

    public function create()
    {
        return view('vendors.create');
    }
    
    public function createnew(Request $request)
    {
        $user = User::where('mobile_number', $request->mobile_number)->first();
        return view('vendors.create-new', compact('user'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'add' => 'required',
            'vendor_name' => 'required',
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

        $vendor = new Vendor();
        $vendor->user_id = $request->user_id;
        $vendor->add = $request->add;
        $vendor->vendor_name = $request->vendor_name;
        $vendor->mobile_no = $request->mobile_no;
        $vendor->email = $request->email;
        $vendor->aadhar_no = $request->aadhar_no;
        $vendor->pan_no = $request->pan_no;
        $vendor->gst_no = $request->gst_no;
        $vendor->msme_no = $request->msme_no;
        $vendor->upi_id = $request->upi_id;
        $vendor->bank_name = $request->bank_name;
        $vendor->branch_name = $request->branch_name;
        $vendor->ifsc_code = $request->ifsc_code;
        $vendor->account_no = $request->account_no;
        $vendor->account_holder_name = $request->account_holder_name;
        $vendor->account_type = $request->account_type;
        $vendor->aadhar_front = $request->aadhar_front;
        $vendor->aadhar_back = $request->aadhar_back;
        $vendor->pan_card = $request->pan_card;
        $vendor->gst_certificate = $request->gst_certificate;
        $vendor->msme_certificate = $request->msme_certificate;
        $vendor->cancel_cheque = $request->cancel_cheque;
        $vendor->photo = $request->photo;
        $vendor->save();

        // update user role in user table
        $user = User::find($request->user_id)
            ->update(['user_role' => 10]);


        return redirect()->route('vendors.index')
            ->with('success', 'Vendor created successfully.');
    }

    // Show a vendor

    public function show(Vendor $vendor)
    {
        return view('vendors.show', compact('vendor'));
    }

    // Edit a vendor

    public function edit(Vendor $vendor)
    {
        return view('vendors.edit', compact('vendor'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'ref_id' => 'required|exists:users,id',
            'add' => 'required',
            'city' => 'required',
            'vendor_name' => 'required',
            'mobile_no' => 'required',
            'email' => 'required',
            'aadhar_no' => 'nullable',
            'pan_no' => 'nullable',
            'gst_no' => 'nullable',
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

        $vendor->update($request->all());

        return redirect()->route('vendors.index')
            ->with('success', 'Vendor updated successfully');
    }

    // Delete a vendor

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();

        return redirect()->route('vendors.index')
            ->with('success', 'Vendor deleted successfully');
    }

    // Get all vendors of a user

    public function userVendors(User $user)
    {
        $vendors = Vendor::where('user_id', $user->id)->get();
        return view('vendors.index', compact('vendors'));
    }
}
