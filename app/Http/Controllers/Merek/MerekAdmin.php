<?php

namespace App\Http\Controllers\Merek;

use App\Helpers\Utils;
use App\Http\Requests\MerekUpdateRequest;
use App\Models\JenisMerek;
use App\Models\Merek;
use App\Models\Pengusul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class MerekAdmin
{
    public static function index(Request $request)
    {
        if ($request->ajax())
        {
            // $listMerek = DB::table('merek')
            //     ->select('merek.id')
            //     ->leftJoin('pengusul', 'pengusul.merek_id', 'merek.id')
            //     ->where('pengusul.doskar_id', Auth()->user()->doskar_id)
            //     ->get()
            //     ->pluck('id');

            $data = DB::table('merek')
                ->select('merek.id', 'merek.jenis_merek_id', 'jenis_merek.nama as jenis_merek_nama', 'merek.judul', 'merek.tanggal', 'merek.uraian', 'merek.file_sertifikat',
                    'merek.file_uraian_merek', 'merek.file_ttd_pemohon', 'merek.file_gambar',
                    'merek.file_pernyataan_lisensi', 'merek.file_permohonan_merek', 'merek.file_perpanjangan_merek', 'merek.file_surat_pengalihan_hak',
                    'merek.file_surat_perubahan_nama_alamat', 'merek.file_penjelasan_pendaftaran_merek', 'merek.file_penjelasan_perpanjangan_merek',
                    'merek.file_penjelasan_pengalihan_hak')
                ->selectRaw('count(pengusul.nama) as anggota')
                ->selectRaw('max(if(pengusul.is_ketua = 1, pengusul.id, 0)) as ketua_id')
                ->leftJoin('pengusul', 'pengusul.merek_id', 'merek.id')
                ->leftJoin('jenis_merek', 'jenis_merek.id', 'merek.jenis_merek_id')
                // ->whereIn('merek.id', $listMerek)
                ->groupBy('merek.id', 'merek.jenis_merek_id', 'jenis_merek.nama', 'merek.judul',
                    'merek.tanggal', 'merek.uraian', 'merek.file_sertifikat',
                    'merek.file_uraian_merek', 'merek.file_ttd_pemohon', 'merek.file_gambar',
                    'merek.file_pernyataan_lisensi', 'merek.file_permohonan_merek', 'merek.file_perpanjangan_merek', 'merek.file_surat_pengalihan_hak',
                    'merek.file_surat_perubahan_nama_alamat', 'merek.file_penjelasan_pendaftaran_merek', 'merek.file_penjelasan_perpanjangan_merek',
                    'merek.file_penjelasan_pengalihan_hak')
                ->orderByDesc('merek.created_at')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('judul_jenis_merek', function($row) {
                    return $row->judul.'<br><span class="badge bg-info">'.$row->jenis_merek_nama.'</span>';
                })
                ->addColumn('link', function($row) {
                    $linkSertifikat = Utils::isNullOrEmpty($row->file_sertifikat) ? '<span class="text-danger">2. Link Sertifikat</span>' : '<a href="'.route('merek.link-sertifikat', $row->id).'" target="_blank">2. Link Sertifikat</a>';
                    return '<a href="'.route('merek.link-dokumen', $row->id).'" target="_blank">1. Link Dokumen</a><br>'.$linkSertifikat;
                })
                ->addColumn('status_dokumen', function($row) {
                    $isComplete = (!Utils::isNullOrEmpty($row->file_uraian_merek) && !Utils::isNullOrEmpty($row->file_ttd_pemohon)
                        && !Utils::isNullOrEmpty($row->file_gambar) && !Utils::isNullOrEmpty($row->file_pernyataan_lisensi)
                        && !Utils::isNullOrEmpty($row->file_permohonan_merek) && !Utils::isNullOrEmpty($row->file_perpanjangan_merek)
                        && !Utils::isNullOrEmpty($row->file_surat_pengalihan_hak) && !Utils::isNullOrEmpty($row->file_surat_perubahan_nama_alamat)
                        && !Utils::isNullOrEmpty($row->file_penjelasan_pendaftaran_merek) && !Utils::isNullOrEmpty($row->file_penjelasan_perpanjangan_merek)
                        && !Utils::isNullOrEmpty($row->file_penjelasan_pengalihan_hak));

                    return $isComplete ? '<span class="badge bg-success">Lengkap</span>' : '<span class="badge bg-warning">Belum Lengkap</span>';
                })
                ->addColumn('ketua', function($row) {
                    $ketua = Pengusul::find($row->ketua_id);
                    return $ketua->nama;
                })
                ->addColumn('action', function($row) {
                    $btnView = '<a class="btn btn-blue btn-xs waves-effect waves-light" href="'.route('merek.show', $row->id).'">View</a>';
                    $btnEdit = !Utils::isNullOrEmpty($row->file_sertifikat) ? '' : '<a class="btn btn-info btn-xs waves-effect waves-light" href="'.route('merek.edit', $row->id).'">Edit</a>';
                    $btnDelete = !Utils::isNullOrEmpty($row->file_sertifikat) ? '' :
                        '<form class="d-inline" action="'.route('merek.destroy', $row->id).'" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <button type="submit" class="btn btn-danger btn-xs waves-effect waves-light" onclick="return confirm(\'Anda yakin ingin menghapus?\')">Delete</button>
                        </form>';
                    return $btnView.$btnEdit.$btnDelete;
                })
                ->rawColumns(['judul_jenis_merek', 'link', 'status_dokumen', 'ketua', 'action'])
                ->make();
        }

        $tahun = range(date('Y'), 2010);
        $jenisMerek = JenisMerek::all();

        return view('merek.index-admin')
            ->with('tahun', $tahun)
            ->with('jenisMerek', $jenisMerek);
    }

    public static function create()
    {
        return view('hak-cipta.create-admin');
    }

    public static function store(Request $request)
    {
        return null;
    }

    public static function show(string $id)
    {
        //
    }

    public static function edit(string $id)
    {
        $doskar = Auth::user()->doskar;
        $merek = Merek::find($id);
        $jenisMerek = JenisMerek::all();
        $pengusul = Pengusul::where('merek_id', $id)->orderBy('urutan')->get();

        return view('merek.edit-admin')
            ->with('id', $id)
            ->with('doskar', $doskar)
            ->with('merek', $merek)
            ->with('jenisMerek', $jenisMerek)
            ->with('pengusul', $pengusul);
    }

    public static function update(MerekUpdateRequest $request, string $id)
    {
        $folderName = 'uploads/merek/';
        $request->validated();
        $merek = Merek::find($id);

        $merek->jenis_merek_id = $request->jenis_merek_id;
        $merek->judul = $request->judul;
        $merek->uraian = $request->uraian;

        if ($request->hasFile('file_uraian_merek')) {
            Storage::delete($folderName.$merek->file_uraian_merek);
            $fileName = 'merek_'.$merek->id.'_'.time().'_file_uraian_merek.'.$request->file_uraian_merek->extension();
            $request->file_uraian_merek->storeAs($folderName, $fileName);
            $merek->file_uraian_merek = $fileName;
        }

        if ($request->hasFile('file_ttd_pemohon')) {
            Storage::delete($folderName.$merek->file_ttd_pemohon);
            $fileName = 'merek_'.$merek->id.'_'.time().'_file_ttd_pemohon.'.$request->file_ttd_pemohon->extension();
            $request->file_ttd_pemohon->storeAs($folderName, $fileName);
            $merek->file_ttd_pemohon = $fileName;
        }

        if ($request->hasFile('file_gambar')) {
            Storage::delete($folderName.$merek->file_gambar);
            $fileName = 'merek_'.$merek->id.'_'.time().'_file_gambar.'.$request->file_gambar->extension();
            $request->file_gambar->storeAs($folderName, $fileName);
            $merek->file_gambar = $fileName;
        }

        if ($request->hasFile('file_pernyataan_lisensi')) {
            Storage::delete($folderName.$merek->file_pernyataan_lisensi);
            $fileName = 'merek_'.$merek->id.'_'.time().'_file_pernyataan_lisensi.'.$request->file_pernyataan_lisensi->extension();
            $request->file_pernyataan_lisensi->storeAs($folderName, $fileName);
            $merek->file_pernyataan_lisensi = $fileName;
        }

        if ($request->hasFile('file_permohonan_merek')) {
            Storage::delete($folderName.$merek->file_permohonan_merek);
            $fileName = 'merek_'.$merek->id.'_'.time().'_file_permohonan_merek.'.$request->file_permohonan_merek->extension();
            $request->file_permohonan_merek->storeAs($folderName, $fileName);
            $merek->file_permohonan_merek = $fileName;
        }

        if ($request->hasFile('file_perpanjangan_merek')) {
            Storage::delete($folderName.$merek->file_perpanjangan_merek);
            $fileName = 'merek_'.$merek->id.'_'.time().'_file_perpanjangan_merek.'.$request->file_perpanjangan_merek->extension();
            $request->file_perpanjangan_merek->storeAs($folderName, $fileName);
            $merek->file_perpanjangan_merek = $fileName;
        }

        if ($request->hasFile('file_surat_pengalihan_hak')) {
            Storage::delete($folderName.$merek->file_surat_pengalihan_hak);
            $fileName = 'merek_'.$merek->id.'_'.time().'_file_surat_pengalihan_hak.'.$request->file_surat_pengalihan_hak->extension();
            $request->file_surat_pengalihan_hak->storeAs($folderName, $fileName);
            $merek->file_surat_pengalihan_hak = $fileName;
        }

        if ($request->hasFile('file_surat_perubahan_nama_alamat')) {
            Storage::delete($folderName.$merek->file_surat_perubahan_nama_alamat);
            $fileName = 'merek_'.$merek->id.'_'.time().'_file_surat_perubahan_nama_alamat.'.$request->file_surat_perubahan_nama_alamat->extension();
            $request->file_surat_perubahan_nama_alamat->storeAs($folderName, $fileName);
            $merek->file_surat_perubahan_nama_alamat = $fileName;
        }

        if ($request->hasFile('file_penjelasan_pendaftaran_merek')) {
            Storage::delete($folderName.$merek->file_penjelasan_pendaftaran_merek);
            $fileName = 'merek_'.$merek->id.'_'.time().'_file_penjelasan_pendaftaran_merek.'.$request->file_penjelasan_pendaftaran_merek->extension();
            $request->file_penjelasan_pendaftaran_merek->storeAs($folderName, $fileName);
            $merek->file_penjelasan_pendaftaran_merek = $fileName;
        }

        if ($request->hasFile('file_penjelasan_perpanjangan_merek')) {
            Storage::delete($folderName.$merek->file_penjelasan_perpanjangan_merek);
            $fileName = 'merek_'.$merek->id.'_'.time().'_file_penjelasan_perpanjangan_merek.'.$request->file_penjelasan_perpanjangan_merek->extension();
            $request->file_penjelasan_perpanjangan_merek->storeAs($folderName, $fileName);
            $merek->file_penjelasan_perpanjangan_merek = $fileName;
        }

        if ($request->hasFile('file_penjelasan_pengalihan_hak')) {
            Storage::delete($folderName.$merek->file_penjelasan_pengalihan_hak);
            $fileName = 'merek_'.$merek->id.'_'.time().'_file_penjelasan_pengalihan_hak.'.$request->file_penjelasan_pengalihan_hak->extension();
            $request->file_penjelasan_pengalihan_hak->storeAs($folderName, $fileName);
            $merek->file_penjelasan_pengalihan_hak = $fileName;
        }

        if ($request->hasFile('file_sertifikat')) {
            Storage::delete($folderName.$merek->file_sertifikat);
            $fileSertifikat = 'merek_'.$merek->id.'_'.time().'_file_sertifikat.'.$request->file_sertifikat->extension();
            $request->file_sertifikat->storeAs($folderName, $fileSertifikat);
            $merek->file_sertifikat = $fileSertifikat;
        }

        $merek->save();

        $idPengusul = Pengusul::where('merek_id', $id)->orderBy('urutan')->get()->pluck('id');
        Pengusul::destroy($idPengusul);

        if ($request->tipe) {
            for ($i=0; $i<count($request->tipe); $i++)
            {
                $pengusul = [
                    'merek_id' => $merek->id,
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
        }

        return redirect()->route('merek.index')->with('success', 'Merek berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        //
    }
}
