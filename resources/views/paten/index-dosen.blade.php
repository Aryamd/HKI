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
                        <li class="breadcrumb-item active">Daftar Paten</li>
                    </ol>
                </div>
                <h4 class="page-title">Daftar Paten</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="position-relative mb-3">
                                <label for="tahun_pengajuan" class="form-label">Tahun Pengajuan</label>
                                <select name="tahun_pengajuan" id="tahun_pengajuan" class="form-select">
                                    <option value="">Pilih Tahun</option>
                                    @for ($i=0; $i<count($tahun); $i++)
                                    <option value="{{ $tahun[$i] }}">{{ $tahun[$i] }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="position-relative mb-3">
                                <label for="jenis_paten" class="form-label">Jenis Paten</label>
                                <select name="jenis_paten" id="jenis_paten" class="form-select">
                                    <option value="">Pilih Status</option>
                                    @foreach ($jenisPaten as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="position-relative mb-3">
                                <label for="search" class="form-label">Search Judul/Abstrak</label>
                                <input type="text" class="form-control" id="search" name="search" placeholder="Search"/>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="position-relative mb-3">
                                <button class="btn btn-success waves-effect waves-light mt-2" type="submit">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-3">
                        <a href="{{ route('paten.create') }}" class="btn btn-success waves-effect waves-light">Buat Baru</a>
                    </p>
                    <table id="paten-datatable" class="table dt-responsive w-100">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>JUDUL</th>
                                <th>ABSTRAK</th>
                                <th>LINK DOKUMEN</th>
                                <th>LINK SERTIFIKAT</th>
                                <th>STATUS DOKUMEN</th>
                                <th>TANGGAL DIBUAT</th>
                                <th>JUMLAH ANGGOTA</th>
                                <th>DIBUAT OLEH</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="10" class="text-center">
                                    <em class="lead text-secondary">Anda belum memiliki daftar Paten</em>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- <div class="text-center">
                        <em class="lead text-secondary">Anda belum memiliki daftar Paten</em>
                    </div> --}}
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
            ajax: "{{ route('paten.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'judul', name: 'judul'},
                {data: 'abstrak', name: 'abstrak'},
                {data: 'link_dokumen', name: 'link_dokumen', orderable: false, searchable: false},
                {data: 'link_sertifikat', name: 'link_sertifikat', orderable: false, searchable: false},
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
