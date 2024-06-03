@extends('layouts.vertical', ["page_title"=> "Merek"])

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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Merek</a></li>
                        <li class="breadcrumb-item active">Edit Merek</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Merek</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- <form class="needs-validation" enctype="multipart/form-data" action="{{ route('merek.update', $id) }}" method="post" novalidate>
                        @csrf
                        @method('PUT') --}}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="position-relative mb-3">
                                    <label for="judul" class="form-label">Judul</label>
                                    <input type="text" class="form-control" id="judul" name="judul" value="{{ $merek->judul }}" placeholder="Judul" required />
                                    <div class="invalid-tooltip">
                                        Mohon diisi kolom Judul.
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="jenis_merek_id" class="form-label">Jenis</label>
                                    <select name="jenis_merek_id" id="jenis_merek_id" class="form-select" required>
                                        <option value="">Pilih Jenis</option>
                                        @foreach ($jenisMerek as $item)
                                            <option value="{{ $item->id }}" {{ $merek->jenis_merek_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-tooltip">
                                        Mohon diisi kolom Jenis.
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $merek->tanggal }}" required />
                                    <div class="invalid-tooltip">
                                        Mohon diisi kolom Tanggal.
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="uraian" class="form-label">Uraian Singkat</label>
                                    <textarea class="form-control" id="uraian" name="uraian" rows="15" placeholder="Uraian Singkat" required>{{ $merek->uraian }}</textarea>
                                    <div class="invalid-tooltip">
                                        Mohon diisi kolom Uraian Singkat.
                                    </div>
                                </div>
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
                            <div class="col-lg-6">
                                <div class="position-relative mb-3">
                                    <label for="file_uraian_merek" class="form-label">Uraian Merek</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="file" class="form-control" id="file_uraian_merek" name="file_uraian_merek" />
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label mt-1">{{ $merek->file_uraian_merek }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="file_ttd_pemohon" class="form-label">Tanda Tangan Pemohon</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="file" class="form-control" id="file_ttd_pemohon" name="file_ttd_pemohon" />
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label mt-1">{{ $merek->file_ttd_pemohon }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="file_gambar" class="form-label">Gambar Merek</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="file" class="form-control" id="file_gambar" name="file_gambar" />
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label mt-1">{{ $merek->file_gambar }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="file_pernyataan_lisensi" class="form-label">Formulir Pernyataan Lisensi</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="file" class="form-control" id="file_pernyataan_lisensi" name="file_pernyataan_lisensi" />
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label mt-1">{{ $merek->file_pernyataan_lisensi }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="file_permohonan_merek" class="form-label">Formulir Permohonan Merek</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="file" class="form-control" id="file_permohonan_merek" name="file_permohonan_merek" />
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label mt-1">{{ $merek->file_permohonan_merek }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="file_perpanjangan_merek" class="form-label">Formulir Perpanjangan Merek</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="file" class="form-control" id="file_perpanjangan_merek" name="file_perpanjangan_merek" />
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label mt-1">{{ $merek->file_perpanjangan_merek }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="file_surat_pengalihan_hak" class="form-label">Surat Pengalihan Hak</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="file" class="form-control" id="file_surat_pengalihan_hak" name="file_surat_pengalihan_hak" />
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label mt-1">{{ $merek->file_surat_pengalihan_hak }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="file_surat_perubahan_nama_alamat" class="form-label">Surat Perubahan Nama dan Alamat</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="file" class="form-control" id="file_surat_perubahan_nama_alamat" name="file_surat_perubahan_nama_alamat" />
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label mt-1">{{ $merek->file_surat_perubahan_nama_alamat }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="file_penjelasan_pendaftaran_merek" class="form-label">Surat Penjelasan Pendaftaran Merek</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="file" class="form-control" id="file_penjelasan_pendaftaran_merek" name="file_penjelasan_pendaftaran_merek" />
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label mt-1">{{ $merek->file_penjelasan_pendaftaran_merek }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="file_penjelasan_perpanjangan_merek" class="form-label">Surat Penjelasan Perpanjangan Merek</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="file" class="form-control" id="file_penjelasan_perpanjangan_merek" name="file_penjelasan_perpanjangan_merek" />
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label mt-1">{{ $merek->file_penjelasan_perpanjangan_merek }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="file_penjelasan_pengalihan_hak" class="form-label">Surat Penjelasan Pengalihan Hak</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="file" class="form-control" id="file_penjelasan_pengalihan_hak" name="file_penjelasan_pengalihan_hak" />
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label mt-1">{{ $merek->file_penjelasan_pengalihan_hak }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <button class="btn btn-success waves-effect waves-light mt-2" type="submit">Simpan</button>
                    </form> --}}
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

    function initializeHtmlTambahDoskar(namaId, valueId, valueNama, nip, hp, isKetua) {
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
                <td class='align-middle'>";

            if (!isKetua) {
                row += "<button onclick=\"deleteAnggota('tr_"+namaId+"')\" class='btn btn-xs btn-danger waves-effect waves-light'><i class='mdi mdi-close'></i></button>";
            }
        row += "</td>\
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
            initializeHtmlTambahDoskar(namaId, undefined, undefined, undefined, undefined, false);
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
            @if($item->is_ketua)
            namaId = (new Date().getTime()) + t;
            initializeHtmlTambahDoskar(namaId, '{{ $item->doskar_id }}', '{{ $item->nama }}', '{{ $item->nip }}', '{{ $item->hp }}', true);
            initializeJsTambahDoskar(namaId);
            t++;
            @endif
            @if(!$item->is_ketua)
            namaId = (new Date().getTime()) + t;
            initializeHtmlTambahDoskar(namaId, '{{ $item->doskar_id }}', '{{ $item->nama }}', '{{ $item->nip }}', '{{ $item->hp }}', false);
            initializeJsTambahDoskar(namaId);
            t++;
            @endif
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
