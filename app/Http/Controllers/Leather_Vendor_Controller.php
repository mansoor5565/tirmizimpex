<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leather_Vendor_Model; 

class Leather_Vendor_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leather_vendor=Leather_Vendor_Model::all();
        $data=compact('leather_vendor');
        return view('leather_vendor.view')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("leather_vendor.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name'=>'required',
                'address'=>'required',
                'contact_number'=>'required',      
            ]
            );
        $leather_vendor=new Leather_Vendor_Model;
        $leather_vendor->name=$request['name'];
        $leather_vendor->address=$request['address'];
        $leather_vendor->contact_number=$request['contact_number'];
        $leather_vendor->save();
        $submitSuccess = true;
        return redirect('/leather_vendor')->with('submitSuccess', $submitSuccess);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $leather_vendor=Leather_Vendor_Model::find($id);
        $data=compact("leather_vendor");
        return view("leather_vendor.show")->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $leather_vendor=Leather_Vendor_Model::find($id);
        if(is_null($leather_vendor)){
            return redirect('/leather_vendor');
        }
        else{
             $url=url('/leather_vendor/update').'/'.$id;
            $data=compact('leather_vendor','url');
            return view('leather_vendor.edit')->with($data);
        }
    }

    
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name'=>'required',
                'address'=>'required',
                'contact_number'=>'required',      
            ]
            );
        $leather_vendor=Leather_Vendor_Model::find($id);
        $leather_vendor->name = $request->input('name'); 
        $leather_vendor->address = $request->input('address'); 
        $leather_vendor->contact_number = $request->input('contact_number'); 
        $leather_vendor->save();
        $updateSuccess = true;
        return redirect('/leather_vendor')->with('updateSuccess', $updateSuccess);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $leather_vendor=Leather_Vendor_Model::find($id);
        if (!is_null($leather_vendor)) {
            $DeleteSuccess = true;
            $leather_vendor->delete();
        }
        return redirect('/leather_vendor')->with('DeleteSuccess', $DeleteSuccess);

    }
}
