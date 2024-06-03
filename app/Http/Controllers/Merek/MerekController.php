<?php

namespace App\Http\Controllers\Merek;

use App\Http\Controllers\Controller;
use App\Http\Requests\MerekStoreRequest;
use App\Http\Requests\MerekUpdateRequest;
use App\Models\JenisMerek;
use App\Models\Merek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MerekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return MerekAdmin::index($request);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return MerekDosen::index($request);
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
            return MerekAdmin::create();
        }
        else if ($currentUser->hasRole('Dosen')) {
            return MerekDosen::create();
        }

        return view('404');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MerekStoreRequest $request)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return MerekAdmin::store($request);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return MerekDosen::store($request);
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
            return MerekAdmin::show($id);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return MerekDosen::show($id);
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
            return MerekAdmin::edit($id);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return MerekDosen::edit($id);
        }

        return view('404');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MerekUpdateRequest $request, string $id)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return MerekAdmin::update($request, $id);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return MerekDosen::update($request, $id);
        }

        return view('404');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $folderName = 'uploads/merek/';
        $merek = Merek::find($id);
        Storage::delete($folderName.$merek->file_uraian_merek);
        Storage::delete($folderName.$merek->file_ttd_pemohon);
        Storage::delete($folderName.$merek->file_gambar);
        Storage::delete($folderName.$merek->file_pernyataan_lisensi);
        Storage::delete($folderName.$merek->file_permohonan_merek);
        Storage::delete($folderName.$merek->file_perpanjangan_merek);
        Storage::delete($folderName.$merek->file_surat_pengalihan_hak);
        Storage::delete($folderName.$merek->file_surat_perubahan_nama_alamat);
        Storage::delete($folderName.$merek->file_penjelasan_pendaftaran_merek);
        Storage::delete($folderName.$merek->file_penjelasan_perpanjangan_merek);
        Storage::delete($folderName.$merek->file_penjelasan_pengalihan_hak);
        $merek->delete();

        return redirect()->route('merek.index')->with('success', 'Merek berhasil dihapus');
    }

    public function getJenisMerek()
    {
        $jenisMerek = JenisMerek::all();
        return response()->json($jenisMerek);
    }

    public function linkDokumen(string $id)
    {
        $merek = Merek::find($id);

        return view('merek.link-dokumen')
            ->with('merek', $merek);
    }

    public function linkSertifikat(string $id)
    {
        $merek = Merek::find($id);

        return view('merek.link-sertifikat')
            ->with('merek', $merek);
    }

    public function viewDokumen(string $id)
    {
        return response()->file(storage_path('app/uploads/merek/'.$id));
    }

    public function downloadDokumen(string $id)
    {
        return Storage::download('uploads/merek/'.$id);
    }
}
