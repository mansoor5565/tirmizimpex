<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leather_Model;
use App\Models\Leather_Inventory_Model;
use App\Models\LeatherColor;

class Leather_Inventory_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leather_inventory=Leather_Inventory_Model::with('leathercolors')->get();
        $data=compact('leather_inventory');
        return view('leather_inventory.view')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $leathercolor=LeatherColor::with('leathers')->get();
        $data=compact('leathercolor');
        return view('leather_inventory.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'leathers' => 'required', 
            'leather_quantities' => 'required'
        ]);
        $leather_inventory=new Leather_Inventory_Model;

        $lot_no='LT'.''.rand(1,1000);
        if($lot_no==$leather_inventory->lot_no){
            $lot_no='LT'.''.rand(1,1000);
        }
        else{
            $lot_no;
        }

        foreach ($request->leathers as $key => $leatherId) {
            
            $leather_inventory=new Leather_Inventory_Model;    
            $leather_inventory->leathercolor_id = $leatherId;
            $leather_inventory->lot_no=$lot_no;
             if (isset($request->leather_quantities[$key])) {
                $leather_inventory->quantity_on_hand = $request->leather_quantities[$key];
            } else {
               
                $leather_inventory->quantity = 1; 
            }
            $leather_inventory->save();
        }
        $submitSuccess = true;
        return redirect('/leather_inventory')->with('submitSuccess', $submitSuccess);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $leather_inventory=Leather_Inventory_Model::with('leathercolors')->find($id);
        $data=compact('leather_inventory');
        return view('leather_inventory.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $leathercolor=LeatherColor::with('leathers')->get();
        $leather_inventory=Leather_Inventory_Model::find($id);
        if(is_null($leather_inventory)){
            return redirect('/leather_inventory');
        }
        else{
            $url=url('/leather_inventory/update').'/'.$id;
           $data=compact('leather_inventory','leathercolor','url');
           return view('leather_inventory.edit')->with($data);
       }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'leathers' => 'required', 
            'leather_quantities' => 'required'
        ]);
        $leather_inventory=Leather_Inventory_Model::find($id);
        foreach ($request->leathers as $key => $leatherId) {
             $leather_inventory->leathercolor_id = $leatherId;
             if (isset($request->leather_quantities[$key])) {
                $leather_inventory->quantity_on_hand = $request->leather_quantities[$key];
            } else {
                $leather_inventory->quantity = 1; 
            }
            $updateSuccess = true;
            $leather_inventory->save();
        }
        return redirect('/leather_inventory')->with('updateSuccess', $updateSuccess);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $leather_inventory = Leather_Inventory_Model::find($id);
        if (!is_null($leather_inventory)) {
            $DeleteSuccess = true;
            $leather_inventory->delete();
        }
        return redirect('/leather_inventory')->with('DeleteSuccess', $DeleteSuccess);
    }
}
