<?php

namespace App\Http\Controllers\Doskar;

use App\Http\Controllers\Controller;
use App\Models\Doskar;
use Illuminate\Http\Request;

class DoskarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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

    public function getDoskar(Request $request)
    {
        $search = $request->search;

        if($search == ''){
            $doskar = Doskar::orderby('nama','asc')->select('id','nama')->limit(25)->get();
        }else{
            $doskar = Doskar::orderby('nama','asc')->select('id','nama')->where('nama', 'like', '%' .$search . '%')->limit(25)->get();
        }

        $response = array();
        foreach($doskar as $item){
            $response[] = array(
                'id' => $item->id,
                'text' => $item->nama
            );
        }

        return response()->json($response);
    }

    public function getNipDoskar(Request $request)
    {
        $id = $request->id;

        if($id != ''){
            $doskar = Doskar::select('nip', 'hp')->where('id', $id)->first();

            return response()->json($doskar);
        }
    }
}
