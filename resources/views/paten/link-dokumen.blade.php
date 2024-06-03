@extends('layouts.vertical', ["page_title"=> "Paten"])

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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Paten</a></li>
                        <li class="breadcrumb-item active">Dokumen Paten</li>
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
                                <th>Surat Pernyataan Kebaruan</th>
                                <td><a href="{{ route('paten.view-dokumen', $paten->file_pernyataan_kebaruan) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('paten.download-dokumen', $paten->file_pernyataan_kebaruan) }}">Download</a></td>
                            </tr>
                            <tr>
                                <th>Formulir Permohonan Paten</th>
                                <td><a href="{{ route('paten.view-dokumen', $paten->file_permohonan_paten) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('paten.download-dokumen', $paten->file_permohonan_paten) }}">Download</a></td>
                            </tr>
                            <tr>
                                <th>Formulir Pemeriksaan Substantif</th>
                                <td><a href="{{ route('paten.view-dokumen', $paten->file_pemeriksaan_substantif) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('paten.download-dokumen', $paten->file_pemeriksaan_substantif) }}">Download</a></td>
                            </tr>
                            <tr>
                                <th>Deskripsi Paten</th>
                                <td><a href="{{ route('paten.view-dokumen', $paten->file_deskripsi_paten) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('paten.download-dokumen', $paten->file_deskripsi_paten) }}">Download</a></td>
                            </tr>
                            <tr>
                                <th>Klaim</th>
                                <td><a href="{{ route('paten.view-dokumen', $paten->file_klaim) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('paten.download-dokumen', $paten->file_klaim) }}">Download</a></td>
                            </tr>
                            <tr>
                                <th>Gambar Teknik</th>
                                <td><a href="{{ route('paten.view-dokumen', $paten->file_gambar_teknik) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('paten.download-dokumen', $paten->file_gambar_teknik) }}">Download</a></td>
                            </tr>
                            <tr>
                                <th>Abstrak</th>
                                <td><a href="{{ route('paten.view-dokumen', $paten->file_abstrak) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('paten.download-dokumen', $paten->file_abstrak) }}">Download</a></td>
                            </tr>
                            <tr>
                                <th>Penyerahan Hak</th>
                                <td><a href="{{ route('paten.view-dokumen', $paten->file_penyerahan_hak) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('paten.download-dokumen', $paten->file_penyerahan_hak) }}">Download</a></td>
                            </tr>
                            <tr>
                                <th>Kepemilikan Inventor</th>
                                <td><a href="{{ route('paten.view-dokumen', $paten->file_kepemilikan_inventor) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('paten.download-dokumen', $paten->file_kepemilikan_inventor) }}">Download</a></td>
                            </tr>
                            <tr>
                                <th>Surat Pengalihan Hak (SPH)</th>
                                <td><a href="{{ route('paten.view-dokumen', $paten->file_surat_pengalihan_hak) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('paten.download-dokumen', $paten->file_surat_pengalihan_hak) }}">Download</a></td>
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
