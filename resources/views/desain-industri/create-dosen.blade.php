@extends('layouts.vertical', ["page_title"=> "Desain Industri"])

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Desain Industri</a></li>
                        <li class="breadcrumb-item active">Buat Desain Industri Baru</li>
                    </ol>
                </div>
                <h4 class="page-title">Buat Desain Industri Baru</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form class="needs-validation" enctype="multipart/form-data" action="{{ route('desain-industri.store') }}" method="post" novalidate>
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
                                    <label for="jenis_desain_industri_id" class="form-label">Jenis</label>
                                    <select name="jenis_desain_industri_id" id="jenis_desain_industri_id" class="form-select" required>
                                        <option value="">Pilih Jenis</option>
                                        @foreach ($jenisDesainIndustri as $item)
                                            <option value="{{ $item->id }}" {{ old('jenis_desain_industri_id') == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-tooltip">
                                        Mohon diisi kolom Jenis.
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="sub_jenis_desain_industri_id" class="form-label">Sub Jenis</label>
                                    <select name="sub_jenis_desain_industri_id" id="sub_jenis_desain_industri_id" class="form-select" required>
                                        <option value="">Pilih Sub Jenis</option>
                                        @foreach ($subJenisDesainIndustri as $item)
                                            <option value="{{ $item->id }}" {{ old('sub_jenis_desain_industri_id') == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                        @endforeach
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
                                    <label for="uraian" class="form-label">Deskripsi Singkat</label>
                                    <textarea class="form-control" id="uraian" name="uraian" rows="15" placeholder="Uraian Singkat" required>{{ old('uraian') }}</textarea>
                                    <div class="invalid-tooltip">
                                        Mohon diisi kolom Deskripsi Singkat.
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label class="form-label">Daftar Anggota</label>
                                    <div class="p-2 border">
                                        <table class="table dt-responsive w-100">
                                            <thead>
                                                <tr>
                                                    {{-- <th>Ketua</th> --}}
                                                    <th>Nama</th>
                                                    <th>NIP / NRP / Email</th>
                                                    <th>Telepon</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbl_body_anggota">
                                                <tr>
                                                    <input type="hidden" name="tipe[]" value="doskar">
                                                    {{-- <td class="align-middle text-center">
                                                        <input type="radio" name="ketua" value="{{ $doskar->id }}">
                                                    </td> --}}
                                                    <td class="align-middle">
                                                        {{-- <input type="text" class="form-control" name="nama[]" id="nama_doskar" value="{{ $doskar->nama }}" readonly> --}}
                                                        <select name="nama[]" id="nama_doskar" class="form-select">
                                                            <option value="{{ $doskar->id }}">{{ $doskar->nama }}</option>
                                                        </select>
                                                    </td>
                                                    <td class="align-middle">
                                                        <input type="text" class="form-control" name="nip[]" id="nip_doskar" value="{{ $doskar->nip }}" readonly>
                                                    </td>
                                                    <td class="align-middle">
                                                        <input type="text" class="form-control" name="hp[]" id="hp_doskar" value="{{ $doskar->hp }}" readonly>
                                                    </td>
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
                            <div class="col-lg-6">
                                <div class="position-relative mb-3">
                                    <label for="file_uraian_desain_industri" class="form-label">Uraian Desain Industri</label>
                                    <input type="file" class="form-control" id="file_uraian_desain_industri" name="file_uraian_desain_industri" />
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="file_gambar_desain_industri" class="form-label">Gambar atau Foto Desain Industri</label>
                                    <input type="file" class="form-control" id="file_gambar_desain_industri" name="file_gambar_desain_industri" />
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="file_rincian_gambar_desain_industri" class="form-label">Rincian Gambar Desain Industri (Perspektif)</label>
                                    <input type="file" class="form-control" id="file_rincian_gambar_desain_industri" name="file_rincian_gambar_desain_industri" />
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="file_gambar_tampak_depan" class="form-label">Rincian Gambar Desain Industri (Tampak Depan)</label>
                                    <input type="file" class="form-control" id="file_gambar_tampak_depan" name="file_gambar_tampak_depan" />
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="file_gambar_tampak_belakang" class="form-label">Rincian Gambar Desain Industri (Tampak Belakang)</label>
                                    <input type="file" class="form-control" id="file_gambar_tampak_belakang" name="file_gambar_tampak_belakang" />
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="file_gambar_tampak_samping_kiri" class="form-label">Rincian Gambar Desain Industri (Tampak Samping Kiri)</label>
                                    <input type="file" class="form-control" id="file_gambar_tampak_samping_kiri" name="file_gambar_tampak_samping_kiri" />
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="file_gambar_tampak_samping_kanan" class="form-label">Rincian Gambar Desain Industri (Tampak Samping Kanan)</label>
                                    <input type="file" class="form-control" id="file_gambar_tampak_samping_kanan" name="file_gambar_tampak_samping_kanan" />
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="file_gambar_tampak_atas" class="form-label">Rincian Gambar Desain Industri (Tampak Atas)</label>
                                    <input type="file" class="form-control" id="file_gambar_tampak_atas" name="file_gambar_tampak_atas" />
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="file_surat_pernyataan_kepemilikan" class="form-label">Surat Pernyataan Kepemilikan Desain Industri</label>
                                    <input type="file" class="form-control" id="file_surat_pernyataan_kepemilikan" name="file_surat_pernyataan_kepemilikan" />
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="file_surat_pernyataan_pengalihan_hak" class="form-label">Surat Pernyataan Pengalihan Hak (jika pemohon dan pendesain berbeda)</label>
                                    <input type="file" class="form-control" id="file_surat_pernyataan_pengalihan_hak" name="file_surat_pernyataan_pengalihan_hak" />
                                </div>

                            </div>
                        </div>

                        <button class="btn btn-success waves-effect waves-light mt-2" type="submit">Simpan</button>
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
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    function deleteAnggota(namaId) {
        $("#"+namaId).remove();
    }

    function initializeTambahDoskar(namaId) {
        $('#nama_doskar_'+namaId).select2({
            ajax: {
                url: "{{ route('doskar.get-doskar') }}",
                type: "POST",
                dataType: "json",
                delay: 250,
                data: function(params) {
                    return {
                        _token: CSRF_TOKEN,
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

        $('#nama_doskar_'+namaId).on('change', function(e) {
            $.post("{{ route('doskar.get-nip-doskar') }}",
            {
                id: $('#nama_doskar_'+namaId).val(),
                _token: CSRF_TOKEN,
            },
            function(data, status) {
                $('#nip_doskar_'+namaId).val(data['nip']);
                $('#hp_doskar_'+namaId).val(data['hp']);
                // console.log(data);
            });
        });
    }

    function initializeTambahMahasiswa(namaId) {
        $('#nama_mahasiswa_'+namaId).select2({
            ajax: {
                url: "{{ route('mahasiswa.get-mahasiswa') }}",
                type: "POST",
                dataType: "json",
                delay: 250,
                data: function(params) {
                    return {
                        _token: CSRF_TOKEN,
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

        $('#nama_mahasiswa_'+namaId).on('change', function(e) {
            $.post("{{ route('mahasiswa.get-nrp-mahasiswa') }}",
            {
                id: $('#nama_mahasiswa_'+namaId).val(),
                _token: CSRF_TOKEN,
            },
            function(data, status) {
                $('#nip_mahasiswa_'+namaId).val(data['nrp']);
                $('#hp_mahasiswa_'+namaId).val(data['hp']);
                // console.log(data);
            });
        });
    }

    $(document).ready(function() {
        {{-- $.get("{{ route('kategori-ki.get-jenis-ki') }}", function(data, status) {
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
        }); --}}

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        $('#nama_doskar').select2({
            ajax: {
                url: "{{ route('doskar.get-doskar') }}",
                type: "POST",
                dataType: "json",
                delay: 250,
                data: function(params) {
                    return {
                        _token: CSRF_TOKEN,
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
            const namaId = new Date().getTime();

            row = "<tr id='tr_"+namaId+"'>\
                <input type='hidden' name='tipe[]' value='doskar'>\
                <td class=align-middle>\
                    <select name='nama[]' id='nama_doskar_"+namaId+"' class='form-select'>\
                    </select>\
                </td>\
                <td class=align-middle>\
                    <input type=text class=form-control name=nip[] id=nip_doskar_"+namaId+">\
                </td>\
                <td class=align-middle>\
                    <input type=text class=form-control name=hp[] id=hp_doskar_"+namaId+">\
                </td>\
                <td class='align-middle'>\
                    <button onclick=\"deleteAnggota('tr_"+namaId+"')\" class='btn btn-xs btn-danger waves-effect waves-light'><i class='mdi mdi-close'></i></button>\
                </td>\
                </tr>";
            $('#tbl_body_anggota').append(row);

            initializeTambahDoskar(namaId);
        });

        $('#btn_tambah_mahasiswa').click(function() {
            const namaId = new Date().getTime();

            row = "<tr id='tr_"+namaId+"'>\
                <input type='hidden' name='tipe[]' value='mahasiswa'>\
                <td class=align-middle>\
                    <select name='nama[]' id='nama_mahasiswa_"+namaId+"' class='form-select'>\
                    </select>\
                </td>\
                <td class=align-middle>\
                    <input type=text class=form-control name=nip[] id=nip_mahasiswa_"+namaId+">\
                </td>\
                <td class=align-middle>\
                    <input type=text class=form-control name=hp[] id=hp_mahasiswa_"+namaId+">\
                </td>\
                <td class='align-middle'>\
                    <button onclick=\"deleteAnggota('tr_"+namaId+"')\" class='btn btn-xs btn-danger waves-effect waves-light'><i class='mdi mdi-close'></i></button>\
                </td>\
                </tr>";
            $('#tbl_body_anggota').append(row);

            initializeTambahMahasiswa(namaId);
        });

        $('#btn_tambah_eksternal').click(function() {
            const namaId = new Date().getTime();

            row = "<tr id='tr_"+namaId+"'>\
                <input type='hidden' name='tipe[]' value='eksternal'>\
                <td class=align-middle>\
                    <input type=text class=form-control name=nama[] >\
                </td>\
                <td class=align-middle>\
                    <input type=text class=form-control name=nip[] >\
                </td>\
                <td class=align-middle>\
                    <input type=text class=form-control name=hp[] >\
                </td>\
                <td class='align-middle'>\
                    <button onclick=\"deleteAnggota('tr_"+namaId+"')\" class='btn btn-xs btn-danger waves-effect waves-light'><i class='mdi mdi-close'></i></button>\
                </td>\
                </tr>";
            $('#tbl_body_anggota').append(row);
        });
    });
</script>
@endsection
