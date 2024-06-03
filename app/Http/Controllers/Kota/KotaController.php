<?php

namespace App\Http\Controllers\Kota;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use Illuminate\Http\Request;

class KotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'aa';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return 'bb';
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

    public function getKota(Request $request)
    {
        $search = $request->search;

        if($search == ''){
            $kota = Kota::orderby('nama','asc')->select('id','nama')->limit(25)->get();
        }else{
            $kota = Kota::orderby('nama','asc')->select('id','nama')->where('nama', 'like', '%' .$search . '%')->limit(25)->get();
        }

        $response = array();
        foreach($kota as $item){
            $response[] = array(
                'id' => $item->id,
                'text' => $item->nama
            );
        }

        return response()->json($response);
    }
}
