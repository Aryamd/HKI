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
                        <li class="breadcrumb-item active">Sertifikat Hak Cipta</li>
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
                                <th>Sertifikat Hak Cipta</th>
                                <td><a href="{{ \App\Helpers\Utils::isNullOrEmpty($hakCipta->file_sertifikat) ? '' : route('hak-cipta.view-dokumen', $hakCipta->file_sertifikat) }}" target="_blank">View</a></td>
                                <td><a href="{{ \App\Helpers\Utils::isNullOrEmpty($hakCipta->file_sertifikat) ? '' : route('hak-cipta.download-dokumen', $hakCipta->file_sertifikat) }}">Download</a></td>
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
