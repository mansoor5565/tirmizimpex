<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accessories_Model;

class AccessoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accessories=Accessories_Model::all();
        $data=compact('accessories');
        return view('accessories.view')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $accessories=Accessories_Model::all();
        $data=compact('accessories');
        return view('accessories.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:accessories',
            'other_type' => 'required_if:type,other',
            'cost_per_unit' => 'required',
            'unit' => 'required'
        ]);
        
            $accessories=new Accessories_Model;
            $accessories->name=$request['name'];
            $accessories->type = $request->filled('other_type') ? $request->input('other_type') : $request->input('type');
            $accessories->cost_per_unit=$request['cost_per_unit'];
            $accessories->unit=$request['unit'];
            $accessories->save();
            $submitSuccess = true;
            return redirect('/accessories')->with('submitSuccess', $submitSuccess);
            
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $accessories=Accessories_Model::find($id);
        $data=compact('accessories');
        return view('accessories.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $accessories_mod=Accessories_Model::all();
        $accessories=Accessories_Model::find($id);
        if(is_null($accessories)){
            return redirect('/accessories');
        }
        else{
             $url=url('/accessories/update').'/'.$id;
            $data=compact('accessories','url','accessories_mod');
            return view('accessories.edit')->with($data);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:accessories',
            'other_type' => 'required_if:type,other',
            'cost_per_unit' => 'required',
            'unit' => 'required'
        ]);
        $accessories = Accessories_Model::find($id);
        $accessories->name=$request['name'];
        $accessories->type = $request->filled('other_type') ? $request->input('other_type') : $request->input('type');
        $accessories->cost_per_unit=$request['cost_per_unit'];
        $accessories->unit=$request['unit'];
        $accessories->save();
        $updateSuccess = true;
        return redirect('/accessories')->with('updateSuccess', $updateSuccess);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $accessories=Accessories_Model::find($id);
        if(!is_null($accessories))
        {
            $DeleteSuccess = true;
            $accessories->delete();
        }
        return redirect('/accessories')->with('DeleteSuccess', $DeleteSuccess);
    }
}
