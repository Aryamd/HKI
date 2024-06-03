@extends('layouts.vertical', ["page_title"=> "Hak Cipta"])

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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Hak Cipta</a></li>
                        <li class="breadcrumb-item active">Edit Hak Cipta</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Hak Cipta</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form class="needs-validation" enctype="multipart/form-data" action="{{ route('hak-cipta.update', $id) }}" method="post" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="position-relative mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul" value="{{ $hakCipta->judul }}" placeholder="Judul" required />
                                    <div class="invalid-tooltip">
                                        Mohon diisi kolom Judul.
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="jenis_hak_cipta_id" class="form-label">Jenis</label>
                                    <select name="jenis_hak_cipta_id" id="jenis_hak_cipta_id" class="form-select" required>
                                        <option value="">Pilih Jenis</option>
                                        @foreach ($jenisHakCipta as $item)
                                            <option value="{{ $item->id }}" {{ $hakCipta->jenis_hak_cipta_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-tooltip">
                                        Mohon diisi kolom Jenis.
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="sub_jenis_hak_cipta_id" class="form-label">Sub Jenis</label>
                                    <select name="sub_jenis_hak_cipta_id" id="sub_jenis_hak_cipta_id" class="form-select" required>
                                        <option value="">Pilih Sub Jenis</option>
                                        @foreach ($subJenisHakCipta as $item)
                                            <option value="{{ $item->id }}" {{ $hakCipta->sub_jenis_hak_cipta_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-tooltip">
                                        Mohon diisi kolom Sub Jenis.
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $hakCipta->tanggal }}" required />
                                    <div class="invalid-tooltip">
                                        Mohon diisi kolom Tanggal.
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="negara_id" class="form-label">Negara</label>
                                    <select name="negara_id" id="negara_id" class="form-select" required>
                                        <option value="">Pilih Negara</option>
                                        @foreach ($negara as $item)
                                            <option value="{{ $item->id }}" {{ $hakCipta->negara_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-tooltip">
                                        Mohon diisi kolom Negara.
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="kota_id" class="form-label">Kota</label>
                                    <select name="kota_id" id="kota_id" class="form-select" required>
                                        <option value="">Pilih Kota</option>
                                        @if ($hakCipta->kota_id >= 1)
                                            <option value="{{ $kota->id }}" selected="selected">{{ $kota->nama }}</option>
                                        @endif
                                    </select>
                                    <div class="invalid-tooltip">
                                        Mohon diisi kolom Kota.
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="uraian" class="form-label">Deskripsi Singkat</label>
                                    <textarea class="form-control" id="uraian" name="uraian" rows="15" placeholder="Uraian Singkat" required>{{ $hakCipta->uraian }}</textarea>
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
                                    <label for="file_permohonan" class="form-label">Formulir Permohonan Hak Cipta (Ttd sudah lengkap)</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="file" class="form-control" id="file_permohonan" name="file_permohonan" />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label mt-1">{{ $hakCipta->file_permohonan }}</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="position-relative mb-3">
                                    <label for="file_pengalihan" class="form-label">Formulir Surat Pengalihan Hak Cipta (SPH) (Ttd sudah lengkap dan bermaterai)</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="file" class="form-control" id="file_pengalihan" name="file_pengalihan" />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label mt-1">{{ $hakCipta->file_pengalihan }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="file_pernyataan" class="form-label">Formulir Surat Pernyataan Hak Cipta (Ttd dan bermaterai dikosongi dulu)</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="file" class="form-control" id="file_pernyataan" name="file_pernyataan" />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label mt-1">{{ $hakCipta->file_pernyataan }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="file_ktp" class="form-label">KTP (Ketua dan Anggota)</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="file" class="form-control" id="file_ktp" name="file_ktp" />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label mt-1">{{ $hakCipta->file_ktp }}</label>
                                        </div>
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
                                                {{-- <tr>
                                                    <input type="hidden" name="tipe[]" value="doskar">
                                                    <td class="align-middle">
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
                                                    </td>
                                                </tr> --}}

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

    function initializeHtmlTambahDoskar(namaId, valueId, valueNama, nip, hp) {
        if (nip === undefined) nip = '';
        if (hp === undefined) hp = '';

        row = "<tr id='tr_"+namaId+"'>\
                <input type='hidden' name='tipe[]' value='doskar'>\
                <td class='align-middle'>\
                    <select name='nama[]' id='nama_doskar_"+namaId+"' class='form-select'>";

                    if (valueId !== undefined) {
                        row += "<option value='"+valueId+"' selected='selected'>"+valueNama+"</option>";
                    }

                    row += "</select>\
                </td>\
                <td class='align-middle'>\
                    <input type='text' class='form-control' name='nip[]' id='nip_doskar_"+namaId+"' value='"+nip+"'>\
                </td>\
                <td class=align-middle>\
                    <input type='text' class='form-control' name='hp[]' id='hp_doskar_"+namaId+"' value='"+hp+"'>\
                </td>\
                <td class='align-middle'>\
                    <button onclick=\"deleteAnggota('tr_"+namaId+"')\" class='btn btn-xs btn-danger waves-effect waves-light'><i class='mdi mdi-close'></i></button>\
                </td>\
                </tr>";
            $('#tbl_body_anggota').append(row);
    }

    function initializeJsTambahDoskar(namaId) {
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

    function initializeHtmlTambahMahasiswa(namaId, valueId, valueNama, nip, hp) {
        if (nip === undefined) nip = '';
        if (hp === undefined) hp = '';

        row = "<tr id='tr_"+namaId+"'>\
                <input type='hidden' name='tipe[]' value='mahasiswa'>\
                <td class='align-middle'>\
                    <select name='nama[]' id='nama_mahasiswa_"+namaId+"' class='form-select'>";

                    if (valueId !== undefined) {
                        row += "<option value='"+valueId+"' selected='selected'>"+valueNama+"</option>";
                    }

                    row += "</select>\
                </td>\
                <td class='align-middle'>\
                    <input type='text' class='form-control' name='nip[]' id='nip_mahasiswa_"+namaId+"' value='"+nip+"'>\
                </td>\
                <td class='align-middle'>\
                    <input type='text' class='form-control' name='hp[]' id='hp_mahasiswa_"+namaId+"' value='"+hp+"'>\
                </td>\
                <td class='align-middle'>\
                    <button onclick=\"deleteAnggota('tr_"+namaId+"')\" class='btn btn-xs btn-danger waves-effect waves-light'><i class='mdi mdi-close'></i></button>\
                </td>\
                </tr>";
            $('#tbl_body_anggota').append(row);
    }

    function initializeJsTambahMahasiswa(namaId) {
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
            });
        });
    }

    function initializeHtmlTambahEksternal(namaId, valueId, valueNama, nip, hp) {
        if (valueNama === undefined) valueNama = '';
        if (nip === undefined) nip = '';
        if (hp === undefined) hp = '';

        row = "<tr id='tr_"+namaId+"'>\
            <input type='hidden' name='tipe[]' value='eksternal'>\
            <td class='align-middle'>";
                row += "<input type='text' class='form-control' name='nama[]' value='"+valueNama+"'>\
            </td>\
            <td class='align-middle'>";
                row += "<input type='text' class='form-control' name='nip[]' value='"+nip+"'>\
            </td>\
            <td class='align-middle'>";
                row += "<input type='text' class='form-control' name='hp[]' value='"+hp+"'>\
            </td>\
            <td class='align-middle'>\
                <button onclick=\"deleteAnggota('tr_"+namaId+"')\" class='btn btn-xs btn-danger waves-effect waves-light'><i class='mdi mdi-close'></i></button>\
            </td>\
            </tr>";
        $('#tbl_body_anggota').append(row);
    }

    $(document).ready(function() {

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
            initializeHtmlTambahDoskar(namaId);
            initializeJsTambahDoskar(namaId);
        });

        $('#btn_tambah_mahasiswa').click(function() {
            const namaId = new Date().getTime();
            initializeHtmlTambahMahasiswa(namaId);
            initializeJsTambahMahasiswa(namaId);
        });

        $('#btn_tambah_eksternal').click(function() {
            const namaId = new Date().getTime();
            initializeHtmlTambahEksternal(namaId);
        });

        var t = 1;
        var nameId = '';
        @foreach ($pengusul as $item)
            @if($item->is_doskar)
            namaId = (new Date().getTime()) + t;
            initializeHtmlTambahDoskar(namaId, '{{ $item->doskar_id }}', '{{ $item->nama }}', '{{ $item->nip }}', '{{ $item->hp }}');
            initializeJsTambahDoskar(namaId);
            t++;
            @endif

            @if ($item->is_mahasiswa)
            namaId = (new Date().getTime()) + t;
            initializeHtmlTambahMahasiswa(namaId, '{{ $item->mahasiswa_id }}', '{{ $item->nama }}', '{{ $item->nrp }}', '{{ $item->hp }}');
            initializeJsTambahMahasiswa(namaId);
            t++;
            @endif

            @if ($item->is_eksternal)
            namaId = (new Date().getTime()) + t;
            initializeHtmlTambahEksternal(namaId, '{{ $item->id }}', '{{ $item->nama }}', '{{ $item->email }}', '{{ $item->hp }}');
            t++;
            @endif
        @endforeach
    });
</script>
@endsection
