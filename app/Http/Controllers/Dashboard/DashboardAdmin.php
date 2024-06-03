<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardAdmin
{
    public static function index()
    {
        $nPaten = DB::table('paten')
            ->select('paten.id')
            ->leftJoin('pengusul', 'pengusul.paten_id', 'paten.id')
            // ->where('pengusul.doskar_id', Auth()->user()->doskar_id)
            ->get()
            ->count();
        $nPatenComplete = DB::table('paten')
            ->select('paten.id')
            ->leftJoin('pengusul', 'pengusul.paten_id', 'paten.id')
            // ->where('pengusul.doskar_id', Auth()->user()->doskar_id)
            ->whereNotNull('file_sertifikat')
            ->get()
            ->count();

        $nMerek = DB::table('merek')
            ->select('merek.id')
            ->leftJoin('pengusul', 'pengusul.merek_id', 'merek.id')
            // ->where('pengusul.doskar_id', Auth()->user()->doskar_id)
            ->get()
            ->count();
        $nMerekComplete = DB::table('merek')
            ->select('merek.id')
            ->leftJoin('pengusul', 'pengusul.merek_id', 'merek.id')
            // ->where('pengusul.doskar_id', Auth()->user()->doskar_id)
            ->whereNotNull('file_sertifikat')
            ->get()
            ->count();

        $nHakCipta = DB::table('hak_cipta')
            ->select('hak_cipta.id')
            ->leftJoin('pengusul', 'pengusul.hak_cipta_id', 'hak_cipta.id')
            // ->where('pengusul.doskar_id', Auth()->user()->doskar_id)
            ->get()
            ->count();
        $nHakCiptaComplete = DB::table('hak_cipta')
            ->select('hak_cipta.id')
            ->leftJoin('pengusul', 'pengusul.hak_cipta_id', 'hak_cipta.id')
            // ->where('pengusul.doskar_id', Auth()->user()->doskar_id)
            ->whereNotNull('file_sertifikat')
            ->get()
            ->count();

        $nDesainIndustri = DB::table('desain_industri')
            ->select('desain_industri.id')
            ->leftJoin('pengusul', 'pengusul.desain_industri_id', 'desain_industri.id')
            // ->where('pengusul.doskar_id', Auth()->user()->doskar_id)
            ->get()
            ->count();
        $nDesainIndustriComplete = DB::table('desain_industri')
            ->select('desain_industri.id')
            ->leftJoin('pengusul', 'pengusul.desain_industri_id', 'desain_industri.id')
            // ->where('pengusul.doskar_id', Auth()->user()->doskar_id)
            ->whereNotNull('file_sertifikat')
            ->get()
            ->count();

        $nDTLST = DB::table('dtlst')
            ->select('dtlst.id')
            ->leftJoin('pengusul', 'pengusul.dtlst_id', 'dtlst.id')
            // ->where('pengusul.doskar_id', Auth()->user()->doskar_id)
            ->get()
            ->count();
        $nDTLSTComplete = DB::table('dtlst')
            ->select('dtlst.id')
            ->leftJoin('pengusul', 'pengusul.dtlst_id', 'dtlst.id')
            // ->where('pengusul.doskar_id', Auth()->user()->doskar_id)
            ->whereNotNull('file_sertifikat')
            ->get()
            ->count();

        $nAll = $nPaten + $nMerek + $nHakCipta + $nDesainIndustri + $nDTLST;
        $nComplete = $nPatenComplete + $nMerekComplete + $nHakCiptaComplete + $nDesainIndustriComplete + $nDTLSTComplete;

        return view('dashboard.index-admin')
            ->with('nPaten', $nPaten)
            ->with('nMerek', $nMerek)
            ->with('nHakCipta', $nHakCipta)
            ->with('nDesainIndustri', $nDesainIndustri)
            ->with('nDTLST', $nDTLST)
            ->with('nAll', $nAll)
            ->with('nComplete', $nComplete);
    }

    public static function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
