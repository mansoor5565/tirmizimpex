<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accessories_Model;
use App\Models\Accessories_Inventory_Model;
class Accessories_Inventory_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accessories_inventory=Accessories_Inventory_Model::with('accessories')->get();
        $data=compact('accessories_inventory');
        return view('accessories_inventory.view')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $accessories=Accessories_Model::all();
        $data=compact('accessories');
        return view('accessories_inventory.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'accessories' => 'required', 
            'quantity_on_hand' => 'required'
        ]);
        
        $accessories_inventory = new Accessories_Inventory_Model;
        $accessories_inventory->accessories_id = $request->input('accessories'); 
        $accessories_inventory->quantity_on_hand = $request->input('quantity_on_hand'); 
        $accessories_inventory->save();
        $submitSuccess = true;
        return redirect('/accessories_inventory')->with('submitSuccess', $submitSuccess);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $accessories_inventory=Accessories_Inventory_Model::with('accessories')->find($id);
        $data=compact('accessories_inventory');
        return view('accessories_inventory.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $accessories=Accessories_Model::all();
        $accessories_inventory=Accessories_Inventory_Model::find($id);
        if(is_null($accessories_inventory)){
            return redirect('/accessories_inventory');
        }
        else{
             $url=url('/accessories_inventory/update').'/'.$id;
            $data=compact('accessories_inventory','accessories','url');
            return view('accessories_inventory.edit')->with($data);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'accessories' => 'required', 
            'quantity_on_hand' => 'required'
        ]);
        $accessories_inventory=Accessories_Inventory_Model::find($id);
        $accessories_inventory->accessories_id = $request->input('accessories'); 
        $accessories_inventory->quantity_on_hand = $request->input('quantity_on_hand'); 
        $accessories_inventory->save();
        $updateSuccess = true;
        return redirect('/accessories_inventory')->with('updateSuccess', $updateSuccess);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $accessories_inventory = Accessories_Inventory_Model::find($id);
        if (!is_null($accessories_inventory)) {
            $DeleteSuccess = true;
            $accessories_inventory->delete();
        }
        return redirect('/accessories_inventory')->with('DeleteSuccess', $DeleteSuccess);
    }
}
