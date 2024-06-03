@extends('layouts.vertical', ["page_title"=> "DTLST"])

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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">DTLST</a></li>
                        <li class="breadcrumb-item active">Daftar DTLST</li>
                    </ol>
                </div>
                <h4 class="page-title">Daftar DTLST</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p>
                        <a href="{{ route('dtlst.create') }}" class="btn btn-success waves-effect waves-light">Buat Baru</a>
                    </p>
                    <table id="dtlst-datatable" class="table dt-responsive w-100">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>JUDUL & JENIS</th>
                                <th>DESKRIPSI</th>
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
                                    <em class="lead text-secondary">Anda belum memiliki daftar DTLST</em>
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
        $('#dtlst-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('dtlst.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'judul_jenis_dtlst', name: 'judul_jenis_dtlst'},
                {data: 'uraian', name: 'uraian'},
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
