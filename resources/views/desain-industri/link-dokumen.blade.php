@extends('layouts.vertical', ["page_title"=> "Desain Industri"])

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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Desain Industri</a></li>
                        <li class="breadcrumb-item active">Dokumen Desain Industri</li>
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
                        <tbody>
                            <tr>
                                <th>Uraian Desain Industri</th>
                                <td><a href="{{ route('desain-industri.view-dokumen', $desainIndustri->file_uraian_desain_industri) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('desain-industri.download-dokumen', $desainIndustri->file_uraian_desain_industri) }}">Download</a></td>
                            </tr>
                            <tr>
                                <th>Gambar atau Foto Desain Industri</th>
                                <td><a href="{{ route('desain-industri.view-dokumen', $desainIndustri->file_gambar_desain_industri) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('desain-industri.download-dokumen', $desainIndustri->file_gambar_desain_industri) }}">Download</a></td>
                            </tr>
                            <tr>
                                <th>Rincian Gambar Desain Industri (Perspektif)</th>
                                <td><a href="{{ route('desain-industri.view-dokumen', $desainIndustri->file_rincian_gambar_desain_industri) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('desain-industri.download-dokumen', $desainIndustri->file_rincian_gambar_desain_industri) }}">Download</a></td>
                            </tr>
                            <tr>
                                <th>Rincian Gambar Desain Industri (Tampak Depan)</th>
                                <td><a href="{{ route('desain-industri.view-dokumen', $desainIndustri->file_gambar_tampak_depan) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('desain-industri.download-dokumen', $desainIndustri->file_gambar_tampak_depan) }}">Download</a></td>
                            </tr>
                            <tr>
                                <th>Rincian Gambar Desain Industri (Tampak Belakang)</th>
                                <td><a href="{{ route('desain-industri.view-dokumen', $desainIndustri->file_gambar_tampak_belakang) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('desain-industri.download-dokumen', $desainIndustri->file_gambar_tampak_belakang) }}">Download</a></td>
                            </tr>
                            <tr>
                                <th>Rincian Gambar Desain Industri (Tampak Samping Kiri)</th>
                                <td><a href="{{ route('desain-industri.view-dokumen', $desainIndustri->file_gambar_tampak_samping_kiri) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('desain-industri.download-dokumen', $desainIndustri->file_gambar_tampak_samping_kiri) }}">Download</a></td>
                            </tr>
                            <tr>
                                <th>Rincian Gambar Desain Industri (Tampak Samping Kanan)</th>
                                <td><a href="{{ route('desain-industri.view-dokumen', $desainIndustri->file_gambar_tampak_samping_kanan) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('desain-industri.download-dokumen', $desainIndustri->file_gambar_tampak_samping_kanan) }}">Download</a></td>
                            </tr>
                            <tr>
                                <th>Rincian Gambar Desain Industri (Tampak Atas)</th>
                                <td><a href="{{ route('desain-industri.view-dokumen', $desainIndustri->file_gambar_tampak_atas) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('desain-industri.download-dokumen', $desainIndustri->file_gambar_tampak_atas) }}">Download</a></td>
                            </tr>
                            <tr>
                                <th>Surat Pernyataan Kepemilikan Desain Industri</th>
                                <td><a href="{{ route('desain-industri.view-dokumen', $desainIndustri->file_surat_pernyataan_kepemilikan) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('desain-industri.download-dokumen', $desainIndustri->file_surat_pernyataan_kepemilikan) }}">Download</a></td>
                            </tr>
                            <tr>
                                <th>Surat Pernyataan Pengalihan Hak (jika pemohon dan pendesain berbeda)</th>
                                <td><a href="{{ route('desain-industri.view-dokumen', $desainIndustri->file_surat_pernyataan_pengalihan_hak) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('desain-industri.download-dokumen', $desainIndustri->file_surat_pernyataan_pengalihan_hak) }}">Download</a></td>
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
