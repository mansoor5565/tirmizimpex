<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leather_Model;
use App\Models\LeatherColor;

class LeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leathers = Leather_Model::with('leatherColors')->get();
        $data = compact('leathers');
        return view('leather.view')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leather.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'type' => 'required',
                'color' => 'required',
            ]
        );
        $leathers = new Leather_Model;
        $leathers->type = $request['type'];
        $leathers->save();
        $colors = explode('|', $request['color']);
        foreach ($colors as $color) {
            $leatherColor = new LeatherColor;
            $leatherColor->color = $color;
            $leatherColor->leather_id = $leathers->id;
            $leatherColor->save();
        }

        $submitSuccess = true;
        return redirect('/leather')->with('submitSuccess', $submitSuccess);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $leathers = Leather_Model::find($id);
        $leather_color = LeatherColor::where('leather_id', $id)->first();
        $data=compact('leathers','leather_color');
        return view('leather.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $leathers = Leather_Model::with('leatherColors')->find($id);
        if (is_null($leathers)) {
            return redirect('/leather');
        } else {
            $url = url('/leather/update') . '/' . $id;
            $data = compact('leathers', 'url');
            return view('leather.edit')->with($data);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate(
            [
                'type' => 'required',
                'color' => 'required',
            ]
        );
        
        $leathers = Leather_Model::with('leatherColors')->find($id);
        $leathers->type = $request['type'];
        $leathers->save();
        $leathers->leatherColors()->delete();
        $colors = explode('|', $request['color']);
        foreach ($colors as $color) {
            $leatherColor = new LeatherColor;
            $leatherColor->color = $color;
            $leatherColor->leather_id = $leathers->id;
            $leatherColor->save();
        }
        return redirect('/leather');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $leathers = Leather_Model::find($id);
        if (!is_null($leathers)) {
            $leathers->delete();
        }
        return redirect('/leather');
    }
}
