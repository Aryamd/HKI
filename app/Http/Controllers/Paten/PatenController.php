<?php

namespace App\Http\Controllers\Paten;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatenStoreRequest;
use App\Models\Paten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PatenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return PatenAdmin::index($request);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return PatenDosen::index($request);
        }

        return view('404');
    }

    public function pengajuanAwal(Request $request)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return PatenAdmin::pengajuanAwal($request);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return PatenDosen::pengajuanAwal($request);
        }

        return view('404');
    }

    public function terdaftar(Request $request)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return PatenAdmin::terdaftar($request);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return PatenDosen::terdaftar($request);
        }

        return view('404');
    }

    public function kelengkapanDokumen(Request $request)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return PatenAdmin::kelengkapanDokumen($request);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return PatenDosen::kelengkapanDokumen($request);
        }

        return view('404');
    }

    public function mediasi(Request $request)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return PatenAdmin::mediasi($request);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return PatenDosen::mediasi($request);
        }

        return view('404');
    }

    public function granted(Request $request)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return PatenAdmin::granted($request);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return PatenDosen::granted($request);
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
            return PatenAdmin::create();
        }
        else if ($currentUser->hasRole('Dosen')) {
            return PatenDosen::create();
        }

        return view('404');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PatenStoreRequest $request)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return PatenAdmin::store($request);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return PatenDosen::store($request);
        }

        return view('404');
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
    public function update(PatenStoreRequest $request, string $id)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return PatenAdmin::update($request, $id);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return PatenDosen::update($request, $id);
        }

        return view('404');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $folderName = 'uploads/paten/';
        $paten = Paten::find($id);
        Storage::delete($folderName.$paten->file_pernyataan_kebaruan);
        Storage::delete($folderName.$paten->file_permohonan_paten);
        Storage::delete($folderName.$paten->file_pemeriksaan_substantif);
        Storage::delete($folderName.$paten->file_deskripsi_paten);
        Storage::delete($folderName.$paten->file_klaim);
        Storage::delete($folderName.$paten->file_gambar_teknik);
        Storage::delete($folderName.$paten->file_abstrak);
        Storage::delete($folderName.$paten->file_penyerahan_hak);
        Storage::delete($folderName.$paten->file_kepemilikan_inventor);
        Storage::delete($folderName.$paten->file_surat_pengalihan_hak);
        $paten->delete();

        return redirect()->route('paten.pengajuan-awal')->with('success', 'Paten berhasil dihapus');
    }

    public function linkDokumen(string $id)
    {
        $paten = Paten::find($id);

        return view('paten.link-dokumen')
            ->with('paten', $paten);
    }

    public function linkSertifikat(string $id)
    {
        $paten = Paten::find($id);

        return view('paten.link-sertifikat')
            ->with('paten', $paten);
    }

    public function viewDokumen(string $id)
    {
        return response()->file(storage_path('app/uploads/paten/'.$id));
    }

    public function downloadDokumen(string $id)
    {
        return Storage::download('uploads/paten/'.$id);
    }

    public function passStatusPaten(string $id, string $routeName)
    {
        $paten = Paten::find($id);
        $paten->status_paten_id = $paten->status_paten_id + 1;
        $paten->save();

        return redirect()->route($routeName)->with('success', 'Status paten berhasil diganti');
    }
}
