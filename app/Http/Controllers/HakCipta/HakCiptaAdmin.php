<?php

namespace App\Http\Controllers\HakCipta;

use App\Helpers\Utils;
use App\Http\Requests\HakCiptaStoreRequest;
use App\Http\Requests\HakCiptaUpdateRequest;
use App\Models\HakCipta;
use App\Models\JenisHakCipta;
use App\Models\Kota;
use App\Models\Negara;
use App\Models\Pengusul;
use App\Models\SubJenisHakCipta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class HakCiptaAdmin
{
    public static function index(Request $request)
    {
        if ($request->ajax())
        {
            $listHakCipta = DB::table('hak_cipta')
                ->select('hak_cipta.id')
                ->leftJoin('pengusul', 'pengusul.hak_cipta_id', 'hak_cipta.id')
                // ->where('pengusul.doskar_id', Auth()->user()->doskar_id)
                ->get()
                ->pluck('id');

            $data = DB::table('hak_cipta')
                ->select('hak_cipta.id', 'hak_cipta.jenis_hak_cipta_id', 'jenis_hak_cipta.nama as jenis_hak_cipta_nama',
                    'hak_cipta.sub_jenis_hak_cipta_id', 'sub_jenis_hak_cipta.nama as sub_jenis_hak_cipta_nama',
                    'hak_cipta.judul', 'hak_cipta.tanggal', 'hak_cipta.uraian', 'hak_cipta.file_sertifikat',
                    'hak_cipta.file_permohonan', 'hak_cipta.file_pengalihan', 'hak_cipta.file_pernyataan',
                    'hak_cipta.file_ktp')
                ->selectRaw('count(pengusul.nama) as anggota')
                ->selectRaw('sum(if(pengusul.is_ketua = 1, pengusul.id, 0)) as ketua_id')
                ->leftJoin('pengusul', 'pengusul.hak_cipta_id', 'hak_cipta.id')
                ->leftJoin('jenis_hak_cipta', 'jenis_hak_cipta.id', 'hak_cipta.jenis_hak_cipta_id')
                ->leftJoin('sub_jenis_hak_cipta', 'sub_jenis_hak_cipta.id', 'hak_cipta.sub_jenis_hak_cipta_id')
                // ->whereIn('hak_cipta.id', $listHakCipta)
                ->groupBy('hak_cipta.id', 'hak_cipta.jenis_hak_cipta_id', 'jenis_hak_cipta.nama',
                    'hak_cipta.sub_jenis_hak_cipta_id', 'sub_jenis_hak_cipta.nama',
                    'hak_cipta.judul', 'hak_cipta.tanggal', 'hak_cipta.uraian', 'hak_cipta.file_sertifikat',
                    'hak_cipta.file_permohonan', 'hak_cipta.file_pengalihan', 'hak_cipta.file_pernyataan',
                    'hak_cipta.file_ktp')
                ->orderByDesc('hak_cipta.created_at')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('judul_jenis_hak_cipta', function($row) {
                    return $row->judul.'<br><span class="badge bg-info">'.$row->jenis_hak_cipta_nama.' → '.$row->sub_jenis_hak_cipta_nama.'</span>';
                })
                ->addColumn('link', function($row) {
                    $linkSertifikat = Utils::isNullOrEmpty($row->file_sertifikat) ? '<span class="text-danger">2. Link Sertifikat</span>' : '<a href="'.route('hak-cipta.link-sertifikat', $row->id).'" target="_blank">2. Link Sertifikat</a>';
                    return '<a href="'.route('hak-cipta.link-dokumen', $row->id).'" target="_blank">1. Link Dokumen</a><br>'.$linkSertifikat;
                })
                ->addColumn('status_dokumen', function($row) {
                    $isComplete = (!Utils::isNullOrEmpty($row->file_permohonan) && !Utils::isNullOrEmpty($row->file_pengalihan)
                        && !Utils::isNullOrEmpty($row->file_pernyataan) && !Utils::isNullOrEmpty($row->file_ktp));

                    return $isComplete ? '<span class="badge bg-success">Lengkap</span>' : '<span class="badge bg-warning">Belum Lengkap</span>';
                })
                ->addColumn('ketua', function($row) {
                    $ketua = Pengusul::find($row->ketua_id);
                    return $ketua->nama;
                })
                ->addColumn('action', function($row) {
                    $btnView = '<a class="btn btn-blue btn-xs waves-effect waves-light" href="'.route('hak-cipta.show', $row->id).'">View</a>';
                    $btnEdit = !Utils::isNullOrEmpty($row->file_sertifikat) ? '' : '<a class="btn btn-info btn-xs waves-effect waves-light" href="'.route('hak-cipta.edit', $row->id).'">Edit</a>';
                    $btnDelete = !Utils::isNullOrEmpty($row->file_sertifikat) ? '' :
                        '<form class="d-inline" action="'.route('hak-cipta.destroy', $row->id).'" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <button type="submit" class="btn btn-danger btn-xs waves-effect waves-light" onclick="return confirm(\'Anda yakin ingin menghapus?\')">Delete</button>
                        </form>';
                    return $btnView.$btnEdit.$btnDelete;
                })
                ->rawColumns(['judul_jenis_hak_cipta', 'link', 'status_dokumen', 'ketua', 'action'])
                ->make();
        }

        return view('hak-cipta.index-admin');
    }

    public static function create()
    {
        // return view('hak-cipta.create-admin');
    }

    public static function store(HakCiptaStoreRequest $request)
    {
        return null;
    }

    public static function show(string $id)
    {
        // $doskar = Auth::user()->doskar;
        $hakCipta = HakCipta::find($id);
        $jenisHakCipta = JenisHakCipta::all();
        $subJenisHakCipta = SubJenisHakCipta::where('jenis_hak_cipta_id', $hakCipta->jenis_hak_cipta_id)->get();
        $negara = Negara::all();
        $kota = Kota::find($hakCipta->kota_id);
        $pengusul = Pengusul::where('hak_cipta_id', $id)->orderBy('urutan')->get();

        return view('hak-cipta.show-admin')
            ->with('id', $id)
            // ->with('doskar', $doskar)
            ->with('hakCipta', $hakCipta)
            ->with('jenisHakCipta', $jenisHakCipta)
            ->with('subJenisHakCipta', $subJenisHakCipta)
            ->with('negara', $negara)
            ->with('kota', $kota)
            ->with('pengusul', $pengusul);
    }

    public static function edit(string $id)
    {
        // $doskar = Auth::user()->doskar;
        $hakCipta = HakCipta::find($id);
        $jenisHakCipta = JenisHakCipta::all();
        $subJenisHakCipta = SubJenisHakCipta::where('jenis_hak_cipta_id', $hakCipta->jenis_hak_cipta_id)->get();
        $negara = Negara::all();
        $kota = Kota::find($hakCipta->kota_id);
        $pengusul = Pengusul::where('hak_cipta_id', $id)->orderBy('urutan')->get();

        return view('hak-cipta.edit-admin')
            ->with('id', $id)
            // ->with('doskar', $doskar)
            ->with('hakCipta', $hakCipta)
            ->with('jenisHakCipta', $jenisHakCipta)
            ->with('subJenisHakCipta', $subJenisHakCipta)
            ->with('negara', $negara)
            ->with('kota', $kota)
            ->with('pengusul', $pengusul);
    }

    public static function update(HakCiptaUpdateRequest $request, string $id)
    {
        $folderName = 'uploads/hak-cipta/';
        $request->validated();
        $hakCipta = HakCipta::find($id);

        $hakCipta->jenis_hak_cipta_id = $request->jenis_hak_cipta_id;
        $hakCipta->sub_jenis_hak_cipta_id = $request->sub_jenis_hak_cipta_id;
        $hakCipta->judul = $request->judul;
        $hakCipta->tanggal = $request->tanggal;
        $hakCipta->uraian = $request->uraian;
        $hakCipta->negara_id = $request->negara_id;
        $hakCipta->kota_id = $request->kota_id;

        if ($request->hasFile('file_permohonan')) {
            Storage::delete($folderName.$hakCipta->file_permohonan);
            $fileName = 'hak_cipta_'.$hakCipta->id.'_'.time().'_file_permohonan.'.$request->file_permohonan->extension();
            $request->file_permohonan->storeAs($folderName, $fileName);
            $hakCipta->file_permohonan = $fileName;
        }

        if ($request->hasFile('file_pengalihan')) {
            Storage::delete($folderName.$hakCipta->file_pengalihan);
            $fileName= 'hak_cipta_'.$hakCipta->id.'_'.time().'_file_pengalihan.'.$request->file_pengalihan->extension();
            $request->file_pengalihan->storeAs($folderName, $fileName);
            $hakCipta->file_pengalihan = $fileName;
        }

        if ($request->hasFile('file_pernyataan')) {
            Storage::delete($folderName.$hakCipta->file_pernyataan);
            $fileName = 'hak_cipta_'.$hakCipta->id.'_'.time().'_file_pernyataan.'.$request->file_pernyataan->extension();
            $request->file_pernyataan->storeAs($folderName, $fileName);
            $hakCipta->file_pernyataan = $fileName;
        }

        if ($request->hasFile('file_ktp')) {
            Storage::delete($folderName.$hakCipta->file_ktp);
            $fileName = 'hak_cipta_'.$hakCipta->id.'_'.time().'_file_ktp.'.$request->file_ktp->extension();
            $request->file_ktp->storeAs($folderName, $fileName);
            $hakCipta->file_ktp = $fileName;
        }

        if ($request->hasFile('file_sertifikat')) {
            Storage::delete($folderName.$hakCipta->file_sertifikat);
            $fileName = 'hak_cipta_'.$hakCipta->id.'_'.time().'_file_sertifikat.'.$request->file_sertifikat->extension();
            $request->file_sertifikat->storeAs($folderName, $fileName);
            $hakCipta->file_sertifikat = $fileName;
        }

        $hakCipta->save();

        $idPengusul = Pengusul::where('hak_cipta_id', $id)->orderBy('urutan')->get()->pluck('id');
        Pengusul::destroy($idPengusul);

        for ($i=0; $i<count($request->tipe); $i++)
        {
            $pengusul = [
                'hak_cipta_id' => $hakCipta->id,
                'hp' => $request->hp[$i],
                'is_ketua' => $i == 0 ? true : false,
                'urutan' => ($i+1)
            ];

            if ($request->tipe[$i] == 'doskar')
            {
                $doskar = DB::table('doskar')->where('id', $request->nama[$i])->first();
                $pengusul['nama'] = $doskar->nama;
                $pengusul['nip'] = $request->nip[$i];
                $pengusul['is_doskar'] = true;
                $pengusul['doskar_id'] = $request->nama[$i];
            }
            else if ($request->tipe[$i] == 'mahasiswa')
            {
                $mhs = DB::table('mahasiswa')->where('id', $request->nama[$i])->first();
                $pengusul['nama'] = $mhs->nama;
                $pengusul['nrp'] = $request->nip[$i];
                $pengusul['is_mahasiswa'] = true;
                $pengusul['mahasiswa_id'] = $request->nama[$i];
            }
            else if ($request->tipe[$i] == 'eksternal')
            {
                $pengusul['nama'] = $request->nama[$i];
                $pengusul['email'] = $request->nip[$i];
                $pengusul['is_eksternal'] = true;
            }

            Pengusul::create($pengusul);
        }

        return redirect()->route('hak-cipta.index')->with('success', 'Hak Cipta berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        //
    }
}
