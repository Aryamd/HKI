<?php

namespace App\Http\Controllers\DesainIndustri;

use App\Helpers\Utils;
use App\Http\Requests\DesainIndustriUpdateRequest;
use App\Models\DesainIndustri;
use App\Models\JenisDesainIndustri;
use App\Models\Pengusul;
use App\Models\SubJenisDesainIndustri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DesainIndustriAdmin
{
    public static function index(Request $request)
    {
        if ($request->ajax())
        {
            // $listDesainIndustri = DB::table('desain_industri')
            //     ->select('desain_industri.id')
            //     ->leftJoin('pengusul', 'pengusul.desain_industri_id', 'desain_industri.id')
            //     ->where('pengusul.doskar_id', Auth()->user()->doskar_id)
            //     ->get()
            //     ->pluck('id');

            $data = DB::table('desain_industri')
                ->select('desain_industri.id', 'desain_industri.jenis_desain_industri_id', 'jenis_desain_industri.nama as jenis_desain_industri_nama',
                    'desain_industri.sub_jenis_desain_industri_id', 'sub_jenis_desain_industri.nama as sub_jenis_desain_industri_nama',
                    'desain_industri.judul', 'desain_industri.tanggal', 'desain_industri.uraian', 'desain_industri.file_sertifikat',
                    'desain_industri.file_gambar_desain_industri', 'desain_industri.file_rincian_gambar_desain_industri', 'desain_industri.file_gambar_tampak_depan',
                    'desain_industri.file_gambar_tampak_belakang', 'desain_industri.file_gambar_tampak_samping_kiri', 'desain_industri.file_gambar_tampak_samping_kanan',
                    'desain_industri.file_gambar_tampak_atas', 'desain_industri.file_uraian_desain_industri', 'desain_industri.file_surat_pernyataan_kepemilikan',
                    'desain_industri.file_surat_pernyataan_pengalihan_hak')
                ->selectRaw('count(pengusul.nama) as anggota')
                ->selectRaw('max(if(pengusul.is_ketua = 1, pengusul.id, 0)) as ketua_id')
                ->leftJoin('pengusul', 'pengusul.desain_industri_id', 'desain_industri.id')
                ->leftJoin('jenis_desain_industri', 'jenis_desain_industri.id', 'desain_industri.jenis_desain_industri_id')
                ->leftJoin('sub_jenis_desain_industri', 'sub_jenis_desain_industri.id', 'desain_industri.sub_jenis_desain_industri_id')
                // ->whereIn('desain_industri.id', $listDesainIndustri)
                ->groupBy('desain_industri.id', 'desain_industri.jenis_desain_industri_id', 'jenis_desain_industri.nama',
                    'desain_industri.sub_jenis_desain_industri_id', 'sub_jenis_desain_industri.nama',
                    'desain_industri.judul', 'desain_industri.tanggal', 'desain_industri.uraian', 'desain_industri.file_sertifikat',
                    'desain_industri.file_gambar_desain_industri', 'desain_industri.file_rincian_gambar_desain_industri', 'desain_industri.file_gambar_tampak_depan',
                    'desain_industri.file_gambar_tampak_belakang', 'desain_industri.file_gambar_tampak_samping_kiri', 'desain_industri.file_gambar_tampak_samping_kanan',
                    'desain_industri.file_gambar_tampak_atas', 'desain_industri.file_uraian_desain_industri', 'desain_industri.file_surat_pernyataan_kepemilikan',
                    'desain_industri.file_surat_pernyataan_pengalihan_hak')
                ->orderByDesc('desain_industri.created_at')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('judul_jenis_desain_industri', function($row) {
                    return $row->judul.'<br><span class="badge bg-info">'.$row->jenis_desain_industri_nama.' → '.$row->sub_jenis_desain_industri_nama.'</span>';
                })
                ->addColumn('link', function($row) {
                    $linkSertifikat = Utils::isNullOrEmpty($row->file_sertifikat) ? '<span class="text-danger">2. Link Sertifikat</span>' :
                        '<a href="'.route('desain-industri.link-sertifikat', $row->id).'" target="_blank">2. Link Sertifikat</a>';
                    return '<a href="'.route('desain-industri.link-dokumen', $row->id).'" target="_blank">1. Link Dokumen</a><br>'.$linkSertifikat;
                })
                ->addColumn('status_dokumen', function($row) {
                    $isComplete = (!Utils::isNullOrEmpty($row->file_gambar_desain_industri) && !Utils::isNullOrEmpty($row->file_rincian_gambar_desain_industri)
                        && !Utils::isNullOrEmpty($row->file_gambar_tampak_depan) && !Utils::isNullOrEmpty($row->file_gambar_tampak_belakang)
                        && !Utils::isNullOrEmpty($row->file_gambar_tampak_samping_kiri) && !Utils::isNullOrEmpty($row->file_gambar_tampak_samping_kanan)
                        && !Utils::isNullOrEmpty($row->file_gambar_tampak_atas) && !Utils::isNullOrEmpty($row->file_uraian_desain_industri)
                        && !Utils::isNullOrEmpty($row->file_surat_pernyataan_kepemilikan) && !Utils::isNullOrEmpty($row->file_surat_pernyataan_pengalihan_hak));

                    return $isComplete ? '<span class="badge bg-success">Lengkap</span>' : '<span class="badge bg-warning">Belum Lengkap</span>';
                })
                ->addColumn('ketua', function($row) {
                    $ketua = Pengusul::find($row->ketua_id);
                    return $ketua->nama;
                })
                ->addColumn('action', function($row) {
                    $btnView = '<a class="btn btn-blue btn-xs waves-effect waves-light" href="'.route('desain-industri.show', $row->id).'">View</a>';
                    $btnEdit = !Utils::isNullOrEmpty($row->file_sertifikat) ? '' :
                        '<a class="btn btn-info btn-xs waves-effect waves-light" href="'.route('desain-industri.edit', $row->id).'">Edit</a>';
                    $btnDelete = !Utils::isNullOrEmpty($row->file_sertifikat) ? '' :
                        '<form class="d-inline" action="'.route('desain-industri.destroy', $row->id).'" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <button type="submit" class="btn btn-danger btn-xs waves-effect waves-light" onclick="return confirm(\'Anda yakin ingin menghapus?\')">Delete</button>
                        </form>';
                    return $btnView.$btnEdit.$btnDelete;
                })
                ->rawColumns(['judul_jenis_desain_industri', 'link', 'status_dokumen', 'ketua', 'action'])
                ->make();
        }

        return view('desain-industri.index-admin');
    }

    public static function create()
    {
        //
    }

    public static function store(Request $request)
    {
        //
    }

    public static function show(string $id)
    {
        $desainIndustri = DesainIndustri::find($id);
        $jenisDesainIndustri = JenisDesainIndustri::all();
        $subJenisDesainIndustri = SubJenisDesainIndustri::all();
        $pengusul = Pengusul::where('desain_industri_id', $id)->orderBy('urutan')->get();

        return view('desain-industri.show-admin')
            ->with('id', $id)
            ->with('desainIndustri', $desainIndustri)
            ->with('jenisDesainIndustri', $jenisDesainIndustri)
            ->with('subJenisDesainIndustri', $subJenisDesainIndustri)
            ->with('pengusul', $pengusul);
    }

    public static function edit(string $id)
    {
        $desainIndustri = DesainIndustri::find($id);
        $jenisDesainIndustri = JenisDesainIndustri::all();
        $subJenisDesainIndustri = SubJenisDesainIndustri::all();
        $pengusul = Pengusul::where('desain_industri_id', $id)->orderBy('urutan')->get();

        return view('desain-industri.edit-admin')
            ->with('id', $id)
            ->with('desainIndustri', $desainIndustri)
            ->with('jenisDesainIndustri', $jenisDesainIndustri)
            ->with('subJenisDesainIndustri', $subJenisDesainIndustri)
            ->with('pengusul', $pengusul);
    }

    public static function update(DesainIndustriUpdateRequest $request, string $id)
    {
        $folderName = 'uploads/desain-industri/';
        $request->validated();
        $desainIndustri = DesainIndustri::find($id);

        $number = mt_rand(1000000, 9999999);
        $prefixFileName = 'desain_industri_'.$desainIndustri->id.'_'.uniqid().'_'.$number.'_';

        $desainIndustri->jenis_desain_industri_id = $request->jenis_desain_industri_id;
        $desainIndustri->sub_jenis_desain_industri_id = $request->sub_jenis_desain_industri_id;
        $desainIndustri->judul = $request->judul;
        $desainIndustri->tanggal = $request->tanggal;
        $desainIndustri->uraian = $request->uraian;

        if ($request->hasFile('file_gambar_desain_industri')) {
            Storage::delete($folderName.$desainIndustri->file_gambar_desain_industri);
            $fileName = $prefixFileName.'file_gambar_desain_industri.'.$request->file_gambar_desain_industri->extension();
            $request->file_gambar_desain_industri->storeAs($folderName, $fileName);
            $desainIndustri->file_gambar_desain_industri = $fileName;
        }

        if ($request->hasFile('file_rincian_gambar_desain_industri')) {
            Storage::delete($folderName.$desainIndustri->file_rincian_gambar_desain_industri);
            $fileName = $prefixFileName.'file_rincian_gambar_desain_industri.'.$request->file_rincian_gambar_desain_industri->extension();
            $request->file_rincian_gambar_desain_industri->storeAs($folderName, $fileName);
            $desainIndustri->file_rincian_gambar_desain_industri = $fileName;
        }

        if ($request->hasFile('file_gambar_tampak_depan')) {
            Storage::delete($folderName.$desainIndustri->file_gambar_tampak_depan);
            $fileName = $prefixFileName.'file_gambar_tampak_depan.'.$request->file_gambar_tampak_depan->extension();
            $request->file_gambar_tampak_depan->storeAs($folderName, $fileName);
            $desainIndustri->file_gambar_tampak_depan = $fileName;
        }

        if ($request->hasFile('file_gambar_tampak_belakang')) {
            Storage::delete($folderName.$desainIndustri->file_gambar_tampak_belakang);
            $fileName = $prefixFileName.'file_gambar_tampak_belakang.'.$request->file_gambar_tampak_belakang->extension();
            $request->file_gambar_tampak_belakang->storeAs($folderName, $fileName);
            $desainIndustri->file_gambar_tampak_belakang = $fileName;
        }

        if ($request->hasFile('file_gambar_tampak_samping_kiri')) {
            Storage::delete($folderName.$desainIndustri->file_gambar_tampak_samping_kiri);
            $fileName = $prefixFileName.'file_gambar_tampak_samping_kiri.'.$request->file_gambar_tampak_samping_kiri->extension();
            $request->file_gambar_tampak_samping_kiri->storeAs($folderName, $fileName);
            $desainIndustri->file_gambar_tampak_samping_kiri = $fileName;
        }

        if ($request->hasFile('file_gambar_tampak_samping_kanan')) {
            Storage::delete($folderName.$desainIndustri->file_gambar_tampak_samping_kanan);
            $fileName = $prefixFileName.'file_gambar_tampak_samping_kanan.'.$request->file_gambar_tampak_samping_kanan->extension();
            $request->file_gambar_tampak_samping_kanan->storeAs($folderName, $fileName);
            $desainIndustri->file_gambar_tampak_samping_kanan = $fileName;
        }

        if ($request->hasFile('file_gambar_tampak_atas')) {
            Storage::delete($folderName.$desainIndustri->file_gambar_tampak_atas);
            $fileName = $prefixFileName.'file_gambar_tampak_atas.'.$request->file_gambar_tampak_atas->extension();
            $request->file_gambar_tampak_atas->storeAs($folderName, $fileName);
            $desainIndustri->file_gambar_tampak_atas = $fileName;
        }

        if ($request->hasFile('file_uraian_desain_industri')) {
            Storage::delete($folderName.$desainIndustri->file_uraian_desain_industri);
            $fileName = $prefixFileName.'file_uraian_desain_industri.'.$request->file_uraian_desain_industri->extension();
            $request->file_uraian_desain_industri->storeAs($folderName, $fileName);
            $desainIndustri->file_uraian_desain_industri = $fileName;
        }

        if ($request->hasFile('file_surat_pernyataan_kepemilikan')) {
            Storage::delete($folderName.$desainIndustri->file_surat_pernyataan_kepemilikan);
            $fileName = $prefixFileName.'file_surat_pernyataan_kepemilikan.'.$request->file_surat_pernyataan_kepemilikan->extension();
            $request->file_surat_pernyataan_kepemilikan->storeAs($folderName, $fileName);
            $desainIndustri->file_surat_pernyataan_kepemilikan = $fileName;
        }

        if ($request->hasFile('file_surat_pernyataan_pengalihan_hak')) {
            Storage::delete($folderName.$desainIndustri->file_surat_pernyataan_pengalihan_hak);
            $fileName = $prefixFileName.'file_surat_pernyataan_pengalihan_hak.'.$request->file_surat_pernyataan_pengalihan_hak->extension();
            $request->file_surat_pernyataan_pengalihan_hak->storeAs($folderName, $fileName);
            $desainIndustri->file_surat_pernyataan_pengalihan_hak = $fileName;
        }

        if ($request->hasFile('file_sertifikat')) {
            Storage::delete($folderName.$desainIndustri->file_sertifikat);
            $fileName = $prefixFileName.'file_sertifikat.'.$request->file_sertifikat->extension();
            $request->file_sertifikat->storeAs($folderName, $fileName);
            $desainIndustri->file_sertifikat = $fileName;
        }

        $desainIndustri->save();

        $idPengusul = Pengusul::where('desain_industri_id', $id)->orderBy('urutan')->get()->pluck('id');
        Pengusul::destroy($idPengusul);

        for ($i=0; $i<count($request->tipe); $i++)
        {
            $pengusul = [
                'desain_industri_id' => $desainIndustri->id,
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

        return redirect()->route('desain-industri.index')->with('success', 'Desain Industri berhasil diperbarui');
    }

    public static function destroy(string $id)
    {
        //
    }
}
