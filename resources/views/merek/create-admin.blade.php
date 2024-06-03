@extends('layouts.vertical', ["page_title"=> "Merek"])

@section('css')
<link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
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
                        <li class="breadcrumb-item active">Buat Baru Hak Cipta</li>
                    </ol>
                </div>
                <h4 class="page-title">Buat Baru Hak Cipta</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="header-title">Basic Data Table</h4>
                    <p class="text-muted font-13 mb-4">
                        DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction
                        function:
                        <code>$().DataTable();</code>.
                    </p> --}}

                    <form class="needs-validation" action="{{ route('hak-cipta.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="position-relative mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Judul" required />
                                    <div class="invalid-tooltip">
                                        Mohon diisi kolom Judul.
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="jenis_hak_cipta_id" class="form-label">Jenis</label>
                                    <select name="jenis_hak_cipta_id" id="jenis_hak_cipta_id" class="form-select" required>
                                        <option value="">Pilih Jenis</option>
                                        {{-- <option value="-1">Coba</option> --}}
                                    </select>
                                    <div class="invalid-tooltip">
                                        Mohon diisi kolom Jenis.
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="sub_jenis_hak_cipta_id" class="form-label">Sub Jenis</label>
                                    <select name="sub_jenis_hak_cipta_id" id="sub_jenis_hak_cipta_id" class="form-select" required>
                                        <option value="">Pilih Sub Jenis</option>
                                        {{-- <option value="-1">Coba</option> --}}
                                    </select>
                                    <div class="invalid-tooltip">
                                        Mohon diisi kolom Sub Jenis.
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required />
                                    <div class="invalid-tooltip">
                                        Mohon diisi kolom Tanggal.
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="negara_id" class="form-label">Negara</label>
                                    <select name="negara_id" id="negara_id" class="form-select">
                                        <option value="">Pilih Negara</option>
                                        <option value="1">Indonesia</option>
                                    </select>
                                    <div class="invalid-tooltip">
                                        Mohon diisi kolom Jenis.
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="kota_id" class="form-label">Kota</label>
                                    <select name="kota_id" id="kota_id" class="form-select">
                                        <option value="">Pilih Kota</option>
                                        <option value="1">Surabaya</option>
                                    </select>
                                    <div class="invalid-tooltip">
                                        Mohon diisi kolom Jenis.
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="uraian" class="form-label">Uraian Singkat</label>
                                    <textarea class="form-control" id="uraian" name="uraian" rows="15" value="{{ old('uraian') }}" placeholder="Uraian Singkat" required></textarea>
                                    <div class="invalid-tooltip">
                                        Mohon diisi kolom Uraian Singkat.
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6">
                                {{-- <div class="position-relative mb-3">
                                    <label for="file_sertifikat" class="form-label">File Sertifikat</label>
                                    <input type="file" class="form-control" id="file_sertifikat" name="file_sertifikat" value="{{ old('file_sertifikat') }}" />
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="link_sertifikat" class="form-label">Link Dokumen (google drive)</label>
                                    <input type="text" class="form-control" id="link_sertifikat" name="link_sertifikat" value="{{ old('link_sertifikat') }}" placeholder="Link Sertifikat" />
                                </div> --}}

                                <div class="position-relative mb-3">
                                    <label for="anggota" class="form-label">Daftar Anggota</label>
                                    <div class="p-2 border">
                                        <table class="table dt-responsive w-100">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>NIP / NRP / Email</th>
                                                    <th>Telepon</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl_body_anggota">
                                                <tr>
                                                    <td class="align-middle">{{ $doskar->nama }}</td>
                                                    <td class="align-middle">{{ $doskar->nip }}</td>
                                                    <td class="align-middle">{{ $doskar->hp }}</td>
                                                    <td class="align-middle">
                                                        {{-- <button type="button" class="btn btn-xs btn-danger waves-effect waves-light">
                                                            <i class="mdi mdi-close"></i>
                                                        </button> --}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="w-100 text-end">
                                            <div class="btn-group">
                                                <button type="button" id="btn_tambah_doskar" class="btn btn-sm btn-info waves-effect waves-light m-1">Tambah Doskar</button>
                                                <button type="button" id="btn_tambah_mahasiswa" class="btn btn-sm btn-warning waves-effect waves-light m-1">Tambah Mahasiswa</button>
                                                <button type="button" id="btn_tambah_eksternal" class="btn btn-sm btn-blue waves-effect waves-light m-1">Tambah Eksternal</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-success waves-effect waves-light mt-2" type="submit">Simpan dan Lanjutkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div> <!-- container -->
@endsection

@section('script')
<script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $.get("{{ route('kategori-ki.get-jenis-ki') }}", function(data, status) {
            $('#jenis_hak_cipta_id').empty();
            $('#jenis_hak_cipta_id').append($(document.createElement('option')).prop({
                value: -1,
                text: 'Pilih Jenis'
            }));
            $('#sub_jenis_hak_cipta_id').empty();
            $('#sub_jenis_hak_cipta_id').append($(document.createElement('option')).prop({
                value: -1,
                text: 'Pilih Sub Jenis'
            }));
            for (const item of data) {
                $('#jenis_hak_cipta_id').append($(document.createElement('option')).prop({
                    value: item['id'],
                    text: item['nama']
                }));
            }
        });

        $('#jenis_hak_cipta_id').change(function() {
            $.get("{{ route('kategori-ki.get-sub-jenis-ki') }}?jenis_hak_cipta_id="+$('#jenis_hak_cipta_id').val(), function(data, status) {
                $('#sub_jenis_hak_cipta_id').empty();
                $('#sub_jenis_hak_cipta_id').append($(document.createElement('option')).prop({
                    value: -1,
                    text: 'Pilih Sub Jenis'
                }));
                for (const item of data) {
                    $('#sub_jenis_hak_cipta_id').append($(document.createElement('option')).prop({
                        value: item['id'],
                        text: item['nama']
                    }));
                }
            });
        });

        $('#kota_id').select2({
            ajax: {
                url: "{{ route('kota.get-kota') }}",
                type: "POST",
                dataType: "json",
                delay: 250,
                data: function(params) {
                    return {
                        _token: {{ csrf_token() }},
                        search: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });

        $('#btn_tambah_doskar').click(function() {
            // alert("button");

            row = "<tr>\
                <td class='align-middle'></td>\
                <td class='align-middle'></td>\
                <td class='align-middle'></td>\
                <td class='align-middle'>\
                    <button type='button' class='btn btn-xs btn-danger waves-effect waves-light'><i class='mdi mdi-close'></i></button>\
                </td>\
                </tr>";
            $('#tbl_body_anggota').append(row);
        });

        $('#btn_tambah_mahasiswa').click(function() {
            // alert("button");

            row = "<tr>\
                <td class='align-middle'></td>\
                <td class='align-middle'></td>\
                <td class='align-middle'></td>\
                <td class='align-middle'>\
                    <button type='button' class='btn btn-xs btn-danger waves-effect waves-light'><i class='mdi mdi-close'></i></button>\
                </td>\
                </tr>";
            $('#tbl_body_anggota').append(row);
        });

        $('#btn_tambah_eksternal').click(function() {
            // alert("button");

            row = "<tr>\
                <td class='align-middle'></td>\
                <td class='align-middle'></td>\
                <td class='align-middle'></td>\
                <td class='align-middle'>\
                    <button type='button' class='btn btn-xs btn-danger waves-effect waves-light'><i class='mdi mdi-close'></i></button>\
                </td>\
                </tr>";
            $('#tbl_body_anggota').append(row);
        });
    });
</script>
@endsection
