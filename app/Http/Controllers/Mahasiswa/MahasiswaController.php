<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
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

    public function getMahasiswa(Request $request)
    {
        $search = $request->search;

        if($search == ''){
            $doskar = Mahasiswa::orderby('nama','asc')->select('id','nama')->limit(25)->get();
        }else{
            $doskar = Mahasiswa::orderby('nama','asc')->select('id','nama')->where('nama', 'like', '%' .$search . '%')->limit(25)->get();
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

    public function getNrpMahasiswa(Request $request)
    {
        $id = $request->id;

        if($id != ''){
            $doskar = Mahasiswa::select('nrp', 'hp')->where('id', $id)->first();

            return response()->json($doskar);
        }
    }
}
