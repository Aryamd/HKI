<?php

namespace App\Http\Controllers\DTLST;

use App\Http\Controllers\Controller;
use App\Http\Requests\DTLSTStoreRequest;
use App\Http\Requests\DTLSTUpdateRequest;
use App\Models\DTLST;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DTLSTController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return DTLSTAdmin::index($request);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return DTLSTDosen::index($request);
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
            return DTLSTAdmin::create();
        }
        else if ($currentUser->hasRole('Dosen')) {
            return DTLSTDosen::create();
        }

        return view('404');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DTLSTStoreRequest $request)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return DTLSTAdmin::store($request);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return DTLSTDosen::store($request);
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
            return DTLSTAdmin::show($id);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return DTLSTDosen::show($id);
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
            return DTLSTAdmin::edit($id);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return DTLSTDosen::edit($id);
        }

        return view('404');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DTLSTUpdateRequest $request, string $id)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return DTLSTAdmin::update($request, $id);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return DTLSTDosen::update($request, $id);
        }

        return view('404');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $folderName = 'uploads/dtlst/';
        $dtlst = DTLST::find($id);
        Storage::delete($folderName.$dtlst->file_gambar_dtlst);
        Storage::delete($folderName.$dtlst->file_uraian_dtlst);
        Storage::delete($folderName.$dtlst->file_surat_pernyataan_kepemilikan);
        Storage::delete($folderName.$dtlst->file_surat_pernyataan_pengalihan_hak);
        $dtlst->delete();

        return redirect()->route('hak-cipta.index')->with('success', 'Hak Cipta berhasil dihapus');
    }

    public function linkDokumen(string $id)
    {
        $dtlst = DTLST::find($id);

        return view('dtlst.link-dokumen')
            ->with('dtlst', $dtlst);
    }

    public function linkSertifikat(string $id)
    {
        $dtlst = DTLST::find($id);

        return view('dtlst.link-sertifikat')
            ->with('dtlst', $dtlst);
    }

    public function viewDokumen(string $id)
    {
        return response()->file(storage_path('app/uploads/dtlst/'.$id));
    }

    public function downloadDokumen(string $id)
    {
        return Storage::download('uploads/dtlst/'.$id);
    }
}
