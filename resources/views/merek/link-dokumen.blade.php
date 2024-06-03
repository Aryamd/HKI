@extends('layouts.vertical', ["page_title"=> "Merek"])

@section('css')
@endsection

@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Merek</a></li>
                        <li class="breadcrumb-item active">Dokumen Merek</li>
                    </ol>
                </div>
                <h4 class="page-title">Link Dokumen</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="link-dokumen" class="table dt-responsive w-auto">
                        <thead>
                            <tr>
                                <th>NAMA FILE</th>
                                <th>LINK VIEW</th>
                                <th>LINK DOWNLOAD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Uraian Merek</th>
                                <td>
                                    @if ($merek->file_uraian_merek)
                                    <a href="{{ route('merek.view-dokumen', $merek->file_uraian_merek) }}" target="_blank">View</a>
                                    @else
                                    None
                                    @endif
                                </td>
                                <td>
                                    @if ($merek->file_uraian_merek)
                                    <a href="{{ route('merek.download-dokumen', $merek->file_uraian_merek) }}">Download</a>
                                    @else
                                    None
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Tanda Tangan Pemohon</th>
                                <td>
                                    @if ($merek->file_ttd_pemohon)
                                    <a href="{{ route('merek.view-dokumen', $merek->file_ttd_pemohon) }}" target="_blank">View</a>
                                    @else
                                    None
                                    @endif
                                </td>
                                <td>
                                    @if ($merek->file_ttd_pemohon)
                                    <a href="{{ route('merek.download-dokumen', $merek->file_ttd_pemohon) }}">Download</a>
                                    @else
                                    None
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Gambar Merek</th>
                                <td>
                                    @if ($merek->file_gambar)
                                    <a href="{{ route('merek.view-dokumen', $merek->file_gambar) }}" target="_blank">View</a>
                                    @else
                                    None
                                    @endif
                                </td>
                                <td>
                                    @if ($merek->file_gambar)
                                    <a href="{{ route('merek.download-dokumen', $merek->file_gambar) }}">Download</a>
                                    @else
                                    None
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Formulir Pernyataan Lisensi</th>
                                <td>
                                    @if ($merek->file_pernyataan_lisensi)
                                    <a href="{{ route('merek.view-dokumen', $merek->file_pernyataan_lisensi) }}" target="_blank">View</a>
                                    @else
                                    None
                                    @endif
                                </td>
                                <td>
                                    @if ($merek->file_pernyataan_lisensi)
                                    <a href="{{ route('merek.download-dokumen', $merek->file_pernyataan_lisensi) }}">Download</a>
                                    @else
                                    None
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Formulir Permohonan Merek</th>
                                <td>
                                    @if ($merek->file_permohonan_merek)
                                    <a href="{{ route('merek.view-dokumen', $merek->file_permohonan_merek) }}" target="_blank">View</a>
                                    @else
                                    None
                                    @endif
                                </td>
                                <td>
                                    @if ($merek->file_permohonan_merek)
                                    <a href="{{ route('merek.download-dokumen', $merek->file_permohonan_merek) }}">Download</a>
                                    @else
                                    None
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Formulir Perpanjangan Merek</th>
                                <td>
                                    @if ($merek->file_perpanjangan_merek)
                                    <a href="{{ route('merek.view-dokumen', $merek->file_perpanjangan_merek) }}" target="_blank">View</a>
                                    @else
                                    None
                                    @endif
                                </td>
                                <td>
                                    @if ($merek->file_perpanjangan_merek)
                                    <a href="{{ route('merek.download-dokumen', $merek->file_perpanjangan_merek) }}">Download</a>
                                    @else
                                    None
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Surat Pengalihan Hak</th>
                                <td>
                                    @if ($merek->file_surat_pengalihan_hak)
                                    <a href="{{ route('merek.view-dokumen', $merek->file_surat_pengalihan_hak) }}" target="_blank">View</a>
                                    @else
                                    None
                                    @endif
                                </td>
                                <td>
                                    @if ($merek->file_surat_pengalihan_hak)
                                    <a href="{{ route('merek.download-dokumen', $merek->file_surat_pengalihan_hak) }}">Download</a>
                                    @else
                                    None
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Surat Perubahan Nama dan Alamat</th>
                                <td>
                                    @if ($merek->file_surat_perubahan_nama_alamat)
                                    <a href="{{ route('merek.view-dokumen', $merek->file_surat_perubahan_nama_alamat) }}" target="_blank">View</a>
                                    @else
                                    None
                                    @endif
                                </td>
                                <td>
                                    @if ($merek->file_surat_perubahan_nama_alamat)
                                    <a href="{{ route('merek.download-dokumen', $merek->file_surat_perubahan_nama_alamat) }}">Download</a>
                                    @else
                                    None
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Surat Penjelasan Pendaftaran Merek</th>
                                <td>
                                    @if ($merek->file_penjelasan_pendaftaran_merek)
                                    <a href="{{ route('merek.view-dokumen', $merek->file_penjelasan_pendaftaran_merek) }}" target="_blank">View</a>
                                    @else
                                    None
                                    @endif
                                </td>
                                <td>
                                    @if ($merek->file_penjelasan_pendaftaran_merek)
                                    <a href="{{ route('merek.download-dokumen', $merek->file_penjelasan_pendaftaran_merek) }}">Download</a>
                                    @else
                                    None
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Surat Penjelasan Perpanjangan Merek</th>
                                <td>
                                    @if ($merek->file_penjelasan_perpanjangan_merek)
                                    <a href="{{ route('merek.view-dokumen', $merek->file_penjelasan_perpanjangan_merek) }}" target="_blank">View</a>
                                    @else
                                    None
                                    @endif
                                </td>
                                <td>
                                    @if ($merek->file_penjelasan_perpanjangan_merek)
                                    <a href="{{ route('merek.download-dokumen', $merek->file_penjelasan_perpanjangan_merek) }}">Download</a>
                                    @else
                                    None
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Surat Penjelasan Pengalihan Hak</th>
                                <td>
                                    @if ($merek->file_penjelasan_pengalihan_hak)
                                    <a href="{{ route('merek.view-dokumen', $merek->file_penjelasan_pengalihan_hak) }}" target="_blank">View</a>
                                    @else
                                    None
                                    @endif
                                </td>
                                <td>
                                    @if ($merek->file_penjelasan_pengalihan_hak)
                                    <a href="{{ route('merek.download-dokumen', $merek->file_penjelasan_pengalihan_hak) }}">Download</a>
                                    @else
                                    None
                                    @endif
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

</div> <!-- container -->
@endsection

@section('script')

<script>
    $(document).ready(function() {

    });
</script>
@endsection
