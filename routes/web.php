<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Unit_usaha;
use App\Http\Controllers\Logistik;
use App\Http\Controllers\Barang_jasa;
use App\Http\Controllers\Bagi_hasil_usaha;
use App\Http\Controllers\Asset_keuangan;
use App\Http\Controllers\Laporan;
use App\Http\Controllers\Pegawai;
use App\Http\Controllers\Artefak;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['CheckSign'])->group(function () {
    Route::get('/administrator/dashboard',[Dashboard::class, 'dashboard'])->name('administrator/dashboard');
    Route::get('/administrator/pengaturan',[Dashboard::class, 'pengaturan'])->name('administrator/pengaturan');
    Route::post('/administrator/pengaturan/update',[Dashboard::class, 'pengaturan_update'])->name('administrator/pengaturan/update');

    //PROGRAM KERJA
    Route::get('administrator/programkerja/tambah',[Dashboard::class, 'add_programkerja'])->name('administrator/programkerja/tambah');
    Route::get('/administrator/programkerja/ubah/{uuid}',[Dashboard::class, 'update_programkerja'])->name('administrator/programkerja/ubah/{uuid}');
    Route::post('/administrator/programkerja/create',[Dashboard::class, 'create_programkerja'])->name('administrator/programkerja/create');
    Route::post('/administrator/programkerja/update-data/{uuid}',[Dashboard::class, 'update_data_programkerja'])->name('administrator/programkerja/update-data/{uuid}');
    Route::post('/administrator/programkerja/delete',[Dashboard::class, 'delete_data_programkerja'])->name('administrator/programkerja/delete');

    //SIGNOUT AUTH
    Route::get('/signout',[Pegawai::class, 'signout'])->name('signout');

    //UNIT USAHA
    Route::get('/administrator/unit-usaha',[Unit_usaha::class, 'index'])->name('administrator/unit-usaha');
    Route::get('/administrator/unit-usaha/tambah',[Unit_usaha::class, 'add_unit'])->name('administrator/unit-usaha/tambah');
    Route::get('/administrator/unit-usaha/ubah/{uuid}',[Unit_usaha::class, 'update_unit'])->name('administrator/unit-usaha/ubah/{uuid}');
    Route::post('/administrator/unit-usaha/create',[Unit_usaha::class, 'create_unit'])->name('administrator/unit-usaha/create');
    Route::post('/administrator/unit-usaha/update-data/{uuid}',[Unit_usaha::class, 'update_data_unit'])->name('administrator/unit-usaha/update-data/{uuid}');
    Route::post('/administrator/unit-usaha/delete',[Unit_usaha::class, 'delete_data_unit'])->name('administrator/unit-usaha/delete');

    // ARTEFAK
    Route::get('/administrator/artefak',[Artefak::class, 'index'])->name('administrator/artefak');
    Route::get('/administrator/artefak/tambah',[Artefak::class, 'add_artefak'])->name('administrator/artefak/tambah');
    Route::get('/administrator/artefak/ubah/{uuid}',[Artefak::class, 'update_artefak'])->name('administrator/artefak/ubah/{uuid}');
    Route::post('/administrator/artefak/create',[Artefak::class, 'create_artefak'])->name('administrator/artefak/create');
    Route::post('/administrator/artefak/update-data/{uuid}',[Artefak::class, 'update_data_artefak'])->name('administrator/artefak/update-data/{uuid}');
    Route::post('/administrator/artefak/delete',[Artefak::class, 'delete_data_artefak'])->name('administrator/artefak/delete');

    //LOGISTIK
    Route::get('/administrator/logistik',[Logistik::class, 'index'])->name('administrator/logistik');
    Route::get('/administrator/logistik/tambah',[Logistik::class, 'add_logistik'])->name('administrator/logistik/tambah');
    Route::get('/administrator/logistik/ubah/{uuid}',[Logistik::class, 'update_logistik'])->name('administrator/logistik/ubah/{uuid}');
    Route::post('/administrator/logistik/create',[Logistik::class, 'create_logistik'])->name('administrator/logistik/create');
    Route::post('/administrator/logistik/update-data/{uuid}',[Logistik::class, 'update_data_logistik'])->name('administrator/logistik/update-data/{uuid}');
    Route::post('/administrator/logistik/delete',[Logistik::class, 'delete_data_logistik'])->name('administrator/logistik/delete');

    //BARANG & JASA
    Route::get('/administrator/barang-jasa',[Barang_jasa::class, 'index'])->name('administrator/barang-jasa');
    Route::get('/administrator/barang-jasa/tambah',[Barang_jasa::class, 'add_barangjasa'])->name('administrator/barang-jasa/tambah');
    Route::get('/administrator/barang-jasa/ubah/{uuid}',[Barang_jasa::class, 'update_barangjasa'])->name('administrator/barang-jasa/ubah/{uuid}');
    Route::post('/administrator/barang-jasa/create',[Barang_jasa::class, 'create_barangjasa'])->name('administrator/barang-jasa/create');
    Route::post('/administrator/barang-jasa/update-data/{uuid}',[Barang_jasa::class, 'update_data_barangjasa'])->name('administrator/barang-jasa/update-data/{uuid}');
    Route::post('/administrator/barang-jasa/delete',[Barang_jasa::class, 'delete_data_barangjasa'])->name('administrator/barang-jasa/delete');

    //BAGI HASIL USAHA
    Route::get('/administrator/bagi-hasil-usaha',[Bagi_hasil_usaha::class, 'index_bagi_hasil_usaha'])->name('administrator/bagi-hasil-usaha');
    Route::get('/administrator/bagi-hasil-usaha/tambah',[Bagi_hasil_usaha::class, 'add_bagi_hasil_usaha'])->name('administrator/bagi-hasil-usaha/tambah');
    Route::get('/administrator/bagi-hasil-usaha/ubah/{uuid}',[Bagi_hasil_usaha::class, 'update_bagi_hasil_usaha'])->name('administrator/bagi-hasil-usaha/ubah/{uuid}');
    Route::post('/administrator/bagi-hasil-usaha/create',[Bagi_hasil_usaha::class, 'create_bagi_hasil_usaha'])->name('administrator/bagi-hasil-usaha/create');
    Route::post('/administrator/bagi-hasil-usaha/update-data/{uuid}',[Bagi_hasil_usaha::class, 'update_data_bagi_hasil_usaha'])->name('administrator/bagi-hasil-usaha/update-data/{uuid}');
    Route::post('/administrator/bagi-hasil-usaha/delete',[Bagi_hasil_usaha::class, 'delete_data_bagi_hasil_usaha'])->name('administrator/bagi-hasil-usaha/delete');

    //MITRA
    Route::get('/administrator/mitra',[Bagi_hasil_usaha::class, 'index_mitra'])->name('administrator/mitra');
    Route::get('/administrator/mitra/tambah',[Bagi_hasil_usaha::class, 'add_mitra'])->name('administrator/mitra/tambah');
    Route::get('/administrator/mitra/ubah/{uuid}',[Bagi_hasil_usaha::class, 'update_mitra'])->name('administrator/mitra/ubah/{uuid}');
    Route::post('/administrator/mitra/create',[Bagi_hasil_usaha::class, 'create_mitra'])->name('administrator/mitra/create');
    Route::post('/administrator/mitra/update-data/{uuid}',[Bagi_hasil_usaha::class, 'update_data_mitra'])->name('administrator/mitra/update-data/{uuid}');
    Route::post('/administrator/mitra/delete',[Bagi_hasil_usaha::class, 'delete_data_mitra'])->name('administrator/mitra/delete');


    //ASSET/SUMBERDAYA
    Route::get('/administrator/asset-keuangan-grafik/{year}',[Asset_keuangan::class, 'asset_keuangan_grafik'])->name('administrator/asset-keuangan-grafik/{year}');


    Route::get('/administrator/asset',[Asset_keuangan::class, 'index_asset'])->name('administrator/asset');
    Route::get('/administrator/asset/tambah',[Asset_keuangan::class, 'add_asset'])->name('administrator/asset/tambah');
    Route::get('/administrator/asset/ubah/{uuid}',[Asset_keuangan::class, 'update_asset'])->name('administrator/asset/ubah/{uuid}');
    Route::post('/administrator/asset/create',[Asset_keuangan::class, 'create_asset'])->name('administrator/asset/create');
    Route::post('/administrator/asset/update-data/{uuid}',[Asset_keuangan::class, 'update_data_asset'])->name('administrator/asset/update-data/{uuid}');
    Route::post('/administrator/asset/delete',[Asset_keuangan::class, 'delete_data_asset'])->name('administrator/asset/delete');

    //MANUSIA
    Route::get('/administrator/manusia',[Asset_keuangan::class, 'index_manusia'])->name('administrator/manusia');
    Route::get('/administrator/manusia/tambah',[Asset_keuangan::class, 'add_manusia'])->name('administrator/manusia/tambah');
    Route::get('/administrator/manusia/ubah/{uuid}',[Asset_keuangan::class, 'update_manusia'])->name('administrator/manusia/ubah/{uuid}');
    Route::post('/administrator/manusia/create',[Asset_keuangan::class, 'create_manusia'])->name('administrator/manusia/create');
    Route::post('/administrator/manusia/update-data/{uuid}',[Asset_keuangan::class, 'update_data_manusia'])->name('administrator/manusia/update-data/{uuid}');
    Route::post('/administrator/manusia/delete',[Asset_keuangan::class, 'delete_data_manusia'])->name('administrator/manusia/delete');

    //KEUANGAN
    Route::get('/administrator/keuangan',[Asset_keuangan::class, 'index_keuangan'])->name('administrator/keuangan');
    Route::get('/administrator/keuangan/tambah',[Asset_keuangan::class, 'add_keuangan'])->name('administrator/keuangan/tambah');
    Route::get('/administrator/keuangan/ubah/{uuid}',[Asset_keuangan::class, 'update_keuangan'])->name('administrator/keuangan/ubah/{uuid}');
    Route::get('/administrator/keuangan/detail/{uuid}',[Asset_keuangan::class, 'detail_keuangan'])->name('administrator/keuangan/detail/{uuid}');



    Route::post('/administrator/keuangan/create',[Asset_keuangan::class, 'create_keuangan'])->name('administrator/keuangan/create');
    Route::post('/administrator/keuangan/update-data/{uuid}',[Asset_keuangan::class, 'update_data_keuangan'])->name('administrator/keuangan/update-data/{uuid}');
    Route::post('/administrator/keuangan/delete',[Asset_keuangan::class, 'delete_data_keuangan'])->name('administrator/keuangan/delete');

    Route::get('/administrator/keuangan/sekretaris/{status}/{uuid}',[Asset_keuangan::class, 'sekretaris_approved'])->name('administrator/keuangan/sekretaris/{status}/{uuid}');
    Route::get('/administrator/keuangan/bendahara/{status}/{uuid}',[Asset_keuangan::class, 'bendahara_approved'])->name('administrator/keuangan/bendahara/{status}/{uuid}');
    Route::get('/administrator/keuangan/direktur/{status}/{uuid}',[Asset_keuangan::class, 'direktur_approved'])->name('administrator/keuangan/direktur/{status}/{uuid}');

    //LAPORAN KEGIATAN
    Route::get('/administrator/laporan-kegiatan',[Laporan::class, 'index_laporan_kegiatan'])->name('administrator/laporan-kegiatan');
    Route::post('/administrator/laporan-kegiatan/print',[Laporan::class, 'print_laporan_kegiatan_all'])->name('administrator/laporan-kegiatan/print');
    Route::get('/administrator/laporan-kegiatan/mingguan',[Laporan::class, 'print_laporan_kegiatan_mingguan'])->name('administrator/laporan-kegiatan/mingguan');
    Route::get('/administrator/laporan-kegiatan/bulanan',[Laporan::class, 'print_laporan_kegiatan_bulanan'])->name('administrator/laporan-kegiatan/bulanan');


    Route::get('/administrator/laporan-kegiatan/tambah',[Laporan::class, 'add_laporan_kegiatan'])->name('administrator/laporan-kegiatan/tambah');
    Route::get('/administrator/laporan-kegiatan/ubah/{uuid}',[Laporan::class, 'update_laporan_kegiatan'])->name('administrator/laporan-kegiatan/ubah/{uuid}');
    Route::get('/administrator/laporan-kegiatan/detail/{uuid}',[Laporan::class, 'detail_laporan_kegiatan'])->name('administrator/laporan-kegiatan/detail/{uuid}');



    Route::post('/administrator/laporan-kegiatan/create',[Laporan::class, 'create_laporan_kegiatan'])->name('administrator/laporan-kegiatan/create');
    Route::post('/administrator/laporan-kegiatan/update-data/{uuid}',[Laporan::class, 'update_data_laporan_kegiatan'])->name('administrator/laporan-kegiatan/update-data/{uuid}');
    Route::post('/administrator/laporan-kegiatan/delete',[Laporan::class, 'delete_data_laporan_kegiatan'])->name('administrator/laporan-kegiatan/delete');
    Route::post('/administrator/laporan-kegiatan/import',[Laporan::class, 'import_laporan_kegiatan'])->name('administrator/laporan-kegiatan/import');

    Route::get('/administrator/laporan-kegiatan/sekretaris/{status}/{uuid}',[Laporan::class, 'sekretaris_approved'])->name('administrator/laporan-kegiatan/sekretaris/{status}/{uuid}');
    Route::get('/administrator/laporan-kegiatan/bendahara/{status}/{uuid}',[Laporan::class, 'bendahara_approved'])->name('administrator/laporan-kegiatan/bendahara/{status}/{uuid}');
    Route::get('/administrator/laporan-kegiatan/direktur/{status}/{uuid}',[Laporan::class, 'direktur_approved'])->name('administrator/laporan-kegiatan/direktur/{status}/{uuid}');
    Route::get('/administrator/laporan-kegiatan/print/{uuid}',[Laporan::class, 'print_laporan_kegiatan'])->name('administrator/laporan-kegiatan/print/{uuid}');
    Route::get('administrator/laporan-kegiatan/unapprovedprint/{uuid}',[Laporan::class, 'print_laporan_kegiatan_unapproved'])->name('administrator/laporan-kegiatan/unapprovedprint/{uuid}');


    //LAPORAN KEUANGAN
    Route::get('/administrator/laporan-keuangan',[Laporan::class, 'index_laporan_keuangan'])->name('administrator/laporan-keuangan');
    Route::get('/administrator/laporan-keuangan/mingguan',[Laporan::class, 'index_laporan_keuangan_mingguan'])->name('administrator/laporan-keuangan/mingguan');
    Route::get('/administrator/laporan-keuangan/bulanan',[Laporan::class, 'index_laporan_keuangan_bulanan'])->name('administrator/laporan-keuangan/bulanan');
    Route::post('/administrator/laporan-keuangan/print',[Laporan::class, 'index_laporan_keuangan_print'])->name('administrator/laporan-keuangan/print');
    Route::post('/administrator/laporan-keuangan/import',[Laporan::class, 'import_laporan_keuangan'])->name('administrator/laporan-keuangan/import');
    Route::get('/administrator/keuangan/print/{uuid}',[Laporan::class, 'print_laporan_keuangan'])->name('administrator/keuangan/print/{uuid}');
    Route::get('/administrator/keuangan/unapprovedprint/{uuid}',[Laporan::class, 'print_laporan_keuangan_unapproved'])->name('administrator/keuangan/unapprovedprint/{uuid}');



    //PEGAWAI
    Route::get('/administrator/pegawai',[Pegawai::class, 'index_pegawai'])->name('administrator/pegawai');
    Route::get('/administrator/pegawai/tambah',[Pegawai::class, 'add_pegawai'])->name('administrator/pegawai/tambah');
    Route::get('/administrator/pegawai/ubah/{uuid}',[Pegawai::class, 'update_pegawai'])->name('administrator/pegawai/ubah/{uuid}');

    Route::post('/administrator/pegawai/create',[Pegawai::class, 'create_pegawai'])->name('administrator/pegawai/create');
    Route::post('/administrator/pegawai/update-data/{uuid}',[Pegawai::class, 'update_data_pegawai'])->name('administrator/pegawai/update-data/{uuid}');
    Route::post('/administrator/pegawai/delete',[Pegawai::class, 'delete_data_pegawai'])->name('administrator/pegawai/delete');

    //PROFILE
    Route::get('/administrator/profile',[Pegawai::class, 'index_profile'])->name('administrator/profile');
    Route::post('/administrator/profile/update-data/{uuid}',[Pegawai::class, 'update_profile'])->name('administrator/profile/update-data/{uuid}');

    //UPLOAD DOC
    Route::post('/uploadDoc',[Artefak::class, 'uploadDoc'])->name('/uploadDoc');
    Route::get('/downloadDocument/{path}',[Artefak::class, 'downloadDocument'])->name('download.document');
});





//AUTHENTICATION
Route::middleware(['IsSign'])->group(function () {
    //PAGE
    Route::get('/',[Authentication::class, 'authentication'])->name('authentication');


    //ACTION
    Route::post('authentication/sign',[Authentication::class, 'authentication_sign'])->name('authentication/sign');
});
