<?php

namespace App\Http\Controllers\DTLST;

use App\Helpers\Utils;
use App\Http\Requests\DTLSTStoreRequest;
use App\Http\Requests\DTLSTUpdateRequest;
use App\Models\DTLST;
use App\Models\JenisDTLST;
use App\Models\Pengusul;
use App\Models\SubJenisDTLST;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DTLSTDosen
{
    public static function index(Request $request)
    {
        if ($request->ajax())
        {
            $listDTLST = DB::table('dtlst')
                ->select('dtlst.id')
                ->leftJoin('pengusul', 'pengusul.dtlst_id', 'dtlst.id')
                ->where('pengusul.doskar_id', Auth()->user()->doskar_id)
                ->get()
                ->pluck('id');

            $data = DB::table('dtlst')
                ->select('dtlst.id', 'dtlst.jenis_dtlst_id', 'jenis_dtlst.nama as jenis_dtlst_nama',
                    'dtlst.sub_jenis_dtlst_id', 'sub_jenis_dtlst.nama as sub_jenis_dtlst_nama',
                    'dtlst.judul', 'dtlst.tanggal', 'dtlst.uraian', 'dtlst.file_sertifikat',
                    'dtlst.file_gambar_dtlst', 'dtlst.file_uraian_dtlst', 'dtlst.file_surat_pernyataan_kepemilikan',
                    'dtlst.file_surat_pernyataan_pengalihan_hak')
                ->selectRaw('count(pengusul.nama) as anggota')
                ->selectRaw('max(if(pengusul.is_ketua = 1, pengusul.id, 0)) as ketua_id')
                ->leftJoin('pengusul', 'pengusul.dtlst_id', 'dtlst.id')
                ->leftJoin('jenis_dtlst', 'jenis_dtlst.id', 'dtlst.jenis_dtlst_id')
                ->leftJoin('sub_jenis_dtlst', 'sub_jenis_dtlst.id', 'dtlst.sub_jenis_dtlst_id')
                ->whereIn('dtlst.id', $listDTLST)
                ->groupBy('dtlst.id', 'dtlst.jenis_dtlst_id', 'jenis_dtlst.nama',
                    'dtlst.sub_jenis_dtlst_id', 'sub_jenis_dtlst.nama',
                    'dtlst.judul', 'dtlst.tanggal', 'dtlst.uraian', 'dtlst.file_sertifikat',
                    'dtlst.file_gambar_dtlst', 'dtlst.file_uraian_dtlst', 'dtlst.file_surat_pernyataan_kepemilikan',
                    'dtlst.file_surat_pernyataan_pengalihan_hak')
                ->orderByDesc('dtlst.created_at')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('judul_jenis_dtlst', function($row) {
                    return $row->judul.'<br><span class="badge bg-info">'.$row->jenis_dtlst_nama.' → '.$row->sub_jenis_dtlst_nama.'</span>';
                })
                ->addColumn('link', function($row) {
                    $linkSertifikat = Utils::isNullOrEmpty($row->file_sertifikat) ? '<span class="text-danger">2. Link Sertifikat</span>' : '<a href="'.route('dtlst.link-sertifikat', $row->id).'" target="_blank">2. Link Sertifikat</a>';
                    return '<a href="'.route('dtlst.link-dokumen', $row->id).'" target="_blank">1. Link Dokumen</a><br>'.$linkSertifikat;
                })
                ->addColumn('status_dokumen', function($row) {
                    $isComplete = (!Utils::isNullOrEmpty($row->file_gambar_dtlst) && !Utils::isNullOrEmpty($row->file_uraian_dtlst)
                        && !Utils::isNullOrEmpty($row->file_surat_pernyataan_kepemilikan) && !Utils::isNullOrEmpty($row->file_surat_pernyataan_pengalihan_hak));

                    return $isComplete ? '<span class="badge bg-success">Lengkap</span>' : '<span class="badge bg-warning">Belum Lengkap</span>';
                })
                ->addColumn('ketua', function($row) {
                    $ketua = Pengusul::find($row->ketua_id);
                    return $ketua->nama;
                })
                ->addColumn('action', function($row) {
                    $btnView = '<a class="btn btn-blue btn-xs waves-effect waves-light" href="'.route('dtlst.show', $row->id).'">View</a>';
                    $btnEdit = !Utils::isNullOrEmpty($row->file_sertifikat) ? '' : '<a class="btn btn-info btn-xs waves-effect waves-light" href="'.route('dtlst.edit', $row->id).'">Edit</a>';
                    $btnDelete = !Utils::isNullOrEmpty($row->file_sertifikat) ? '' :
                        '<form class="d-inline" action="'.route('dtlst.destroy', $row->id).'" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <button type="submit" class="btn btn-danger btn-xs waves-effect waves-light" onclick="return confirm(\'Anda yakin ingin menghapus?\')">Delete</button>
                        </form>';
                    return $btnView.$btnEdit.$btnDelete;
                })
                ->rawColumns(['judul_jenis_dtlst', 'link', 'status_dokumen', 'ketua', 'action'])
                ->make();
        }

        return view('dtlst.index-dosen');
    }

    public static function create()
    {
        $jenisDTLST = JenisDTLST::all();
        $subJenisDTLST = SubJenisDTLST::all();
        $doskar = Auth::user()->doskar;

        return view('dtlst.create-dosen')
            ->with('jenisDTLST', $jenisDTLST)
            ->with('subJenisDTLST', $subJenisDTLST)
            ->with('doskar', $doskar);
    }

    public static function store(DTLSTStoreRequest $request)
    {
        $folderName = 'uploads/dtlst/';
        $dtlst = DTLST::create($request->validated());
        $number = mt_rand(1000, 9999);
        $prefixFileName = 'dtlst_'.$dtlst->id.'_'.uniqid().'_'.$number.'_';

        if ($request->hasFile('file_gambar_dtlst')) {
            $fileName = $prefixFileName.'file_gambar_dtlst.'.$request->file_gambar_dtlst->extension();
            $request->file_gambar_dtlst->storeAs($folderName, $fileName);
            $dtlst->file_gambar_dtlst = $fileName;
        }

        if ($request->hasFile('file_uraian_dtlst')) {
            $fileName = $prefixFileName.'file_uraian_dtlst.'.$request->file_uraian_dtlst->extension();
            $request->file_uraian_dtlst->storeAs($folderName, $fileName);
            $dtlst->file_uraian_dtlst = $fileName;
        }

        if ($request->hasFile('file_surat_pernyataan_kepemilikan')) {
            $fileName = $prefixFileName.'file_surat_pernyataan_kepemilikan.'.$request->file_surat_pernyataan_kepemilikan->extension();
            $request->file_surat_pernyataan_kepemilikan->storeAs($folderName, $fileName);
            $dtlst->file_surat_pernyataan_kepemilikan = $fileName;
        }

        if ($request->hasFile('file_surat_pernyataan_pengalihan_hak')) {
            $fileName = $prefixFileName.'file_surat_pernyataan_pengalihan_hak.'.$request->file_surat_pernyataan_pengalihan_hak->extension();
            $request->file_surat_pernyataan_pengalihan_hak->storeAs($folderName, $fileName);
            $dtlst->file_surat_pernyataan_pengalihan_hak = $fileName;
        }

        $dtlst->save();

        for ($i=0; $i<count($request->tipe); $i++)
        {
            $pengusul = [
                'dtlst_id' => $dtlst->id,
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

        return redirect()->route('dtlst.index')->with('success', 'DTLST berhasil dibuat');
    }

    public static function show(string $id)
    {

    }

    public static function edit(string $id)
    {
        $dtlst = DTLST::find($id);
        $jenisDTLST = JenisDTLST::all();
        $subJenisDTLST = SubJenisDTLST::all();
        // $negara = Negara::all();
        // $kota = Kota::find($hakCipta->kota_id);
        $pengusul = Pengusul::where('dtlst_id', $id)->orderBy('urutan')->get();

        return view('dtlst.edit-dosen')
            ->with('id', $id)
            ->with('dtlst', $dtlst)
            ->with('jenisDTLST', $jenisDTLST)
            ->with('subJenisDTLST', $subJenisDTLST)
            // ->with('negara', $negara)
            // ->with('kota', $kota)
            ->with('pengusul', $pengusul);
    }

    public static function update(DTLSTUpdateRequest $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
