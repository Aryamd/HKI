<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\DesainIndustri\DesainIndustriController;
use App\Http\Controllers\Doskar\DoskarController;
use App\Http\Controllers\DTLST\DTLSTController;
use App\Http\Controllers\HakCipta\HakCiptaController;
use App\Http\Controllers\KategoriDI\KategoriDIController;
use App\Http\Controllers\KategoriDTLST\KategoriDTLSTController;
use App\Http\Controllers\KategoriHC\KategoriHCController;
use App\Http\Controllers\KategoriKI\KategoriKIController;
use App\Http\Controllers\KategoriMerek\KategoriMerekController;
use App\Http\Controllers\Konsultan\KonsultanController;
use App\Http\Controllers\Kota\KotaController;
use App\Http\Controllers\Laporan\LaporanController;
use App\Http\Controllers\Mahasiswa\MahasiswaController;
use App\Http\Controllers\Merek\MerekController;
use App\Http\Controllers\Paten\PatenController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\StatusKI\StatusKIController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::middleware(['auth', 'prevent-back-history'])->group(function() {
//     Route::get('/', function () {
//         return view('welcome');
//     });
// });

Route::get('/', function() {
    return redirect('dashboard');
});

// Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
// Route::post('/register', [RegisterController::class, 'register'])->name('register.perform');
// Route::get('/login', [LoginController::class, 'show'])->name('login.show');
// Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
Route::resource('register', RegisterController::class);
Route::resource('login', LoginController::class);

Route::group(['middleware' => ['auth', 'prevent-back-history']], function() {
    // Route::get('/logout', [LogoutController::class, 'perform'])->name('logout');

    Route::get('/kategori-ki/get-jenis-ki', [KategoriKIController::class, 'getJenisKI'])->name('kategori-ki.get-jenis-ki');
    Route::get('/kategori-ki/get-sub-jenis-ki', [KategoriKIController::class, 'getSubJenisKI'])->name('kategori-ki.get-sub-jenis-ki');

    Route::post('/kota/get-kota', [KotaController::class, 'getKota'])->name('kota.get-kota');
    Route::post('/doskar/get-doskar', [DoskarController::class, 'getDoskar'])->name('doskar.get-doskar');
    Route::post('/doskar/get-nip-doskar', [DoskarController::class, 'getNipDoskar'])->name('doskar.get-nip-doskar');

    Route::post('/mahasiswa/get-mahasiswa', [MahasiswaController::class, 'getMahasiswa'])->name('mahasiswa.get-mahasiswa');
    Route::post('/mahasiswa/get-nrp-mahasiswa', [MahasiswaController::class, 'getNrpMahasiswa'])->name('mahasiswa.get-nrp-mahasiswa');

    Route::get('/hak-cipta/link-dokumen/{id}', [HakCiptaController::class, 'linkDokumen'])->name('hak-cipta.link-dokumen');
    Route::get('/hak-cipta/view-dokumen/{id}', [HakCiptaController::class, 'viewDokumen'])->name('hak-cipta.view-dokumen');
    Route::get('/hak-cipta/download-dokumen/{id}', [HakCiptaController::class, 'downloadDokumen'])->name('hak-cipta.download-dokumen');
    Route::get('/hak-cipta/link-sertifikat/{id}', [HakCiptaController::class, 'linkSertifikat'])->name('hak-cipta.link-sertifikat');

    Route::get('/paten/pengajuan-awal', [PatenController::class, 'pengajuanAwal'])->name('paten.pengajuan-awal');
    Route::get('/paten/terdaftar', [PatenController::class, 'terdaftar'])->name('paten.terdaftar');
    Route::get('/paten/kelengkapan-dokumen', [PatenController::class, 'kelengkapanDokumen'])->name('paten.kelengkapan-dokumen');
    Route::get('/paten/mediasi', [PatenController::class, 'mediasi'])->name('paten.mediasi');
    Route::get('/paten/granted', [PatenController::class, 'granted'])->name('paten.granted');
    Route::get('/paten/pass-status-paten/{id}/{routeName}', [PatenController::class, 'passStatusPaten'])->name('paten.pass-status-paten');

    Route::get('/paten/link-dokumen/{id}', [PatenController::class, 'linkDokumen'])->name('paten.link-dokumen');
    Route::get('/paten/view-dokumen/{id}', [PatenController::class, 'viewDokumen'])->name('paten.view-dokumen');
    Route::get('/paten/download-dokumen/{id}', [PatenController::class, 'downloadDokumen'])->name('paten.download-dokumen');
    Route::get('/paten/link-sertifikat/{id}', [PatenController::class, 'linkSertifikat'])->name('paten.link-sertifikat');

    Route::get('/merek/get-jenis-merek', [MerekController::class, 'getJenisMerek'])->name('merek.get-jenis-merek');
    Route::get('/merek/link-dokumen/{id}', [MerekController::class, 'linkDokumen'])->name('merek.link-dokumen');
    Route::get('/merek/view-dokumen/{id}', [MerekController::class, 'viewDokumen'])->name('merek.view-dokumen');
    Route::get('/merek/download-dokumen/{id}', [MerekController::class, 'downloadDokumen'])->name('merek.download-dokumen');
    Route::get('/merek/link-sertifikat/{id}', [MerekController::class, 'linkSertifikat'])->name('merek.link-sertifikat');

    Route::get('/desain-industri/get-jenis-desain-industri', [DesainIndustriController::class, 'getJenisDesainIndustri'])->name('desain-industri.get-jenis-desain-industri');
    Route::get('/desain-industri/get-sub-jenis-desain-industri/{id}', [DesainIndustriController::class, 'getSubJenisDesainIndustri'])->name('desain-industri.get-sub-jenis-desain-industri');
    Route::get('/desain-industri/link-dokumen/{id}', [DesainIndustriController::class, 'linkDokumen'])->name('desain-industri.link-dokumen');
    Route::get('/desain-industri/view-dokumen/{id}', [DesainIndustriController::class, 'viewDokumen'])->name('desain-industri.view-dokumen');
    Route::get('/desain-industri/download-dokumen/{id}', [DesainIndustriController::class, 'downloadDokumen'])->name('desain-industri.download-dokumen');
    Route::get('/desain-industri/link-sertifikat/{id}', [DesainIndustriController::class, 'linkSertifikat'])->name('desain-industri.link-sertifikat');

    Route::get('/dtlst/get-jenis-dtlst', [DTLSTController::class, 'getJenisDTLST'])->name('dtlst.get-jenis-dtlst');
    Route::get('/dtlst/get-sub-jenis-dtlst/{id}', [DTLSTController::class, 'getSubJenisDTLST'])->name('dtlst.get-sub-jenis-dtlst');
    Route::get('/dtlst/link-dokumen/{id}', [DTLSTController::class, 'linkDokumen'])->name('dtlst.link-dokumen');
    Route::get('/dtlst/view-dokumen/{id}', [DTLSTController::class, 'viewDokumen'])->name('dtlst.view-dokumen');
    Route::get('/dtlst/download-dokumen/{id}', [DTLSTController::class, 'downloadDokumen'])->name('dtlst.download-dokumen');
    Route::get('/dtlst/link-sertifikat/{id}', [DTLSTController::class, 'linkSertifikat'])->name('dtlst.link-sertifikat');


    Route::resources([
        'logout' => LogoutController::class,
        'role' => RoleController::class,
        'user' => UserController::class,

        'dashboard' => DashboardController::class,
        'desain-industri' => DesainIndustriController::class,
        'dtlst' => DTLSTController::class,
        'hak-cipta' => HakCiptaController::class,
        'merek' => MerekController::class,
        'paten' => PatenController::class,
        'laporan' => LaporanController::class,

        'status-ki' => StatusKIController::class,
        'kategori-ki' => KategoriKIController::class,
        'kategori-hc' => KategoriHCController::class,
        'kategori-merek' => KategoriMerekController::class,
        'kategori-di' => KategoriDIController::class,
        'kategori-dtlst' => KategoriDTLSTController::class,
        'konsultan' => KonsultanController::class,
        'setting' => SettingController::class,
        'profile' => ProfileController::class,
    ]);

});
