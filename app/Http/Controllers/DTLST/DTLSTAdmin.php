<?php

namespace App\Http\Controllers\DTLST;

use App\Helpers\Utils;
use App\Http\Requests\DTLSTStoreRequest;
use App\Http\Requests\DTLSTUpdateRequest;
use App\Models\Pengusul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DTLSTAdmin
{
    public static function index(Request $request)
    {
        if ($request->ajax())
        {
            // $listDTLST = DB::table('dtlst')
            //     ->select('dtlst.id')
            //     ->leftJoin('pengusul', 'pengusul.dtlst_id', 'dtlst.id')
            //     ->where('pengusul.doskar_id', Auth()->user()->doskar_id)
            //     ->get()
            //     ->pluck('id');

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
                // ->whereIn('dtlst.id', $listDTLST)
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
                    $isComplete = (!Utils::isNullOrEmpty($row->file_permohonan) && !Utils::isNullOrEmpty($row->file_pengalihan)
                        && !Utils::isNullOrEmpty($row->file_pernyataan) && !Utils::isNullOrEmpty($row->file_ktp));

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

        return view('dtlst.index-admin');
    }

    public static function create()
    {
        //
    }

    public static function store(DTLSTStoreRequest $request)
    {
        return null;
    }

    public static function show(string $id)
    {
        //
    }

    public static function edit(string $id)
    {
        //
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
