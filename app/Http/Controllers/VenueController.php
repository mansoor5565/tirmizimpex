<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Venue;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $venue=Venue::all();
        $data=compact('venue');
        return view('venue.view')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('venue.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name'=>'required',
            ]
            );
            $venue=new Venue;
            $venue->name=$request['name'];
            $venue->save();
            $submitSuccess = true;
            return redirect('/venue')->with('submitSuccess', $submitSuccess);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $venue=Venue::find($id);
        $data=compact('venue');
        return view('venue.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $venue=Venue::find($id);
        if(is_null($venue)){
            return redirect('/venue');
        }
        else{
             $url=url('/venue/update').'/'.$id;
            $data=compact('venue','url');
            return view('venue.edit')->with($data);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name'=>'required',
            ]
            );
        $venue = Venue::find($id);
        $venue->name=$request['name'];
        $venue->save();
        return redirect('/venue');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $venue = Venue::find($id);
        if(!is_null($venue))
        {
            $venue->delete();
        }
        return redirect('/venue');
    }
}
