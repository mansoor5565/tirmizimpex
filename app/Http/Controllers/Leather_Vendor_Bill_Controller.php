<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leather_Transaction_Model;
use App\Models\Leather_Vendor_Model;

class Leather_Vendor_Bill_Controller extends Controller
{
    public function index()
    {
        $leather_vendor_bills = Leather_Vendor_Model::with('purchase_leather.leathertransaction')
            ->get()
            ->sortByDesc(function ($vendor) {
                return optional($vendor->purchase_leather->flatMap->leathertransaction->max('transaction_date'));
            });
        // dd($leather_vendor_bill[0]->purchase_leather->sum('total_cost') .'Remaining Balance :'.$leather_vendor_bill[0]->purchase_leather->flatMap->leathertransaction->where('transaction_type', 'purchase')->sum('amount'));

        $data = compact('leather_vendor_bills');
        return view('vendor_bill.view')->with($data);
    }
    public function pay(Request $request, string $id)
    {
        // Fetch all Leather_Transaction_Model instances
        $leather_vendor_bills = Leather_Transaction_Model::with('purchaseLeatherInfo')->get();

        // Loop through each instance and update its transaction_type attribute
        foreach ($leather_vendor_bills as $leather_vendor_bill) {
            if ($leather_vendor_bill->purchaseLeatherInfo) {
                $leather_vendor_bill->transaction_type = 'payment';
                $leather_vendor_bill->save();
            }
            return redirect('/leather_vendor_bill');
        }

    }

}
