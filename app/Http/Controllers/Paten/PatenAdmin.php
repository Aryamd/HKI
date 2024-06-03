<?php

namespace App\Http\Controllers\Paten;

use App\Helpers\Utils;
use App\Http\Requests\PatenStoreRequest;
use App\Http\Requests\PatenUpdateRequest;
use App\Models\JenisPaten;
use App\Models\Paten;
use App\Models\Pengusul;
use App\Models\StatusPaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class PatenAdmin
{
    public static function index(Request $request)
    {
        if ($request->ajax())
        {
            // $listPaten = DB::table('paten')
            //     ->select('paten.id')
            //     ->leftJoin('pengusul', 'pengusul.paten_id', 'paten.id')
            //     ->where('pengusul.doskar_id', Auth()->user()->doskar_id)
            //     ->get()
            //     ->pluck('id');

            $data = DB::table('paten')
                ->select('paten.id', 'paten.jenis_paten_id', 'jenis_paten.nama as jenis_paten_nama', 'paten.judul', 'paten.tanggal', 'paten.abstrak', 'paten.file_sertifikat',
                    'paten.file_pernyataan_kebaruan', 'paten.file_permohonan_paten', 'paten.file_pemeriksaan_substantif',
                    'paten.file_deskripsi_paten', 'paten.file_klaim', 'paten.file_gambar_teknik', 'paten.file_abstrak',
                    'paten.file_penyerahan_hak', 'paten.file_kepemilikan_inventor', 'paten.file_surat_pengalihan_hak')
                ->selectRaw('count(pengusul.nama) as anggota')
                ->selectRaw('sum(if(pengusul.is_ketua = 1, pengusul.id, 0)) as ketua_id')
                ->leftJoin('pengusul', 'pengusul.paten_id', 'paten.id')
                ->leftJoin('jenis_paten', 'jenis_paten.id', 'paten.jenis_paten_id')
                // ->whereIn('paten.id', $listPaten)
                ->groupBy('paten.id', 'paten.jenis_paten_id', 'jenis_paten.nama', 'paten.judul',
                    'paten.tanggal', 'paten.abstrak', 'paten.file_sertifikat',
                    'paten.file_pernyataan_kebaruan', 'paten.file_permohonan_paten', 'paten.file_pemeriksaan_substantif',
                    'paten.file_deskripsi_paten', 'paten.file_klaim', 'paten.file_gambar_teknik', 'paten.file_abstrak',
                    'paten.file_penyerahan_hak', 'paten.file_kepemilikan_inventor', 'paten.file_surat_pengalihan_hak')
                ->orderByDesc('paten.created_at')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('judul_jenis_paten', function($row) {
                    return $row->judul.'<br><span class="badge bg-info">'.$row->jenis_paten_nama.'</span>';
                })
                ->addColumn('link', function($row) {
                    $linkSertifikat = Utils::isNullOrEmpty($row->file_sertifikat) ? '<span class="text-danger">2. Link Sertifikat</span>' : '<a href="'.route('paten.link-sertifikat', $row->id).'" target="_blank">2. Link Sertifikat</a>';
                    return '<a href="'.route('paten.link-dokumen', $row->id).'" target="_blank">1. Link Dokumen</a><br>'.$linkSertifikat;
                })
                ->addColumn('status_dokumen', function($row) {
                    $isComplete = false;
                    if ($row->jenis_paten_id == 1) {
                        $isComplete = (!Utils::isNullOrEmpty($row->file_pernyataan_kebaruan) && !Utils::isNullOrEmpty($row->file_permohonan_paten)
                            && !Utils::isNullOrEmpty($row->file_pemeriksaan_substantif) && !Utils::isNullOrEmpty($row->file_deskripsi_paten)
                            && !Utils::isNullOrEmpty($row->file_klaim) && !Utils::isNullOrEmpty($row->file_gambar_teknik)
                            && !Utils::isNullOrEmpty($row->file_abstrak) && !Utils::isNullOrEmpty($row->file_penyerahan_hak)
                            && !Utils::isNullOrEmpty($row->file_kepemilikan_inventor));
                    } else if ($row->jenis_paten_id == 2) {
                        $isComplete = (!Utils::isNullOrEmpty($row->file_pernyataan_kebaruan) && !Utils::isNullOrEmpty($row->file_permohonan_paten)
                            && !Utils::isNullOrEmpty($row->file_pemeriksaan_substantif) && !Utils::isNullOrEmpty($row->file_deskripsi_paten)
                            && !Utils::isNullOrEmpty($row->file_klaim) && !Utils::isNullOrEmpty($row->file_gambar_teknik)
                            && !Utils::isNullOrEmpty($row->file_abstrak) && !Utils::isNullOrEmpty($row->file_penyerahan_hak)
                            && !Utils::isNullOrEmpty($row->file_kepemilikan_inventor) && !Utils::isNullOrEmpty($row->file_surat_pengalihan_hak));
                    }

                    return $isComplete ? '<span class="badge bg-success">Lengkap</span>' : '<span class="badge bg-warning">Belum Lengkap</span>';
                })
                ->addColumn('ketua', function($row) {
                    $ketua = Pengusul::find($row->ketua_id);
                    return $ketua->nama;
                })
                ->addColumn('action', function($row) {
                    $btnView = '<a class="btn btn-blue btn-xs waves-effect waves-light" href="'.route('paten.show', $row->id).'">View</a>';
                    $btnEdit = !Utils::isNullOrEmpty($row->file_sertifikat) ? '' : '<a class="btn btn-info btn-xs waves-effect waves-light" href="'.route('paten.edit', $row->id).'">Edit</a>';
                    $btnDelete = !Utils::isNullOrEmpty($row->file_sertifikat) ? '' :
                        '<form class="d-inline" action="'.route('paten.destroy', $row->id).'" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <button type="submit" class="btn btn-danger btn-xs waves-effect waves-light" onclick="return confirm(\'Anda yakin ingin menghapus?\')">Delete</button>
                        </form>';
                    return $btnView.$btnEdit.$btnDelete;
                })
                ->rawColumns(['judul_jenis_paten', 'link', 'status_dokumen', 'ketua', 'action'])
                ->make();
        }

        $tahun = range(date('Y'), 2010);
        $jenisPaten = JenisPaten::all();
        $statusPaten = StatusPaten::all();

        return view('paten.index-admin')
            ->with('tahun', $tahun)
            ->with('jenisPaten', $jenisPaten)
            ->with('statusPaten', $statusPaten);
    }

    public static function pengajuanAwal(Request $request)
    {
        if ($request->ajax())
        {
            // $listPaten = DB::table('paten')
            //     ->select('paten.id')
            //     ->leftJoin('pengusul', 'pengusul.paten_id', 'paten.id')
            //     ->where('pengusul.doskar_id', Auth()->user()->doskar_id)
            //     ->get()
            //     ->pluck('id');

            $data = DB::table('paten')
                ->select('paten.id', 'paten.jenis_paten_id', 'jenis_paten.nama as jenis_paten_nama', 'paten.judul', 'paten.tanggal', 'paten.abstrak', 'paten.file_sertifikat',
                    'paten.file_pernyataan_kebaruan', 'paten.file_permohonan_paten', 'paten.file_pemeriksaan_substantif',
                    'paten.file_deskripsi_paten', 'paten.file_klaim', 'paten.file_gambar_teknik', 'paten.file_abstrak',
                    'paten.file_penyerahan_hak', 'paten.file_kepemilikan_inventor', 'paten.file_surat_pengalihan_hak')
                ->selectRaw('count(pengusul.nama) as anggota')
                ->selectRaw('sum(if(pengusul.is_ketua = 1, pengusul.id, 0)) as ketua_id')
                ->leftJoin('pengusul', 'pengusul.paten_id', 'paten.id')
                ->leftJoin('jenis_paten', 'jenis_paten.id', 'paten.jenis_paten_id')
                // ->whereIn('paten.id', $listPaten)
                ->where('paten.status_paten_id', 1)
                ->groupBy('paten.id', 'paten.jenis_paten_id', 'jenis_paten.nama', 'paten.judul',
                    'paten.tanggal', 'paten.abstrak', 'paten.file_sertifikat',
                    'paten.file_pernyataan_kebaruan', 'paten.file_permohonan_paten', 'paten.file_pemeriksaan_substantif',
                    'paten.file_deskripsi_paten', 'paten.file_klaim', 'paten.file_gambar_teknik', 'paten.file_abstrak',
                    'paten.file_penyerahan_hak', 'paten.file_kepemilikan_inventor', 'paten.file_surat_pengalihan_hak')
                ->orderByDesc('paten.created_at')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('judul_jenis_paten', function($row) {
                    return $row->judul.'<br><span class="badge bg-info">'.$row->jenis_paten_nama.'</span>';
                })
                ->addColumn('link', function($row) {
                    $linkSertifikat = Utils::isNullOrEmpty($row->file_sertifikat) ? '<span class="text-danger">2. Link Sertifikat</span>' : '<a href="'.route('paten.link-sertifikat', $row->id).'" target="_blank">2. Link Sertifikat</a>';
                    return '<a href="'.route('paten.link-dokumen', $row->id).'" target="_blank">1. Link Dokumen</a><br>'.$linkSertifikat;
                })
                ->addColumn('status_dokumen', function($row) {
                    $isComplete = false;
                    if ($row->jenis_paten_id == 1) {
                        $isComplete = (!Utils::isNullOrEmpty($row->file_pernyataan_kebaruan) && !Utils::isNullOrEmpty($row->file_permohonan_paten)
                            && !Utils::isNullOrEmpty($row->file_pemeriksaan_substantif) && !Utils::isNullOrEmpty($row->file_deskripsi_paten)
                            && !Utils::isNullOrEmpty($row->file_klaim) && !Utils::isNullOrEmpty($row->file_gambar_teknik)
                            && !Utils::isNullOrEmpty($row->file_abstrak) && !Utils::isNullOrEmpty($row->file_penyerahan_hak)
                            && !Utils::isNullOrEmpty($row->file_kepemilikan_inventor));
                    } else if ($row->jenis_paten_id == 2) {
                        $isComplete = (!Utils::isNullOrEmpty($row->file_pernyataan_kebaruan) && !Utils::isNullOrEmpty($row->file_permohonan_paten)
                            && !Utils::isNullOrEmpty($row->file_pemeriksaan_substantif) && !Utils::isNullOrEmpty($row->file_deskripsi_paten)
                            && !Utils::isNullOrEmpty($row->file_klaim) && !Utils::isNullOrEmpty($row->file_gambar_teknik)
                            && !Utils::isNullOrEmpty($row->file_abstrak) && !Utils::isNullOrEmpty($row->file_penyerahan_hak)
                            && !Utils::isNullOrEmpty($row->file_kepemilikan_inventor) && !Utils::isNullOrEmpty($row->file_surat_pengalihan_hak));
                    }

                    return $isComplete ? '<span class="badge bg-success">Lengkap</span>' : '<span class="badge bg-warning">Belum Lengkap</span>';
                })
                ->addColumn('ketua', function($row) {
                    $ketua = Pengusul::find($row->ketua_id);
                    return $ketua->nama;
                })
                ->addColumn('action', function($row) {
                    $btnView = '<a class="btn btn-blue btn-xs waves-effect waves-light" href="'.route('paten.show', $row->id).'">View</a>';
                    $btnEdit = !Utils::isNullOrEmpty($row->file_sertifikat) ? '' : '<a class="btn btn-info btn-xs waves-effect waves-light" href="'.route('paten.edit', $row->id).'">Edit</a>';
                    $btnPass = '<a class="btn btn-warning btn-xs waves-effect waves-light" href="'.route('paten.pass-status-paten', [$row->id, Route::currentRouteName()]).'">Pass</a>';
                    $btnDelete = !Utils::isNullOrEmpty($row->file_sertifikat) ? '' :
                        '<form class="d-inline" action="'.route('paten.destroy', $row->id).'" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <button type="submit" class="btn btn-danger btn-xs waves-effect waves-light" onclick="return confirm(\'Anda yakin ingin menghapus?\')">Delete</button>
                        </form>';
                    return $btnView.$btnEdit.$btnPass.$btnDelete;
                })
                ->rawColumns(['judul_jenis_paten', 'link', 'status_dokumen', 'ketua', 'action'])
                ->make();
        }

        $tahun = range(date('Y'), 2010);
        $jenisPaten = JenisPaten::all();
        $statusPaten = StatusPaten::all();

        return view('paten.pengajuan-awal-admin')
            ->with('tahun', $tahun)
            ->with('jenisPaten', $jenisPaten)
            ->with('statusPaten', $statusPaten);
    }

    public static function terdaftar(Request $request)
    {
        if ($request->ajax())
        {
            // $listPaten = DB::table('paten')
            //     ->select('paten.id')
            //     ->leftJoin('pengusul', 'pengusul.paten_id', 'paten.id')
            //     ->where('pengusul.doskar_id', Auth()->user()->doskar_id)
            //     ->get()
            //     ->pluck('id');

            $data = DB::table('paten')
                ->select('paten.id', 'paten.jenis_paten_id', 'jenis_paten.nama as jenis_paten_nama', 'paten.judul', 'paten.tanggal', 'paten.abstrak', 'paten.file_sertifikat',
                    'paten.file_pernyataan_kebaruan', 'paten.file_permohonan_paten', 'paten.file_pemeriksaan_substantif',
                    'paten.file_deskripsi_paten', 'paten.file_klaim', 'paten.file_gambar_teknik', 'paten.file_abstrak',
                    'paten.file_penyerahan_hak', 'paten.file_kepemilikan_inventor', 'paten.file_surat_pengalihan_hak')
                ->selectRaw('count(pengusul.nama) as anggota')
                ->selectRaw('sum(if(pengusul.is_ketua = 1, pengusul.id, 0)) as ketua_id')
                ->leftJoin('pengusul', 'pengusul.paten_id', 'paten.id')
                ->leftJoin('jenis_paten', 'jenis_paten.id', 'paten.jenis_paten_id')
                // ->whereIn('paten.id', $listPaten)
                ->where('paten.status_paten_id', 2)
                ->groupBy('paten.id', 'paten.jenis_paten_id', 'jenis_paten.nama', 'paten.judul',
                    'paten.tanggal', 'paten.abstrak', 'paten.file_sertifikat',
                    'paten.file_pernyataan_kebaruan', 'paten.file_permohonan_paten', 'paten.file_pemeriksaan_substantif',
                    'paten.file_deskripsi_paten', 'paten.file_klaim', 'paten.file_gambar_teknik', 'paten.file_abstrak',
                    'paten.file_penyerahan_hak', 'paten.file_kepemilikan_inventor', 'paten.file_surat_pengalihan_hak')
                ->orderByDesc('paten.created_at')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('judul_jenis_paten', function($row) {
                    return $row->judul.'<br><span class="badge bg-info">'.$row->jenis_paten_nama.'</span>';
                })
                ->addColumn('link', function($row) {
                    $linkSertifikat = Utils::isNullOrEmpty($row->file_sertifikat) ? '<span class="text-danger">2. Link Sertifikat</span>' : '<a href="'.route('paten.link-sertifikat', $row->id).'" target="_blank">2. Link Sertifikat</a>';
                    return '<a href="'.route('paten.link-dokumen', $row->id).'" target="_blank">1. Link Dokumen</a><br>'.$linkSertifikat;
                })
                ->addColumn('status_dokumen', function($row) {
                    $isComplete = false;
                    if ($row->jenis_paten_id == 1) {
                        $isComplete = (!Utils::isNullOrEmpty($row->file_pernyataan_kebaruan) && !Utils::isNullOrEmpty($row->file_permohonan_paten)
                            && !Utils::isNullOrEmpty($row->file_pemeriksaan_substantif) && !Utils::isNullOrEmpty($row->file_deskripsi_paten)
                            && !Utils::isNullOrEmpty($row->file_klaim) && !Utils::isNullOrEmpty($row->file_gambar_teknik)
                            && !Utils::isNullOrEmpty($row->file_abstrak) && !Utils::isNullOrEmpty($row->file_penyerahan_hak)
                            && !Utils::isNullOrEmpty($row->file_kepemilikan_inventor));
                    } else if ($row->jenis_paten_id == 2) {
                        $isComplete = (!Utils::isNullOrEmpty($row->file_pernyataan_kebaruan) && !Utils::isNullOrEmpty($row->file_permohonan_paten)
                            && !Utils::isNullOrEmpty($row->file_pemeriksaan_substantif) && !Utils::isNullOrEmpty($row->file_deskripsi_paten)
                            && !Utils::isNullOrEmpty($row->file_klaim) && !Utils::isNullOrEmpty($row->file_gambar_teknik)
                            && !Utils::isNullOrEmpty($row->file_abstrak) && !Utils::isNullOrEmpty($row->file_penyerahan_hak)
                            && !Utils::isNullOrEmpty($row->file_kepemilikan_inventor) && !Utils::isNullOrEmpty($row->file_surat_pengalihan_hak));
                    }

                    return $isComplete ? '<span class="badge bg-success">Lengkap</span>' : '<span class="badge bg-warning">Belum Lengkap</span>';
                })
                ->addColumn('ketua', function($row) {
                    $ketua = Pengusul::find($row->ketua_id);
                    return $ketua->nama;
                })
                ->addColumn('action', function($row) {
                    $btnView = '<a class="btn btn-blue btn-xs waves-effect waves-light" href="'.route('paten.show', $row->id).'">View</a>';
                    $btnEdit = !Utils::isNullOrEmpty($row->file_sertifikat) ? '' : '<a class="btn btn-info btn-xs waves-effect waves-light" href="'.route('paten.edit', $row->id).'">Edit</a>';
                    $btnPass = '<a class="btn btn-warning btn-xs waves-effect waves-light" href="'.route('paten.pass-status-paten', [$row->id, Route::currentRouteName()]).'">Pass</a>';
                    $btnDelete = !Utils::isNullOrEmpty($row->file_sertifikat) ? '' :
                        '<form class="d-inline" action="'.route('paten.destroy', $row->id).'" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <button type="submit" class="btn btn-danger btn-xs waves-effect waves-light" onclick="return confirm(\'Anda yakin ingin menghapus?\')">Delete</button>
                        </form>';
                    return $btnView.$btnEdit.$btnPass.$btnDelete;
                })
                ->rawColumns(['judul_jenis_paten', 'link', 'status_dokumen', 'ketua', 'action'])
                ->make();
        }

        $tahun = range(date('Y'), 2010);
        $jenisPaten = JenisPaten::all();
        $statusPaten = StatusPaten::all();

        return view('paten.terdaftar-admin')
            ->with('tahun', $tahun)
            ->with('jenisPaten', $jenisPaten)
            ->with('statusPaten', $statusPaten);
    }

    public static function kelengkapanDokumen(Request $request)
    {
        if ($request->ajax())
        {
            // $listPaten = DB::table('paten')
            //     ->select('paten.id')
            //     ->leftJoin('pengusul', 'pengusul.paten_id', 'paten.id')
            //     ->where('pengusul.doskar_id', Auth()->user()->doskar_id)
            //     ->get()
            //     ->pluck('id');

            $data = DB::table('paten')
                ->select('paten.id', 'paten.jenis_paten_id', 'jenis_paten.nama as jenis_paten_nama', 'paten.judul', 'paten.tanggal', 'paten.abstrak', 'paten.file_sertifikat',
                    'paten.file_pernyataan_kebaruan', 'paten.file_permohonan_paten', 'paten.file_pemeriksaan_substantif',
                    'paten.file_deskripsi_paten', 'paten.file_klaim', 'paten.file_gambar_teknik', 'paten.file_abstrak',
                    'paten.file_penyerahan_hak', 'paten.file_kepemilikan_inventor', 'paten.file_surat_pengalihan_hak')
                ->selectRaw('count(pengusul.nama) as anggota')
                ->selectRaw('sum(if(pengusul.is_ketua = 1, pengusul.id, 0)) as ketua_id')
                ->leftJoin('pengusul', 'pengusul.paten_id', 'paten.id')
                ->leftJoin('jenis_paten', 'jenis_paten.id', 'paten.jenis_paten_id')
                // ->whereIn('paten.id', $listPaten)
                ->where('paten.status_paten_id', 3)
                ->groupBy('paten.id', 'paten.jenis_paten_id', 'jenis_paten.nama', 'paten.judul',
                    'paten.tanggal', 'paten.abstrak', 'paten.file_sertifikat',
                    'paten.file_pernyataan_kebaruan', 'paten.file_permohonan_paten', 'paten.file_pemeriksaan_substantif',
                    'paten.file_deskripsi_paten', 'paten.file_klaim', 'paten.file_gambar_teknik', 'paten.file_abstrak',
                    'paten.file_penyerahan_hak', 'paten.file_kepemilikan_inventor', 'paten.file_surat_pengalihan_hak')
                ->orderByDesc('paten.created_at')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('judul_jenis_paten', function($row) {
                    return $row->judul.'<br><span class="badge bg-info">'.$row->jenis_paten_nama.'</span>';
                })
                ->addColumn('link', function($row) {
                    $linkSertifikat = Utils::isNullOrEmpty($row->file_sertifikat) ? '<span class="text-danger">2. Link Sertifikat</span>' : '<a href="'.route('paten.link-sertifikat', $row->id).'" target="_blank">2. Link Sertifikat</a>';
                    return '<a href="'.route('paten.link-dokumen', $row->id).'" target="_blank">1. Link Dokumen</a><br>'.$linkSertifikat;
                })
                ->addColumn('status_dokumen', function($row) {
                    $isComplete = false;
                    if ($row->jenis_paten_id == 1) {
                        $isComplete = (!Utils::isNullOrEmpty($row->file_pernyataan_kebaruan) && !Utils::isNullOrEmpty($row->file_permohonan_paten)
                            && !Utils::isNullOrEmpty($row->file_pemeriksaan_substantif) && !Utils::isNullOrEmpty($row->file_deskripsi_paten)
                            && !Utils::isNullOrEmpty($row->file_klaim) && !Utils::isNullOrEmpty($row->file_gambar_teknik)
                            && !Utils::isNullOrEmpty($row->file_abstrak) && !Utils::isNullOrEmpty($row->file_penyerahan_hak)
                            && !Utils::isNullOrEmpty($row->file_kepemilikan_inventor));
                    } else if ($row->jenis_paten_id == 2) {
                        $isComplete = (!Utils::isNullOrEmpty($row->file_pernyataan_kebaruan) && !Utils::isNullOrEmpty($row->file_permohonan_paten)
                            && !Utils::isNullOrEmpty($row->file_pemeriksaan_substantif) && !Utils::isNullOrEmpty($row->file_deskripsi_paten)
                            && !Utils::isNullOrEmpty($row->file_klaim) && !Utils::isNullOrEmpty($row->file_gambar_teknik)
                            && !Utils::isNullOrEmpty($row->file_abstrak) && !Utils::isNullOrEmpty($row->file_penyerahan_hak)
                            && !Utils::isNullOrEmpty($row->file_kepemilikan_inventor) && !Utils::isNullOrEmpty($row->file_surat_pengalihan_hak));
                    }

                    return $isComplete ? '<span class="badge bg-success">Lengkap</span>' : '<span class="badge bg-warning">Belum Lengkap</span>';
                })
                ->addColumn('ketua', function($row) {
                    $ketua = Pengusul::find($row->ketua_id);
                    return $ketua->nama;
                })
                ->addColumn('action', function($row) {
                    $btnView = '<a class="btn btn-blue btn-xs waves-effect waves-light" href="'.route('paten.show', $row->id).'">View</a>';
                    $btnEdit = !Utils::isNullOrEmpty($row->file_sertifikat) ? '' : '<a class="btn btn-info btn-xs waves-effect waves-light" href="'.route('paten.edit', $row->id).'">Edit</a>';
                    $btnPass = '<a class="btn btn-warning btn-xs waves-effect waves-light" href="'.route('paten.pass-status-paten', [$row->id, Route::currentRouteName()]).'">Pass</a>';
                    $btnDelete = !Utils::isNullOrEmpty($row->file_sertifikat) ? '' :
                        '<form class="d-inline" action="'.route('paten.destroy', $row->id).'" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <button type="submit" class="btn btn-danger btn-xs waves-effect waves-light" onclick="return confirm(\'Anda yakin ingin menghapus?\')">Delete</button>
                        </form>';
                    return $btnView.$btnEdit.$btnPass.$btnDelete;
                })
                ->rawColumns(['judul_jenis_paten', 'link', 'status_dokumen', 'ketua', 'action'])
                ->make();
        }

        $tahun = range(date('Y'), 2010);
        $jenisPaten = JenisPaten::all();
        $statusPaten = StatusPaten::all();

        return view('paten.kelengkapan-dokumen-admin')
            ->with('tahun', $tahun)
            ->with('jenisPaten', $jenisPaten)
            ->with('statusPaten', $statusPaten);
    }

    public static function mediasi(Request $request)
    {
        if ($request->ajax())
        {
            // $listPaten = DB::table('paten')
            //     ->select('paten.id')
            //     ->leftJoin('pengusul', 'pengusul.paten_id', 'paten.id')
            //     ->where('pengusul.doskar_id', Auth()->user()->doskar_id)
            //     ->get()
            //     ->pluck('id');

            $data = DB::table('paten')
                ->select('paten.id', 'paten.jenis_paten_id', 'jenis_paten.nama as jenis_paten_nama', 'paten.judul', 'paten.tanggal', 'paten.abstrak', 'paten.file_sertifikat',
                    'paten.file_pernyataan_kebaruan', 'paten.file_permohonan_paten', 'paten.file_pemeriksaan_substantif',
                    'paten.file_deskripsi_paten', 'paten.file_klaim', 'paten.file_gambar_teknik', 'paten.file_abstrak',
                    'paten.file_penyerahan_hak', 'paten.file_kepemilikan_inventor', 'paten.file_surat_pengalihan_hak')
                ->selectRaw('count(pengusul.nama) as anggota')
                ->selectRaw('sum(if(pengusul.is_ketua = 1, pengusul.id, 0)) as ketua_id')
                ->leftJoin('pengusul', 'pengusul.paten_id', 'paten.id')
                ->leftJoin('jenis_paten', 'jenis_paten.id', 'paten.jenis_paten_id')
                // ->whereIn('paten.id', $listPaten)
                ->where('paten.status_paten_id', 4)
                ->groupBy('paten.id', 'paten.jenis_paten_id', 'jenis_paten.nama', 'paten.judul',
                    'paten.tanggal', 'paten.abstrak', 'paten.file_sertifikat',
                    'paten.file_pernyataan_kebaruan', 'paten.file_permohonan_paten', 'paten.file_pemeriksaan_substantif',
                    'paten.file_deskripsi_paten', 'paten.file_klaim', 'paten.file_gambar_teknik', 'paten.file_abstrak',
                    'paten.file_penyerahan_hak', 'paten.file_kepemilikan_inventor', 'paten.file_surat_pengalihan_hak')
                ->orderByDesc('paten.created_at')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('judul_jenis_paten', function($row) {
                    return $row->judul.'<br><span class="badge bg-info">'.$row->jenis_paten_nama.'</span>';
                })
                ->addColumn('link', function($row) {
                    $linkSertifikat = Utils::isNullOrEmpty($row->file_sertifikat) ? '<span class="text-danger">2. Link Sertifikat</span>' : '<a href="'.route('paten.link-sertifikat', $row->id).'" target="_blank">2. Link Sertifikat</a>';
                    return '<a href="'.route('paten.link-dokumen', $row->id).'" target="_blank">1. Link Dokumen</a><br>'.$linkSertifikat;
                })
                ->addColumn('status_dokumen', function($row) {
                    $isComplete = false;
                    if ($row->jenis_paten_id == 1) {
                        $isComplete = (!Utils::isNullOrEmpty($row->file_pernyataan_kebaruan) && !Utils::isNullOrEmpty($row->file_permohonan_paten)
                            && !Utils::isNullOrEmpty($row->file_pemeriksaan_substantif) && !Utils::isNullOrEmpty($row->file_deskripsi_paten)
                            && !Utils::isNullOrEmpty($row->file_klaim) && !Utils::isNullOrEmpty($row->file_gambar_teknik)
                            && !Utils::isNullOrEmpty($row->file_abstrak) && !Utils::isNullOrEmpty($row->file_penyerahan_hak)
                            && !Utils::isNullOrEmpty($row->file_kepemilikan_inventor));
                    } else if ($row->jenis_paten_id == 2) {
                        $isComplete = (!Utils::isNullOrEmpty($row->file_pernyataan_kebaruan) && !Utils::isNullOrEmpty($row->file_permohonan_paten)
                            && !Utils::isNullOrEmpty($row->file_pemeriksaan_substantif) && !Utils::isNullOrEmpty($row->file_deskripsi_paten)
                            && !Utils::isNullOrEmpty($row->file_klaim) && !Utils::isNullOrEmpty($row->file_gambar_teknik)
                            && !Utils::isNullOrEmpty($row->file_abstrak) && !Utils::isNullOrEmpty($row->file_penyerahan_hak)
                            && !Utils::isNullOrEmpty($row->file_kepemilikan_inventor) && !Utils::isNullOrEmpty($row->file_surat_pengalihan_hak));
                    }

                    return $isComplete ? '<span class="badge bg-success">Lengkap</span>' : '<span class="badge bg-warning">Belum Lengkap</span>';
                })
                ->addColumn('ketua', function($row) {
                    $ketua = Pengusul::find($row->ketua_id);
                    return $ketua->nama;
                })
                ->addColumn('action', function($row) {
                    $btnView = '<a class="btn btn-blue btn-xs waves-effect waves-light" href="'.route('paten.show', $row->id).'">View</a>';
                    $btnEdit = !Utils::isNullOrEmpty($row->file_sertifikat) ? '' : '<a class="btn btn-info btn-xs waves-effect waves-light" href="'.route('paten.edit', $row->id).'">Edit</a>';
                    $btnPass = '<a class="btn btn-warning btn-xs waves-effect waves-light" href="'.route('paten.pass-status-paten', [$row->id, Route::currentRouteName()]).'">Pass</a>';
                    $btnDelete = !Utils::isNullOrEmpty($row->file_sertifikat) ? '' :
                        '<form class="d-inline" action="'.route('paten.destroy', $row->id).'" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <button type="submit" class="btn btn-danger btn-xs waves-effect waves-light" onclick="return confirm(\'Anda yakin ingin menghapus?\')">Delete</button>
                        </form>';
                    return $btnView.$btnEdit.$btnPass.$btnDelete;
                })
                ->rawColumns(['judul_jenis_paten', 'link', 'status_dokumen', 'ketua', 'action'])
                ->make();
        }

        $tahun = range(date('Y'), 2010);
        $jenisPaten = JenisPaten::all();
        $statusPaten = StatusPaten::all();

        return view('paten.mediasi-admin')
            ->with('tahun', $tahun)
            ->with('jenisPaten', $jenisPaten)
            ->with('statusPaten', $statusPaten);
    }

    public static function granted(Request $request)
    {
        if ($request->ajax())
        {
            // $listPaten = DB::table('paten')
            //     ->select('paten.id')
            //     ->leftJoin('pengusul', 'pengusul.paten_id', 'paten.id')
            //     ->where('pengusul.doskar_id', Auth()->user()->doskar_id)
            //     ->get()
            //     ->pluck('id');

            $data = DB::table('paten')
                ->select('paten.id', 'paten.jenis_paten_id', 'jenis_paten.nama as jenis_paten_nama', 'paten.judul', 'paten.tanggal', 'paten.abstrak', 'paten.file_sertifikat',
                    'paten.file_pernyataan_kebaruan', 'paten.file_permohonan_paten', 'paten.file_pemeriksaan_substantif',
                    'paten.file_deskripsi_paten', 'paten.file_klaim', 'paten.file_gambar_teknik', 'paten.file_abstrak',
                    'paten.file_penyerahan_hak', 'paten.file_kepemilikan_inventor', 'paten.file_surat_pengalihan_hak')
                ->selectRaw('count(pengusul.nama) as anggota')
                ->selectRaw('sum(if(pengusul.is_ketua = 1, pengusul.id, 0)) as ketua_id')
                ->leftJoin('pengusul', 'pengusul.paten_id', 'paten.id')
                ->leftJoin('jenis_paten', 'jenis_paten.id', 'paten.jenis_paten_id')
                // ->whereIn('paten.id', $listPaten)
                ->where('paten.status_paten_id', 5)
                ->groupBy('paten.id', 'paten.jenis_paten_id', 'jenis_paten.nama', 'paten.judul',
                    'paten.tanggal', 'paten.abstrak', 'paten.file_sertifikat',
                    'paten.file_pernyataan_kebaruan', 'paten.file_permohonan_paten', 'paten.file_pemeriksaan_substantif',
                    'paten.file_deskripsi_paten', 'paten.file_klaim', 'paten.file_gambar_teknik', 'paten.file_abstrak',
                    'paten.file_penyerahan_hak', 'paten.file_kepemilikan_inventor', 'paten.file_surat_pengalihan_hak')
                ->orderByDesc('paten.created_at')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('judul_jenis_paten', function($row) {
                    return $row->judul.'<br><span class="badge bg-info">'.$row->jenis_paten_nama.'</span>';
                })
                ->addColumn('link', function($row) {
                    $linkSertifikat = Utils::isNullOrEmpty($row->file_sertifikat) ? '<span class="text-danger">2. Link Sertifikat</span>' : '<a href="'.route('paten.link-sertifikat', $row->id).'" target="_blank">2. Link Sertifikat</a>';
                    return '<a href="'.route('paten.link-dokumen', $row->id).'" target="_blank">1. Link Dokumen</a><br>'.$linkSertifikat;
                })
                ->addColumn('status_dokumen', function($row) {
                    $isComplete = false;
                    if ($row->jenis_paten_id == 1) {
                        $isComplete = (!Utils::isNullOrEmpty($row->file_pernyataan_kebaruan) && !Utils::isNullOrEmpty($row->file_permohonan_paten)
                            && !Utils::isNullOrEmpty($row->file_pemeriksaan_substantif) && !Utils::isNullOrEmpty($row->file_deskripsi_paten)
                            && !Utils::isNullOrEmpty($row->file_klaim) && !Utils::isNullOrEmpty($row->file_gambar_teknik)
                            && !Utils::isNullOrEmpty($row->file_abstrak) && !Utils::isNullOrEmpty($row->file_penyerahan_hak)
                            && !Utils::isNullOrEmpty($row->file_kepemilikan_inventor));
                    } else if ($row->jenis_paten_id == 2) {
                        $isComplete = (!Utils::isNullOrEmpty($row->file_pernyataan_kebaruan) && !Utils::isNullOrEmpty($row->file_permohonan_paten)
                            && !Utils::isNullOrEmpty($row->file_pemeriksaan_substantif) && !Utils::isNullOrEmpty($row->file_deskripsi_paten)
                            && !Utils::isNullOrEmpty($row->file_klaim) && !Utils::isNullOrEmpty($row->file_gambar_teknik)
                            && !Utils::isNullOrEmpty($row->file_abstrak) && !Utils::isNullOrEmpty($row->file_penyerahan_hak)
                            && !Utils::isNullOrEmpty($row->file_kepemilikan_inventor) && !Utils::isNullOrEmpty($row->file_surat_pengalihan_hak));
                    }

                    return $isComplete ? '<span class="badge bg-success">Lengkap</span>' : '<span class="badge bg-warning">Belum Lengkap</span>';
                })
                ->addColumn('ketua', function($row) {
                    $ketua = Pengusul::find($row->ketua_id);
                    return $ketua->nama;
                })
                ->addColumn('action', function($row) {
                    $btnView = '<a class="btn btn-blue btn-xs waves-effect waves-light" href="'.route('paten.show', $row->id).'">View</a>';
                    $btnEdit = !Utils::isNullOrEmpty($row->file_sertifikat) ? '' : '<a class="btn btn-info btn-xs waves-effect waves-light" href="'.route('paten.edit', $row->id).'">Edit</a>';
                    $btnDelete = !Utils::isNullOrEmpty($row->file_sertifikat) ? '' :
                        '<form class="d-inline" action="'.route('paten.destroy', $row->id).'" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <button type="submit" class="btn btn-danger btn-xs waves-effect waves-light" onclick="return confirm(\'Anda yakin ingin menghapus?\')">Delete</button>
                        </form>';
                    return $btnView.$btnEdit.$btnDelete;
                })
                ->rawColumns(['judul_jenis_paten', 'link', 'status_dokumen', 'ketua', 'action'])
                ->make();
        }

        $tahun = range(date('Y'), 2010);
        $jenisPaten = JenisPaten::all();
        $statusPaten = StatusPaten::all();

        return view('paten.granted-admin')
            ->with('tahun', $tahun)
            ->with('jenisPaten', $jenisPaten)
            ->with('statusPaten', $statusPaten);
    }

    public static function create()
    {
        return view('hak-cipta.create-admin');
    }

    public static function store(Request $request)
    {
        return null;
    }

    public function show(string $id)
    {
        $paten = Paten::find($id);
        $jenisPaten = JenisPaten::all();
        $doskar = Auth::user()->doskar;

        return view('paten.show-admin')
            ->with('paten', $paten)
            ->with('jenisPaten', $jenisPaten)
            ->with('doskar', $doskar);
    }

    public function edit(string $id)
    {
        $paten = Paten::find($id);
        $jenisPaten = JenisPaten::all();
        $doskar = Auth::user()->doskar;

        return view('paten.edit-admin')
            ->with('paten', $paten)
            ->with('jenisPaten', $jenisPaten)
            ->with('doskar', $doskar);
    }

    public static function update(PatenUpdateRequest $request, string $id)
    {
        $folderName = 'uploads/paten/';
        $request->validated();
        $paten = Paten::find($id);

        $paten->jenis_paten_id = $request->jenis_paten_id;
        $paten->judul = $request->judul;
        $paten->tanggal = $request->tanggal;
        $paten->abstrak = $request->abstrak;

        if ($request->hasFile('file_pernyataan_kebaruan')) {
            Storage::delete($folderName.$paten->file_pernyataan_kebaruan);
            $fileName = 'paten_'.$paten->id.'_'.time().'_file_pernyataan_kebaruan.'.$request->file_pernyataan_kebaruan->extension();
            $request->file_pernyataan_kebaruan->storeAs($folderName, $fileName);
            $paten->file_pernyataan_kebaruan = $fileName;
        }

        if ($request->hasFile('file_permohonan_paten')) {
            Storage::delete($folderName.$paten->file_permohonan_paten);
            $fileName= 'paten_'.$paten->id.'_'.time().'_file_permohonan_paten.'.$request->file_permohonan_paten->extension();
            $request->file_permohonan_paten->storeAs($folderName, $fileName);
            $paten->file_permohonan_paten = $fileName;
        }

        if ($request->hasFile('file_pemeriksaan_substantif')) {
            Storage::delete($folderName.$paten->file_pemeriksaan_substantif);
            $fileName = 'paten_'.$paten->id.'_'.time().'_file_pemeriksaan_substantif.'.$request->file_pemeriksaan_substantif->extension();
            $request->file_pemeriksaan_substantif->storeAs($folderName, $fileName);
            $paten->file_pemeriksaan_substantif = $fileName;
        }

        if ($request->hasFile('file_deskripsi_paten')) {
            Storage::delete($folderName.$paten->file_deskripsi_paten);
            $fileName = 'paten_'.$paten->id.'_'.time().'_file_deskripsi_paten.'.$request->file_deskripsi_paten->extension();
            $request->file_deskripsi_paten->storeAs($folderName, $fileName);
            $paten->file_deskripsi_paten = $fileName;
        }

        if ($request->hasFile('file_klaim')) {
            Storage::delete($folderName.$paten->file_klaim);
            $fileName = 'paten_'.$paten->id.'_'.time().'_file_klaim.'.$request->file_klaim->extension();
            $request->file_klaim->storeAs($folderName, $fileName);
            $paten->file_klaim = $fileName;
        }

        if ($request->hasFile('file_gambar_teknik')) {
            Storage::delete($folderName.$paten->file_gambar_teknik);
            $fileName = 'paten_'.$paten->id.'_'.time().'_file_gambar_teknik.'.$request->file_gambar_teknik->extension();
            $request->file_gambar_teknik->storeAs($folderName, $fileName);
            $paten->file_gambar_teknik = $fileName;
        }

        if ($request->hasFile('file_abstrak')) {
            Storage::delete($folderName.$paten->file_abstrak);
            $fileName = 'paten_'.$paten->id.'_'.time().'_file_abstrak.'.$request->file_abstrak->extension();
            $request->file_abstrak->storeAs($folderName, $fileName);
            $paten->file_abstrak = $fileName;
        }

        if ($request->hasFile('file_penyerahan_hak')) {
            Storage::delete($folderName.$paten->file_penyerahan_hak);
            $fileName = 'paten_'.$paten->id.'_'.time().'_file_penyerahan_hak.'.$request->file_penyerahan_hak->extension();
            $request->file_penyerahan_hak->storeAs($folderName, $fileName);
            $paten->file_penyerahan_hak = $fileName;
        }

        if ($request->hasFile('file_kepemilikan_inventor')) {
            Storage::delete($folderName.$paten->file_kepemilikan_inventor);
            $fileName = 'paten_'.$paten->id.'_'.time().'_file_kepemilikan_inventor.'.$request->file_kepemilikan_inventor->extension();
            $request->file_kepemilikan_inventor->storeAs($folderName, $fileName);
            $paten->file_kepemilikan_inventor = $fileName;
        }

        if ($request->hasFile('file_surat_pengalihan_hak')) {
            Storage::delete($folderName.$paten->file_surat_pengalihan_hak);
            $fileName = 'paten_'.$paten->id.'_'.time().'_file_surat_pengalihan_hak.'.$request->file_surat_pengalihan_hak->extension();
            $request->file_surat_pengalihan_hak->storeAs($folderName, $fileName);
            $paten->file_surat_pengalihan_hak = $fileName;
        }

        if ($request->hasFile('file_sertifikat')) {
            Storage::delete($folderName.$paten->file_sertifikat);
            $fileName = 'paten_'.$paten->id.'_'.time().'_file_sertifikat.'.$request->file_sertifikat->extension();
            $request->file_sertifikat->storeAs($folderName, $fileName);
            $paten->file_sertifikat = $fileName;
        }

        $paten->save();

        $idPengusul = Pengusul::where('paten_id', $id)->orderBy('urutan')->get()->pluck('id');
        Pengusul::destroy($idPengusul);

        for ($i=0; $i<count($request->tipe); $i++)
        {
            $pengusul = [
                'paten_id' => $paten->id,
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

        return redirect()->route('paten.pengajuan-awal')->with('success', 'Paten berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        //
    }
}
