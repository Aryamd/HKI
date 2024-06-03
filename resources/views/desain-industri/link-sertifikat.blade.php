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
                        <li class="breadcrumb-item active">Sertifikat Desain Industri</li>
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
                    <table id="link-dokumen" class="table dt-responsive w-auto">
                        <tbody>
                            <tr>
                                <th>Sertifikat Desain Industri</th>
                                <td><a href="{{ \App\Helpers\Utils::isNullOrEmpty($desainIndustri->file_sertifikat) ? '' : route('desain-industri.view-dokumen', $desainIndustri->file_sertifikat) }}" target="_blank">View</a></td>
                                <td><a href="{{ \App\Helpers\Utils::isNullOrEmpty($desainIndustri->file_sertifikat) ? '' : route('desain-industri.download-dokumen', $desainIndustri->file_sertifikat) }}">Download</a></td>
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
