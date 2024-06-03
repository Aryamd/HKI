<?php

namespace App\Http\Controllers\KategoriKI;

use App\Http\Controllers\Controller;
use App\Models\JenisHakCipta;
use App\Models\SubJenisHakCipta;
use Illuminate\Http\Request;

class KategoriKIController extends Controller
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

    public function getJenisKI(Request $request)
    {
        $jenisKI = JenisHakCipta::all();
        return response()->json($jenisKI);
    }

    public function getSubJenisKI(Request $request)
    {
        // $jenisKI = decrypt($request['jenis_hak_cipta_id']);
        $jenisKI = $request['jenis_hak_cipta_id'];
        $subJenisKI = SubJenisHakCipta::where('jenis_hak_cipta_id', $jenisKI)->get();
        return response()->json($subJenisKI);
    }
}
