<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase_Accessories_Model;
use App\Models\Accessories_Model;

class Purchase_Accessories_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchase_accessories=Purchase_Accessories_Model::with('accessories')->get();
        $data=compact('purchase_accessories');
        return view('purchase_accessories.view')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $accessories=Accessories_Model::all();
        $data=compact('accessories');
        return view('purchase_accessories.create')->with($data);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'accessories'=>'required',
                'accessory_quantities'=>'required',
                'accessory_costs'=>'required'
            ]
        );

        
        foreach ($request->accessories as $key => $accessorieId) {
            $purchase_accessories=new Purchase_Accessories_Model;
            $purchase_accessories->accessories_id = $accessorieId;
            if (isset($request->accessory_quantities[$key])) {
                $purchase_accessories->quantity = $request->accessory_quantities[$key];
            } else {
                $purchase_accessories->quantity = 1; 
            }
            if(isset($request->accessory_costs[$key])){
                $purchase_accessories->cost_per_unit=$request->accessory_costs[$key];
            }
            else{
                $purchase_accessories->cost_per_unit = 1;
            }
            $purchase_accessories->save();
        }
        $submitSuccess = true;

        return redirect('/purchase_accessories')->with('submitSuccess', $submitSuccess);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchase_accessories=Purchase_Accessories_Model::with('accessories')->find($id);
        $data=compact('purchase_accessories');
        return view('purchase_accessories.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $accessories=Accessories_Model::all();
        $purchase_accessories=Purchase_Accessories_Model::find($id);
        if(is_null($purchase_accessories)){
            return redirect('/purchase_accessories');
        }
        else{
             $url=url('/purchase_accessories/update').'/'.$id;
            $data=compact('purchase_accessories','accessories','url');
            return view('purchase_accessories.edit')->with($data);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'accessories'=>'required',
                'accessory_quantities'=>'required',
                'accessory_costs'=>'required'
            ]
        );
        foreach ($request->accessories as $key => $accessorieId) {
            $purchase_accessories=Purchase_Accessories_Model::find($id);
            $purchase_accessories->accessories_id = $accessorieId;
            if (isset($request->accessory_quantities[$key])) {
                $purchase_accessories->quantity = $request->accessory_quantities[$key];
            } else {
                $purchase_accessories->quantity = 1; 
            }
            if(isset($request->accessory_costs[$key])){
                $purchase_accessories->cost_per_unit=$request->accessory_costs[$key];
            }
            else{
                $purchase_accessories->cost_per_unit = 1;
            }
            $purchase_accessories->save();
        }
        $updateSuccess = true;
        return redirect('/purchase_accessories')->with('updateSuccess', $updateSuccess);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $purchase_accessories = Purchase_Accessories_Model::find($id);
        if (!is_null($purchase_accessories)) {
            $DeleteSuccess = true;
            $purchase_accessories->delete();
        }
        return redirect('/purchase_accessories')->with('DeleteSuccess', $DeleteSuccess);
    }
}
