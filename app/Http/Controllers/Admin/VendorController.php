<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;

use Illuminate\Support\Facades\Hash;
class VendorController extends Controller
{
    /**
     * Display a listing of the vendors.
     */
    public function index()
    {
        $vendors = Vendor::all(); // Fetch all vendors
        return view('superAdmin.vendors.index', compact('vendors')); // Pass to a view
    }

    /**
     * Show the form for creating a new vendor.
     */
    public function create()
    {
        return view('superAdmin.vendors.create'); // Return the create form
    }

    /**
     * Store a newly created vendor in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'name'        => 'required|string|max:255',
            'last'        => 'required|string|max:255',
            'address'     => 'required|string|max:255',
            'address2'    => 'nullable|string|max:255',
            'city'        => 'required|string|max:255',
            'pin'         => 'required|numeric',
            'company'     => 'required|string|max:255',
            'country'     => 'required|string|max:255',
            'mobile'      => 'required|numeric|digits_between:10,15',
            'alt_mobile'  => 'nullable|numeric|digits_between:10,15',
            'email'       => 'required|email|unique:vendors,email',
            'subdomain'   => 'required|string|max:255',
            'domain'      => 'required|string|max:255',
            'facebook'    => 'nullable|url',
            'twitter'     => 'nullable|url',
            'insta'       => 'nullable|url',
            'linkedin'    => 'nullable|url',
            'password'    => 'required|string|min:8|confirmed', // Include confirmation for passwords
        ]);
    
        // Handle file upload if exists
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public'); // Save to `storage/app/public/logos`
        }
    
        // Save data to database
        $vendor = Vendor::create([
            'logo'            => $logoPath,
            'name'            => $request->name,
            'last'            => $request->last,
            'address'         => $request->address,
            'address2'        => $request->address2,
            'city'            => $request->city,
            'pin'             => $request->pin,
            'company'         => $request->company,
            'country'         => $request->country,
            'mobile'          => $request->mobile,
            'alt_mobile'      => $request->alt_mobile,
            'email'           => $request->email,
            'subdomain'       => $request->subdomain,
            'domain'          => $request->domain,
            'status'          => 1, // Default status
            'facebook'        => $request->facebook,
            'twitter'         => $request->twitter,
            'insta'           => $request->insta,
            'linkedin'        => $request->linkedin,
            'email_verified_at' => null, // Adjust if verification is required
            'password'        => Hash::make($request->password),
        ]);

        return redirect()->route('vendors.index')->with('success', 'Vendor created successfully!');
    }

    /**
     * Display the specified vendor.
     */
    public function show(Vendor $vendor)
    {
        return view('superAdmin.vendors.show', compact('vendor')); // Return a detailed view
    }

    /**
     * Show the form for editing the specified vendor.
     */
    public function edit(Vendor $vendor)
    {
        return view('superAdmin.vendors.edit', compact('vendor')); // Return the edit form
    }

    /**
     * Update the specified vendor in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:vendors,email,' . $vendor->id,
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string',
        ]);

        // Update the vendor
        $vendor->update($request->all());

        return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully!');
    }

    /**
     * Remove the specified vendor from storage.
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete(); // Delete the vendor
        return redirect()->route('vendors.index')->with('success', 'Vendor deleted successfully!');
    }
}
