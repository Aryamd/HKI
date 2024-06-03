<?php

namespace App\Http\Controllers\HakCipta;

use App\Http\Controllers\Controller;
use App\Http\Requests\HakCiptaStoreRequest;
use App\Http\Requests\HakCiptaUpdateRequest;
use App\Models\HakCipta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HakCiptaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return HakCiptaAdmin::index($request);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return HakCiptaDosen::index($request);
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
            return HakCiptaAdmin::create();
        }
        else if ($currentUser->hasRole('Dosen')) {
            return HakCiptaDosen::create();
        }

        return view('404');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HakCiptaStoreRequest $request)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return HakCiptaAdmin::store($request);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return HakCiptaDosen::store($request);
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
            return HakCiptaAdmin::show($id);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return HakCiptaDosen::show($id);
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
            return HakCiptaAdmin::edit($id);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return HakCiptaDosen::edit($id);
        }

        return view('404');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HakCiptaUpdateRequest $request, string $id)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('Admin')) {
            return HakCiptaAdmin::update($request, $id);
        }
        else if ($currentUser->hasRole('Dosen')) {
            return HakCiptaDosen::update($request, $id);
        }

        return view('404');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $folderName = 'uploads/hak-cipta/';
        $hakCipta = HakCipta::find($id);
        Storage::delete($folderName.$hakCipta->file_permohonan);
        Storage::delete($folderName.$hakCipta->file_pengalihan);
        Storage::delete($folderName.$hakCipta->file_pernyataan);
        Storage::delete($folderName.$hakCipta->file_ktp);
        $hakCipta->delete();

        return redirect()->route('hak-cipta.index')->with('success', 'Hak Cipta berhasil dihapus');
    }

    public function linkDokumen(string $id)
    {
        $hakCipta = HakCipta::find($id);

        return view('hak-cipta.link-dokumen')
            ->with('hakCipta', $hakCipta);
    }

    public function linkSertifikat(string $id)
    {
        $hakCipta = HakCipta::find($id);

        return view('hak-cipta.link-sertifikat')
            ->with('hakCipta', $hakCipta);
    }

    public function viewDokumen(string $id)
    {
        return response()->file(storage_path('app/uploads/hak-cipta/'.$id));
    }

    public function downloadDokumen(string $id)
    {
        return Storage::download('uploads/hak-cipta/'.$id);
    }
}
