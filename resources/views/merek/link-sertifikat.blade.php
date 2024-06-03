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
                        <li class="breadcrumb-item active">Sertifikat Merek</li>
                    </ol>
                </div>
                <h4 class="page-title">Link Sertifikat</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="link-sertifikat" class="table dt-responsive w-auto">
                        <thead>
                            <tr>
                                <th>NAMA FILE</th>
                                <th>LINK VIEW</th>
                                <th>LINK DOWNLOAD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Sertifikat Merek</th>
                                <td>
                                    @if ($merek->file_sertifikat)
                                    <a href="{{ route('merek.view-dokumen', $merek->file_sertifikat) }}" target="_blank">View</a>
                                    @else
                                    None
                                    @endif
                                </td>
                                <td>
                                    @if ($merek->file_sertifikat)
                                    <a href="{{ route('merek.download-dokumen', $merek->file_sertifikat) }}">Download</a>
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
