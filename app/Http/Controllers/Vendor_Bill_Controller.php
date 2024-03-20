<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor_Bill_Model;

class Vendor_Bill_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendorbill=Vendor_Bill_Model::with('leatherpurchase')->get();
        $data=compact('vendorbill');
        return view('vendor_bill.view')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vendorbill=Vendor_Bill_Model::with('leatherpurchase')->find($id);
        $data=compact('vendorbill');
        return view('vendor_bill.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
