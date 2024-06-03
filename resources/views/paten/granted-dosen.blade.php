@extends('layouts.vertical', ["page_title"=> "Paten"])

@section('css')
<link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
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
                        <li class="breadcrumb-item active">Granted</li>
                    </ol>
                </div>
                <h4 class="page-title">Granted</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="paten-datatable" class="table dt-responsive w-100">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>JUDUL & JENIS</th>
                                <th>ABSTRAK</th>
                                <th>LINK</th>
                                <th>STATUS DOKUMEN</th>
                                <th>TANGGAL DIBUAT</th>
                                <th>JML ANGGOTA</th>
                                <th>DIBUAT OLEH</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="9" class="text-center">
                                    <em class="lead text-secondary">Anda belum memiliki daftar Paten</em>
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
<script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#paten-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('paten.granted') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'judul_jenis_paten', name: 'judul_jenis_paten'},
                {data: 'abstrak', name: 'abstrak'},
                {data: 'link', name: 'link', orderable: false, searchable: false},
                {data: 'status_dokumen', name: 'status_dokumen', orderable: false, searchable: false},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'anggota', name: 'anggota', orderable: false, searchable: false},
                {data: 'ketua', name: 'ketua', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            // order: [[1,'asc']],
        });
    });
</script>
@endsection
