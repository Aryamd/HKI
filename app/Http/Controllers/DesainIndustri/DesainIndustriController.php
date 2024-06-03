<?php

namespace App\Http\Controllers\DesainIndustri;

use App\Http\Controllers\Controller;
use App\Http\Requests\DesainIndustriStoreRequest;
use App\Http\Requests\DesainIndustriUpdateRequest;
use App\Models\DesainIndustri;
use App\Models\JenisDesainIndustri;
use App\Models\SubJenisDesainIndustri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DesainIndustriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return DesainIndustriAdmin::index($request);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return DesainIndustriDosen::index($request);
        }

        return view('404');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return DesainIndustriAdmin::create();
        }
        else if ($currentUser->hasRole('Dosen')) {
            return DesainIndustriDosen::create();
        }

        return view('404');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DesainIndustriStoreRequest $request)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return DesainIndustriAdmin::store($request);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return DesainIndustriDosen::store($request);
        }

        return view('404');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return DesainIndustriAdmin::show($id);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return DesainIndustriDosen::show($id);
        }

        return view('404');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return DesainIndustriAdmin::edit($id);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return DesainIndustriDosen::edit($id);
        }

        return view('404');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DesainIndustriUpdateRequest $request, string $id)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return DesainIndustriAdmin::update($request, $id);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return DesainIndustriDosen::update($request, $id);
        }

        return view('404');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $folderName = 'uploads/desain-industri/';
        $desainIndustri = DesainIndustri::find($id);
        Storage::delete($folderName.$desainIndustri->file_gambar_desain_industri);
        Storage::delete($folderName.$desainIndustri->file_rincian_gambar_desain_industri);
        Storage::delete($folderName.$desainIndustri->file_gambar_tampak_depan);
        Storage::delete($folderName.$desainIndustri->file_gambar_tampak_belakang);
        Storage::delete($folderName.$desainIndustri->file_gambar_tampak_samping_kiri);
        Storage::delete($folderName.$desainIndustri->file_gambar_tampak_samping_kanan);
        Storage::delete($folderName.$desainIndustri->file_gambar_tampak_atas);
        Storage::delete($folderName.$desainIndustri->file_uraian_desain_industri);
        Storage::delete($folderName.$desainIndustri->file_surat_pernyataan_kepemilikan);
        Storage::delete($folderName.$desainIndustri->file_surat_pernyataan_pengalihan_hak);
        $desainIndustri->delete();

        return redirect()->route('desain-industri.index')->with('success', 'Desain Industri berhasil dihapus');
    }

    public function getJenisDesainIndustri()
    {
        $jenisDesainIndustri = JenisDesainIndustri::all();
        return response()->json($jenisDesainIndustri);
    }

    public function getSubJenisDesainIndustri(string $id)
    {
        $subJenisDesainIndustri = SubJenisDesainIndustri::all();
        return response()->json($subJenisDesainIndustri);
    }

    public function linkDokumen(string $id)
    {
        $desainIndustri = DesainIndustri::find($id);

        return view('desain-industri.link-dokumen')
            ->with('desainIndustri', $desainIndustri);
    }

    public function linkSertifikat(string $id)
    {
        $desainIndustri = DesainIndustri::find($id);

        return view('desain-industri.link-sertifikat')
            ->with('desainIndustri', $desainIndustri);
    }

    public function viewDokumen(string $id)
    {
        return response()->file(storage_path('app/uploads/desain-industri/'.$id));
    }

    public function downloadDokumen(string $id)
    {
        return Storage::download('uploads/desain-industri/'.$id);
    }
}
