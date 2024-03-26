<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leather_Transaction_Model;

class Leather_Vendor_Bill_Controller extends Controller
{
    public function index()
    {
        $leather_vendor_bill = Leather_Transaction_Model::with('purchaseLeatherInfo')->get();
        $data=compact('leather_vendor_bill');
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
