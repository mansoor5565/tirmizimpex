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

        $purchase_leather_colors = $purchase_leather_color = Purchase_Leather_Model::with('purchaseleathercolor.leatherColors.leathers')->with('leathervendors')->get();
        // dd($purchase_leather_colors);
        $data = compact('purchase_leather_colors');
        return view('purchase_leather.view')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $leathers_color = LeatherColor::with('leathers')->get();
        $leathervendor = Leather_Vendor_Model::all();
        $data = compact('leathers_color', 'leathervendor');
        return view('purchase_leather.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // die;
        $request->validate(
            [
                'purchase' => 'required',
                'leather_vendors' => 'required'
            ]
        );
        //purchase leather process
        $purchases = array_values($request->purchase);
        $totalCost = $this->totalCost($purchases);
        $purchase_leather = new Purchase_Leather_Model;
        $purchase_leather->leather_vendor_id = $request->leather_vendors;
        $purchase_leather->total_cost = $totalCost;
        $purchase_leather->save();
        //mulitple purchase commands
        foreach ($purchases as $purchase) {
            $purchase_leather_color = new Purchase_Leather_Color_Model;
            $purchase_leather_color->purchase_leather_id = $purchase_leather->id;
            $purchase_leather_color->leather_color_id = $purchase['leather_color_id'];
            $purchase_leather_color->cost_per_unit = $purchase['cost'];
            $purchase_leather_color->quantity = $purchase['quantity'];
            $purchase_leather_color->save();
        }
        //transaction commands
        $leather_transaction = new Leather_Transaction_Model;
        $leather_transaction->purchase_leather_id = $purchase_leather->id;
        $leather_transaction->transaction_date = $purchase_leather->created_at;
        $leather_transaction->transaction_type = 'purchase';
        $leather_transaction->amount = $totalCost;
        $leather_transaction->save();
        // foreach ($request->leather as $key => $leathercolorid) {
        //     $purchase_leather = new Purchase_Leather_Model;
        //     $purchase_leather_color = new Purchase_Leather_Color_Model;
        //     $leathertransaction = new Leather_Transaction_Model;

        //     $purchase_leather_color->purchase_leather_id = $purchase_leather->id;
        //     $purchase_leather_color->leather_color_id = $leathercolorid;
        //     if (isset($request->leather_quantities[$key])) {
        //         $purchase_leather_color->quantity = $request->leather_quantities[$key];
        //     } else {
        //         $purchase_leather->quantity = 1;
        //     }
        //     if (isset($request->leather_costs[$key])) {
        //         $purchase_leather_color->cost_per_unit = $request->leather_costs[$key];
        //     } else {
        //         $purchase_leather->cost_per_unit = 1;
        //     }
        //     $purchase_leather->leather_vendor_id = $request['leather_vendors'];
        //     $total = $purchase_leather_color->cost_per_unit * $purchase_leather_color->quantity;
        //     $purchase_leather->total_cost = $total;
        //     $leathertransaction->amount = $purchase_leather->total_cost;
        //     //leather inventory 
        //     $leather_inventory = Leather_Inventory_Model::where('leathercolor_id', $leathercolorid)->first();

        //     if ($leather_inventory) {
        //         $leather_inventory->quantity_on_hand += $purchase_leather_color->quantity;
        //         $leather_inventory->save();
        //     } else {

        //     }

        //     $purchase_leather->save();
        //     //purchase leather color
        //     $purchase_leather_color->purchase_leather_id = $purchase_leather->id;
        //     //leather transaction
        //     $leathertransaction->transaction_date = $purchase_leather->created_at;
        //     $leathertransaction->purchase_leather_id = $purchase_leather->id;
        //     $leathertransaction->transaction_type = 'purchase';
        //     $leathertransaction->description = "Leather has been Purchased";
        //     $purchase_leather_color->save();
        //     $leathertransaction->save();
        // }
        $submitSuccess = true;

        return redirect('/purchase_leather')->with('submitSuccess', $submitSuccess);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchase_leather_color = Purchase_Leather_Color_Model::with("leatherColors", 'purchaseleathers')->find($id);
        $data = compact('purchase_leather_color');
        return view('purchase_leather.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $leathervendor = Leather_Vendor_Model::all();
        $purchase_leather = Purchase_Leather_Model::find($id);
        $purchase_leather_color = Purchase_Leather_Color_Model::where('purchase_leather_id', $id)->get();
        $leathers_color = LeatherColor::with('leathers')->get();

        $totalPurchaseData = Purchase_Leather_Color_Model::with('leatherColors.leathers')->where('purchase_leather_id', $id)->get();
        // dd($totalPurchaseData);
        if (is_null($purchase_leather)) {
            return redirect('/purchase_leather');
        } else {
            $url = url('/purchase_leather/update') . '/' . $id;
            $data = compact('purchase_leather', 'purchase_leather_color', 'leathers_color', 'leathervendor', 'url', 'totalPurchaseData');
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
                'purchase' => 'required',
                'leather_vendors' => 'required'
            ]
        );
        //purchase leather process
        $purchases = array_values($request->purchase);
        $totalCost = $this->totalCost($purchases);
        $purchase_leather = Purchase_Leather_Model::with('purchaseleathercolor')->find($id);
        $purchase_leather->leather_vendor_id = $request->leather_vendors;
        $purchase_leather->total_cost = $totalCost;
        $purchase_leather->save();
        $purchase_leather->purchaseleathercolor()->delete();
        //mulitple purchase commands
        foreach ($purchases as $purchase) {
            $purchase_leather_color = new Purchase_Leather_Color_Model;
            $purchase_leather_color->purchase_leather_id = $purchase_leather->id;
            $purchase_leather_color->leather_color_id = $purchase['leather_color_id'];
            $purchase_leather_color->cost_per_unit = $purchase['cost'];
            $purchase_leather_color->quantity = $purchase['quantity'];
            $purchase_leather_color->save();
        }
        //transaction commands
        $leather_transaction = Leather_Transaction_Model::where('purchase_leather_id',$id)->first();
        $leather_transaction->amount = $totalCost;
        $leather_transaction->save();
        // $request->validate(
        //     [
        //         'leather' => 'required',
        //         'leather_quantities' => 'required',
        //         'leather_costs' => 'required',
        //         'leather_vendors' => 'required',
        //     ]
        // );
        // foreach ($request->leather as $key => $leathercolorid) {
        //     $purchase_leather = Purchase_Leather_Model::find($id);
        //     $purchase_leather_color = Purchase_Leather_Color_Model::where('purchase_leather_id', $id)->first();
        //     $leathertransaction = Leather_Transaction_Model::where('purchase_leather_id', $id)->first();
        //     $purchase_leather_color->purchase_leather_id = $purchase_leather->id;
        //     $purchase_leather_color->leather_color_id = $leathercolorid;
        //     if (isset($request->leather_quantities[$key])) {
        //         $purchase_leather_color->quantity = $request->leather_quantities[$key];
        //     } else {
        //         $purchase_leather->quantity = 1;
        //     }
        //     if (isset($request->leather_costs[$key])) {
        //         $purchase_leather_color->cost_per_unit = $request->leather_costs[$key];
        //     } else {
        //         $purchase_leather->cost_per_unit = 1;
        //     }
        //     if (isset($request->leather_vendors[$key])) {
        //         $purchase_leather->leather_vendor_id = $request->leather_vendors[$key];
        //     }
        //     $total = $purchase_leather_color->cost_per_unit * $purchase_leather_color->quantity;
        //     $purchase_leather->total_cost = $total;
        //     $leathertransaction->amount = $purchase_leather->total_cost;
        //     $purchase_leather->save();
        //     //purchase leather color
        //     $purchase_leather_color->purchase_leather_id = $purchase_leather->id;
        //     //leather transaction
        //     $leathertransaction->transaction_date = $purchase_leather->created_at;
        //     $leathertransaction->purchase_leather_id = $purchase_leather->id;
        //     $leathertransaction->transaction_type = 'purchase';
        //     $leathertransaction->description = "Leather has been Purchased";
        //     $purchase_leather_color->save();
        //     $leathertransaction->save();
        // }
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
    public function totalCost(array $purchases): int
    {
        $totalCost = 0;
        foreach ($purchases as $purchase) {
            $totalCost += ($purchase['cost'] * $purchase['quantity']);
        }
        return $totalCost;
    }
}
