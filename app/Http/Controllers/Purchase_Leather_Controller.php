<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LeatherColor;
use App\Models\Purchase_Leather_Model;
use App\Models\Leather_Vendor_Model;
use App\Models\Purchase_Leather_Color_Model;
use App\Models\Leather_Transaction_Model;
use App\Models\Leather_Inventory_Model;

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
        $request->validate(
            [
                'leather'=>'required',
                'leather_quantities'=>'required',
                'leather_costs'=>'required',
                'leather_vendors'=>'required',
            ]
            );
        foreach ($request->leather  as $key => $leathercolorid) {
            $purchase_leather=new Purchase_Leather_Model;
            $purchase_leather_color=new Purchase_Leather_Color_Model;
            $leathertransaction=new Leather_Transaction_Model;
<<<<<<< HEAD
            
=======
>>>>>>> 66a95ddc96f6691193aee7a9f83284f5fa66aa29

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
            $purchase_leather->leather_vendor_id=$request['leather_vendors'];
            $total= $purchase_leather_color->cost_per_unit * $purchase_leather_color->quantity;
            $purchase_leather->total_cost=$total;
            $leathertransaction->amount=$purchase_leather->total_cost;
            //leather inventory 
            $leather_inventory = Leather_Inventory_Model::where('leathercolor_id', $leathercolorid)->first();

            if ($leather_inventory) {
                $leather_inventory->quantity_on_hand += $purchase_leather_color->quantity;
                $leather_inventory->save();
            } else {
                $leather_inventory = new Leather_Inventory_Model();
                $lot_no='LT'.''.rand(1,1000);
                if($lot_no==$leather_inventory->lot_no){
                    $lot_no='LT'.''.rand(1,1000);
                }
                else{
                    $lot_no;
                }
                $leather_inventory->leathercolor_id = $leathercolorid;
                $leather_inventory->lot_no=$lot_no;
                $leather_inventory->quantity_on_hand = $purchase_leather_color->quantity;
                $leather_inventory->save();                           
            }
            $purchase_leather->save();
            //purchase leather color
            $purchase_leather_color->purchase_leather_id=$purchase_leather->id;
            //leather transaction
            $leathertransaction->transaction_date=$purchase_leather->created_at;
            $leathertransaction->purchase_leather_id=$purchase_leather->id;
            $leathertransaction->transaction_type='purchase';
            $leathertransaction->description="Leather has been Purchased";
            $purchase_leather_color->save();
            $leathertransaction->save();
<<<<<<< HEAD
            
=======
>>>>>>> 66a95ddc96f6691193aee7a9f83284f5fa66aa29
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
            $data=compact('purchase_leather','purchase_leather_color','leathers_color','leathervendor','url');
            return view('purchase_leather.edit')->with($data);
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'leather'=>'required',
                'leather_quantities'=>'required',
                'leather_costs'=>'required',
                'leather_vendors'=>'required',
            ]
            );
        foreach ($request->leather  as $key => $leathercolorid) {
            $purchase_leather=Purchase_Leather_Model::find($id);
            $purchase_leather_color = Purchase_Leather_Color_Model::where('purchase_leather_id', $id)->first();
            $leathertransaction=Leather_Transaction_Model::where('purchase_leather_id', $id)->first();
            $purchase_leather_color->purchase_leather_id=$purchase_leather->id;
            $purchase_leather_color->leather_color_id=$leathercolorid;
            $leather_inventory = Leather_Inventory_Model::where('leathercolor_id', $leathercolorid)->first();
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
            $leathertransaction->amount=$purchase_leather->total_cost;
<<<<<<< HEAD
            //leather inventory
            if ($leather_inventory) {
                $leather_inventory->quantity_on_hand += $purchase_leather_color->quantity;
                $leather_inventory->save();
            } else {
                
            }
            $purchase_leather->save();
            
=======
            $purchase_leather->save();
>>>>>>> 66a95ddc96f6691193aee7a9f83284f5fa66aa29
            //purchase leather color
            $purchase_leather_color->purchase_leather_id=$purchase_leather->id;
            //leather transaction
            $leathertransaction->transaction_date=$purchase_leather->created_at;
            $leathertransaction->purchase_leather_id=$purchase_leather->id;
            $leathertransaction->transaction_type='purchase';
            $leathertransaction->description="Leather has been Purchased";
            $purchase_leather_color->save();
            $leathertransaction->save();
<<<<<<< HEAD
            
=======
>>>>>>> 66a95ddc96f6691193aee7a9f83284f5fa66aa29
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
