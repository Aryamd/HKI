@extends('layouts.vertical', ["page_title"=> "Hak Cipta"])

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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Hak Cipta</a></li>
                        <li class="breadcrumb-item active">Dokumen Hak Cipta</li>
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
                                <th>Formulir Permohonan Hak Cipta (Ttd sudah lengkap)</th>
                                <td><a href="{{ route('hak-cipta.view-dokumen', $hakCipta->file_permohonan) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('hak-cipta.download-dokumen', $hakCipta->file_permohonan) }}">Download</a></td>
                            </tr>
                            <tr>
                                <th>Formulir Surat Pengalihan Hak Cipta (SPH) (Ttd sudah lengkap dan bermaterai)</th>
                                <td><a href="{{ route('hak-cipta.view-dokumen', $hakCipta->file_pengalihan) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('hak-cipta.download-dokumen', $hakCipta->file_pengalihan) }}">Download</a></td>
                            </tr>
                            <tr>
                                <th>Formulir Surat Pernyataan Hak Cipta (Ttd dan bermaterai dikosongi dulu)</th>
                                <td><a href="{{ route('hak-cipta.view-dokumen', $hakCipta->file_pernyataan) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('hak-cipta.download-dokumen', $hakCipta->file_pernyataan) }}">Download</a></td>
                            </tr>
                            <tr>
                                <th>KTP (Ketua dan Anggota)</th>
                                <td><a href="{{ route('hak-cipta.view-dokumen', $hakCipta->file_ktp) }}" target="_blank">View</a></td>
                                <td><a href="{{ route('hak-cipta.download-dokumen', $hakCipta->file_ktp) }}">Download</a></td>
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
