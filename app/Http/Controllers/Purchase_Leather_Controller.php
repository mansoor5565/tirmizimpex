<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LeatherColor;
use App\Models\Purchase_Leather_Model;
use App\Models\Leather_Vendor_Model;
use App\Models\Purchase_Leather_Color_Model;

class Purchase_Leather_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $purchase_leather_color=Purchase_Leather_Color_Model::with("leatherColors",'purchaseleathers')->get();
        $data=compact('purchase_leather_color');
        return view('purchase_leather.view')->with($data);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $leathers_color=LeatherColor::with('leathers')->get();
        $leathervendor=Leather_Vendor_Model::all();
        $data=compact('leathers_color','leathervendor');
        return view('purchase_leather.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        foreach ($request->leather  as $key => $leathercolorid) {
            $purchase_leather=new Purchase_Leather_Model;
            $purchase_leather_color=new Purchase_Leather_Color_Model;
            $purchase_leather_color->purchase_leather_id=$purchase_leather->id;
            $purchase_leather_color->leather_color_id=$leathercolorid;
           if(isset($request->leather_quantities[$key])){
                $purchase_leather_color->quantity=$request->leather_quantities[$key];
            }
            else{
                $purchase_leather->quantity = 1;
            }
            if(isset($request->leather_costs[$key])){
                $purchase_leather_color->cost_per_unit=$request->leather_costs[$key];
            }
            else{
                $purchase_leather->cost_per_unit = 1;
            }
            if(isset($request->leather_vendors[$key])){
                $purchase_leather->leather_vendor_id=$request->leather_vendors[$key];
            }
            $total= $purchase_leather_color->cost_per_unit * $purchase_leather_color->quantity;
            $purchase_leather->total_cost=$total;
            $purchase_leather->save();
            $purchase_leather_color->purchase_leather_id=$purchase_leather->id;
            $purchase_leather_color->save();
        }
        $submitSuccess = true;

        return redirect('/purchase_leather')->with('submitSuccess', $submitSuccess);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchase_leather_color=Purchase_Leather_Color_Model::with("leatherColors",'purchaseleathers')->find($id);
        $data=compact('purchase_leather_color');
        return view('purchase_leather.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $leathervendor=Leather_Vendor_Model::all();
        $purchase_leather=Purchase_Leather_Model::find($id);
        $purchase_leather_color = Purchase_Leather_Color_Model::where('purchase_leather_id', $id)->get();
        $leathers_color=LeatherColor::with('leathers')->get();
        if(is_null($purchase_leather)){
            return redirect('/purchase_leather');
        }
        else{
             $url=url('/purchase_leather/update').'/'.$id;
            $data=compact('purchase_leather','leathers_color','leathervendor','url');
            return view('purchase_leather.edit')->with($data);
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        foreach ($request->leather  as $key => $leathercolorid) {
            $purchase_leather=Purchase_Leather_Model::find($id);
            $purchase_leather_color = Purchase_Leather_Color_Model::where('purchase_leather_id', $id)->first();
            $purchase_leather_color->purchase_leather_id=$purchase_leather->id;
            $purchase_leather_color->leather_color_id=$leathercolorid;
           if(isset($request->leather_quantities[$key])){
                $purchase_leather_color->quantity=$request->leather_quantities[$key];
            }
            else{
                $purchase_leather->quantity = 1;
            }
            if(isset($request->leather_costs[$key])){
                $purchase_leather_color->cost_per_unit=$request->leather_costs[$key];
            }
            else{
                $purchase_leather->cost_per_unit = 1;
            }
            if(isset($request->leather_vendors[$key])){
                $purchase_leather->leather_vendor_id=$request->leather_vendors[$key];
            }
            $total= $purchase_leather_color->cost_per_unit * $purchase_leather_color->quantity;
            $purchase_leather->total_cost=$total;
            $purchase_leather->save();
            $purchase_leather_color->purchase_leather_id=$purchase_leather->id;
            $purchase_leather_color->save();
        }
        $updateSuccess = true;
        return redirect('/purchase_leather')->with('updateSuccess', $updateSuccess);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $purchase_leather = Purchase_Leather_Model::find($id);
        if (!is_null($purchase_leather)) {
            $DeleteSuccess = true;
            $purchase_leather->delete();
        }
        $DeleteSuccess = true;
        return redirect('/purchase_leather')->with('DeleteSuccess', $DeleteSuccess);
    }
}
