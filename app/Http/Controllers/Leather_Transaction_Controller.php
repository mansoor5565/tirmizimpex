<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leather_Transaction_Model;

class Leather_Transaction_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leathertransaction=Leather_Transaction_Model::with('purchaseLeatherInfo.purchaseleathercolor.leatherColors.leathers')->get();
        dd($leathertransaction);
        $data=compact('leathertransaction');
        return view('leather_transaction.view')->with($data);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $leathertransaction=Leather_Transaction_Model::find($id);
        $data=compact('leathertransaction');
        return view('leather_transaction.show')->with($data);   
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
