<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Laporan_kegiatan;
use App\Imports\Laporan_kegiatan_import;
use Carbon\Carbon;

use App\Models\Laporan_keuangan;
use App\Imports\Laporan_keuangan_import;

use Uuid;
use Webp;
use Session;
use PDF;

use Illuminate\Support\Str;

class Laporan extends Controller{
    //LAPORAN KEUANGAN
    public function index_laporan_keuangan(){
        $Data['title']      = "Laporan Kegiatan";
        $Data['page']       = "laporan_keuangan";
        $Data['master']     = "laporan";
        $Data['content']    = DB::table('keuangan')->rightJoin('unit_usaha','unit_usaha.id_unit','=','keuangan.id_unit')->orderBy('keuangan.date_created','desc')->where(['keuangan.status' => 1])->get();
        $Data['pemasukan']    = DB::table('barang_jasa')->orderBy('date_created','desc')->where(['status' => 1])->sum('harga');
        $Data['pemasukantoko']    = DB::table('toko')->orderBy('date_created','desc')->where(['status' => 1])->sum('harga');
        $Data['pemasukanhomestay']    = DB::table('homestay')->orderBy('date_created','desc')->where(['status' => 1])->sum('harga');
        $Data['pengeluaran']  = DB::table('logistik')->orderBy('date_created','desc')->where(['status' => 1])->sum('harga');
        $Data['pemasukan_keuangan']    = DB::table('keuangan')->orderBy('date_created','desc')->where(['status' => 1, 'jenis' => 1])->sum('nilai');
        $Data['pengeluaran_keuangan']  = DB::table('keuangan')->orderBy('date_created','desc')->where(['status' => 1 , 'jenis' => 2])->sum('nilai');

        return view('laporan_keuangan.index', $Data);
    }


    //LAPORAN KEGIATAN
    public function index_laporan_kegiatan(){
        $Data['title']      = "Laporan Kegiatan";
        $Data['page']       = "laporan_kegiatan";
        $Data['master']     = "laporan";
        $Data['content']    = DB::table('laporan_kegiatan')->rightJoin('unit_usaha','unit_usaha.id_unit','=','laporan_kegiatan.id_unit')->orderBy('laporan_kegiatan.date_created','desc')->where(['laporan_kegiatan.status' => 1])->get();


        return view('laporan_kegiatan.index', $Data);
    }

    public function add_laporan_kegiatan(){
        $Data['title']      = "Tambah Laporan Kegiatan";
        $Data['page']       = "laporan_kegiatan";
        $Data['master']     = "laporan";
        $Data['unit']       = DB::table('unit_usaha')->where(['status' => 1])->get();

        return view('laporan_kegiatan.add', $Data);
    }

    public function update_laporan_kegiatan($uuid){
        $check  = DB::table('laporan_kegiatan')->where(['status' => 1, 'uuid_kegiatan' => $uuid])->first();
        if($check){
            $Data['title']      = "Ubah Laporan Kegiatan";
            $Data['page']       = "laporan_kegiatan";
            $Data['master']     = "laporan";
            $Data['value']      = $check;
            $Data['unit']       = DB::table('unit_usaha')->where(['status' => 1])->get();


            return view('laporan_kegiatan.update', $Data);
        } else{
            return redirect('administrator/laporan-kegiatan');
        }
    }

    public function detail_laporan_kegiatan($uuid){
        $check  = DB::table('laporan_kegiatan')->where(['status' => 1, 'uuid_kegiatan' => $uuid])->first();
        if($check){
            $Data['title']      = "Ubah Laporan Kegiatan";
            $Data['page']       = "laporan_kegiatan";
            $Data['master']     = "laporan";
            $Data['value']      = $check;
            $Data['unit']       = DB::table('unit_usaha')->where(['status' => 1, 'id_unit' => $check->id_unit])->first();


            return view('laporan_kegiatan.detail', $Data);
        } else{
            return redirect('administrator/laporan-kegiatan');
        }
    }

    //ACTION

    //LAPORAN KEUANGAN
    function index_laporan_keuangan_print(request $req){
        ini_set('max_execution_time', 300);

        $to                 = $req->input('filter_to');
        $from               = $req->input('filter_from');
        $Data['to']           = $to;
        $Data['from']         = $from;

        // dd($from,$to);

        $Data['website']      = DB::table('website')->where(['id' => 1])->first();



        //KEUANGAN
        $Data['content']      = DB::table('keuangan')->rightJoin('unit_usaha','unit_usaha.id_unit','=','keuangan.id_unit')->orderBy('keuangan.date_created','desc')->whereBetween('keuangan.tanggal',[$from, $to])->where(['keuangan.status' => 1])->get();
        $Data['pemasukan']    = DB::table('keuangan')->orderBy('date_created','desc')->whereBetween('tanggal',[$from, $to])->where(['status' => 1, 'jenis' => 1])->sum('nilai');
        $Data['pengeluaran']  = DB::table('keuangan')->orderBy('date_created','desc')->whereBetween('tanggal',[$from, $to])->where(['status' => 1, 'jenis' => 2])->sum('nilai');
        $Data['pengeluaran_list']  = DB::table('keuangan')->orderBy('date_created','desc')->whereBetween('tanggal',[$from, $to])->where(['status' => 1, 'jenis' => 2 , 'keuangan.approve_direktur' => 1,'approve_bendahara' => 1])->get();

        //$Data['pemasukan']    = DB::table('barang_jasa')->orderBy('date_created','desc')->whereBetween('tanggal',[$from, $to])->where(['status' => 1])->sum('harga');
        //$Data['pengeluaran']  = DB::table('logistik')->orderBy('date_created','desc')->whereBetween('tanggal',[$from, $to])->where(['status' => 1])->sum('harga');


        //LOGISTIK
        $Data['content_logistik']  = DB::table('logistik')->whereBetween('logistik.tanggal',[$from, $to])->rightJoin('unit_usaha','unit_usaha.id_unit','=','logistik.id_unit')->orderBy('logistik.date_created','desc')->where(['logistik.status' => 1])->get();
        $Data['total_logistik']    = DB::table('logistik')->whereBetween('tanggal',[$from, $to])->where(['logistik.status' => 1])->sum('harga');
        $Data_tabel_logistik = DB::table('logistik')->whereBetween('logistik.tanggal',[$from, $to])->where('id_unit', 1)->where(['logistik.status' => 1])->get();
        $Data_table_toArray = $Data_tabel_logistik->toArray();
        foreach($Data_table_toArray as $data){
            $Data['content_logistik']->push($data);
        }
        //BARANG JASA
        $Data['content_barangjasa']    = DB::table('barang_jasa')->whereBetween('barang_jasa.tanggal',[$from, $to])->rightJoin('unit_usaha','unit_usaha.id_unit','=','barang_jasa.id_unit')->orderBy('barang_jasa.date_created','desc')->where(['barang_jasa.status' => 1])->get();
        $Data['total_pemasukan_barangjasa']    = DB::table('barang_jasa')->whereBetween('barang_jasa.tanggal',[$from, $to])->where(['status' => 1])->sum('harga');
        $Data['total_pembelian_barangjasa']    = DB::table('barang_jasa')->whereBetween('barang_jasa.tanggal',[$from, $to])->where(['status' => 1])->sum('harga');
        $Data['total_penyewaan_barangjasa']    = DB::table('barang_jasa')->whereBetween('barang_jasa.tanggal',[$from, $to])->where(['status' => 1])->sum('harga');

        // TOKO
         $Data['content_toko']    = DB::table('toko')->whereBetween('toko.tanggal',[$from, $to])->rightJoin('unit_usaha','unit_usaha.id_unit','=','toko.id_unit')->orderBy('toko.date_created','desc')->where(['toko.status' => 1])->get();
         $Data['total_pemasukan_toko']    = DB::table('toko')->whereBetween('toko.tanggal',[$from, $to])->where(['status' => 1])->sum('harga');
        //HOMESTAY
         $Data['content_homestay']    = DB::table('homestay')->whereBetween('homestay.tanggal_masuk',[$from, $to])->rightJoin('unit_usaha','unit_usaha.id_unit','=','homestay.id_unit')->orderBy('homestay.date_created','desc')->where(['homestay.status' => 1])->get();
         $Data['total_homestay']    = DB::table('homestay')->whereBetween('homestay.tanggal_masuk',[$from, $to])->where(['status' => 1])->sum('harga');
         $Data['pemasukantoko']    = DB::table('toko')->orderBy('date_created','desc')->where(['status' => 1])->sum('harga');
        $Data['pemasukanhomestay']    = DB::table('homestay')->orderBy('date_created','desc')->where(['status' => 1])->sum('harga');
        //BAGI HASIL USAHA
        $Data['content_bagihasil']    = DB::table('bagi_hasil_usaha')->rightJoin('mitra','mitra.id_mitra','=','bagi_hasil_usaha.id_mitra')->whereBetween('bagi_hasil_usaha.tanggal',[$from, $to])->orderBy('bagi_hasil_usaha.date_created','desc')->where(['bagi_hasil_usaha.status' => 1, 'bagi_hasil_usaha.status_hasil' => 1])->get();
        $Data['total_pemasukan_bagihasil']    = DB::table('bagi_hasil_usaha')->whereBetween('bagi_hasil_usaha.tanggal',[$from, $to])->where(['status' => 1, 'status_hasil' => 1])->sum('nilai');


        //ASSET
        $Data['content_asset']          = DB::table('asset')->whereBetween('tanggal_terdaftar',[$from, $to])->orderBy('date_created','desc')->where(['status' => 1])->get();

        $Data['keuangan_pengeluaran']    = DB::table('keuangan')->whereBetween('tanggal',[$from, $to])->where(['status' => 1, 'jenis' => 2 , 'keuangan.approve_direktur' => 1,'approve_bendahara' => 1])->sum('nilai');
        $Data['keuangan_pemasukan']      = DB::table('keuangan')->whereBetween('tanggal',[$from, $to])->where(['status' => 1, 'jenis' => 1 , 'keuangan.approve_direktur' => 1,'approve_bendahara' => 1])->sum('nilai');
        $Data['total_asset']             = DB::table('asset')->whereBetween('tanggal_terdaftar',[$from, $to])->where(['status' => 1])->sum('nilai_asset');
        $Data['admin']        = DB::table('administrator')->where(['status' => 1, 'id_jabatan' => 4])->first();

        //NEWTAB
        $Data['barang_jasa_pemasukan']          = DB::table('barang_jasa')->whereBetween('tanggal',[$from, $to])->orderBy('date_created','desc')->where(['status' => 1])->get();
        $Data['logistik_pengeluaran']           = DB::table('logistik')->whereBetween('tanggal',[$from, $to])->orderBy('date_created','desc')->where(['status' => 1])->get();

        $Data['barang_jasa_pemasukan_total']    = DB::table('barang_jasa')->whereBetween('tanggal',[$from, $to])->where(['status' => 1])->sum('harga');
        $Data['toko_pemasukan_total']    = DB::table('toko')->whereBetween('tanggal',[$from, $to])->where(['status' => 1])->sum('harga');
        $Data['homestay_pemasukan_total']    = DB::table('homestay')->whereBetween('tanggal_masuk',[$from, $to])->where(['status' => 1])->sum('harga');
        $Data['logistik_pengeluaran_total']    = DB::table('logistik')->whereBetween('tanggal',[$from, $to])->where(['status' => 1])->sum('harga');

        $temp = 0;
        foreach($Data['content'] as $newdata){
            if($newdata->approve_direktur == 0){
                $temp += 1;
            }
        }
        if($temp > 0){
            $pdf = PDF::loadView('laporan_keuangan.laporan_unapproved_print', $Data);
        }else{
            $pdf = PDF::loadView('laporan_keuangan.laporan_print', $Data);
            }
        // $pdf = PDF::loadView('laporan_keuangan.laporan_print', $Data);
        return $pdf->download('Laporan_Keuangan_Filter.pdf');
        //return view('laporan_keuangan.laporan_print', $Data);

        ini_restore('max_execution_time');

    }

    function index_laporan_keuangan_mingguan(request $req){
        ini_set('max_execution_time', 300);

        $to                 = Carbon::today()->format('Y-m-d');
        $from               = Carbon::today()->subDay(7)->format('Y-m-d');
        $Data['to']           = $to;
        $Data['from']         = $from;

        // dd($from,$to);

        $Data['website']      = DB::table('website')->where(['id' => 1])->first();

        //KEUANGAN
        $Data['content']      = DB::table('keuangan')->rightJoin('unit_usaha','unit_usaha.id_unit','=','keuangan.id_unit')->orderBy('keuangan.date_created','desc')->whereBetween('keuangan.tanggal',[$from, $to])->where(['keuangan.status' => 1])->get();
        $Data['pemasukan']    = DB::table('keuangan')->orderBy('date_created','desc')->whereBetween('tanggal',[$from, $to])->where(['status' => 1, 'jenis' => 1])->sum('nilai');
        $Data['pengeluaran']  = DB::table('keuangan')->orderBy('date_created','desc')->whereBetween('tanggal',[$from, $to])->where(['status' => 1, 'jenis' => 2])->sum('nilai');
        $Data['pengeluaran_list']  = DB::table('keuangan')->orderBy('date_created','desc')->whereBetween('tanggal',[$from, $to])->where(['status' => 1, 'jenis' => 2 , 'keuangan.approve_direktur' => 1,'approve_bendahara' => 1])->get();

        //$Data['pemasukan']    = DB::table('barang_jasa')->orderBy('date_created','desc')->whereBetween('tanggal',[$from, $to])->where(['status' => 1])->sum('harga');
        //$Data['pengeluaran']  = DB::table('logistik')->orderBy('date_created','desc')->whereBetween('tanggal',[$from, $to])->where(['status' => 1])->sum('harga');

        //LOGISTIK
        $Data['content_logistik']  = DB::table('logistik')->whereBetween('logistik.tanggal',[$from, $to])->rightJoin('unit_usaha','unit_usaha.id_unit','=','logistik.id_unit')->orderBy('logistik.date_created','desc')->where(['logistik.status' => 1])->get();
        $Data['total_logistik']    = DB::table('logistik')->whereBetween('tanggal',[$from, $to])->where(['logistik.status' => 1])->sum('harga');
        $Data_tabel_logistik = DB::table('logistik')->whereBetween('logistik.tanggal',[$from, $to])->where('id_unit', 1)->where(['logistik.status' => 1])->get();
        $Data_table_toArray = $Data_tabel_logistik->toArray();
        foreach($Data_table_toArray as $data){
            $Data['content_logistik']->push($data);
        }
        //BARANG JASA
        $Data['content_barangjasa']    = DB::table('barang_jasa')->whereBetween('barang_jasa.tanggal',[$from, $to])->rightJoin('unit_usaha','unit_usaha.id_unit','=','barang_jasa.id_unit')->orderBy('barang_jasa.date_created','desc')->where(['barang_jasa.status' => 1])->get();
        $Data['total_pemasukan_barangjasa']    = DB::table('barang_jasa')->whereBetween('barang_jasa.tanggal',[$from, $to])->where(['status' => 1])->sum('harga');
        $Data['total_pembelian_barangjasa']    = DB::table('barang_jasa')->whereBetween('barang_jasa.tanggal',[$from, $to])->where(['status' => 1])->sum('harga');
        $Data['total_penyewaan_barangjasa']    = DB::table('barang_jasa')->whereBetween('barang_jasa.tanggal',[$from, $to])->where(['status' => 1])->sum('harga');

        //BAGI HASIL USAHA
        $Data['content_bagihasil']          = DB::table('bagi_hasil_usaha')->rightJoin('mitra','mitra.id_mitra','=','bagi_hasil_usaha.id_mitra')->whereBetween('bagi_hasil_usaha.tanggal',[$from, $to])->orderBy('bagi_hasil_usaha.date_created','desc')->where(['bagi_hasil_usaha.status' => 1, 'bagi_hasil_usaha.status_hasil' => 1])->get();
        $Data['total_pemasukan_bagihasil']  = DB::table('bagi_hasil_usaha')->whereBetween('bagi_hasil_usaha.tanggal',[$from, $to])->where(['status' => 1, 'status_hasil' => 1])->sum('nilai');

        // TOKO
         $Data['content_toko']    = DB::table('toko')->whereBetween('toko.tanggal',[$from, $to])->rightJoin('unit_usaha','unit_usaha.id_unit','=','toko.id_unit')->orderBy('toko.date_created','desc')->where(['toko.status' => 1])->get();
         $Data['total_pemasukan_toko']    = DB::table('toko')->whereBetween('toko.tanggal',[$from, $to])->where(['status' => 1])->sum('harga');
        //HOMESTAY
        $Data['content_homestay']    = DB::table('homestay')->whereBetween('homestay.tanggal_masuk',[$from, $to])->rightJoin('unit_usaha','unit_usaha.id_unit','=','homestay.id_unit')->orderBy('homestay.date_created','desc')->where(['homestay.status' => 1])->get();
        $Data['total_homestay']    = DB::table('homestay')->whereBetween('homestay.tanggal_masuk',[$from, $to])->where(['status' => 1])->sum('harga');

        $Data['pemasukantoko']    = DB::table('toko')->orderBy('date_created','desc')->where(['status' => 1])->sum('harga');
        $Data['pemasukanhomestay']    = DB::table('homestay')->orderBy('date_created','desc')->where(['status' => 1])->sum('harga');
        //ASSET
        $Data['content_asset']          = DB::table('asset')->whereBetween('tanggal_terdaftar',[$from, $to])->orderBy('date_created','desc')->where(['status' => 1])->get();
        $Data['keuangan_pengeluaran']   = DB::table('keuangan')->whereBetween('tanggal',[$from, $to])->where(['status' => 1, 'jenis' => 2 , 'keuangan.approve_direktur' => 1,'approve_bendahara' => 1])->sum('nilai');
        $Data['keuangan_pemasukan']     = DB::table('keuangan')->whereBetween('tanggal',[$from, $to])->where(['status' => 1, 'jenis' => 1 , 'keuangan.approve_direktur' => 1,'approve_bendahara' => 1])->sum('nilai');
        $Data['total_asset']            = DB::table('asset')->whereBetween('tanggal_terdaftar',[$from, $to])->where(['status' => 1])->sum('nilai_asset');
        $Data['admin']                  = DB::table('administrator')->where(['status' => 1, 'id_jabatan' => 4])->first();

        //NEWTAB
        $Data['barang_jasa_pemasukan']          = DB::table('barang_jasa')->whereBetween('tanggal',[$from, $to])->orderBy('date_created','desc')->where(['status' => 1])->get();
        $Data['logistik_pengeluaran']           = DB::table('logistik')->whereBetween('tanggal',[$from, $to])->orderBy('date_created','desc')->where(['status' => 1])->get();

        $Data['barang_jasa_pemasukan_total']    = DB::table('barang_jasa')->whereBetween('tanggal',[$from, $to])->where(['status' => 1])->sum('harga');
        $Data['toko_pemasukan_total']    = DB::table('toko')->whereBetween('tanggal',[$from, $to])->where(['status' => 1])->sum('harga');
        $Data['homestay_pemasukan_total']    = DB::table('homestay')->whereBetween('tanggal_masuk',[$from, $to])->where(['status' => 1])->sum('harga');
        $Data['logistik_pengeluaran_total']    = DB::table('logistik')->whereBetween('tanggal',[$from, $to])->where(['status' => 1])->sum('harga');
        // // //Mencari laba rugi
        // if(($Data['content'] == [] && $Data['content_logistik'] == [] && $Data['content_barangjasa'] == [] && $Data['content_bagihasil'] == [] && $Data['content_asset'] == []) || ($Data['content'] != [])) {
        //     // dd($Data['content_logistik']);
        //     $pdf = PDF::loadView('laporan_keuangan.laporan_unapproved_print', $Data);
        // } else {
        //     $pdf = PDF::loadView('laporan_keuangan.laporan_print', $Data);
        // }
        // dd($Data['content']);
        $temp = 0;
        foreach($Data['content'] as $newdata){
            if($newdata->approve_direktur == 0){
                $temp += 1;
            }
        }
        if($temp > 0){
            $pdf = PDF::loadView('laporan_keuangan.laporan_unapproved_print', $Data);
        }else{
            $pdf = PDF::loadView('laporan_keuangan.laporan_print', $Data);
            }
        return $pdf->download('Laporan_Keuangan_Mingguan.pdf');
        // return $pdf->download('Laporan_Keuangan_Mingguan-' . uniqid() . '.pdf');
        //return view('laporan_keuangan.laporan_print', $Data);

        ini_restore('max_execution_time');

    }

    function index_laporan_keuangan_bulanan(request $req){
        ini_set('max_execution_time', 300);

        $to                 = Carbon::today()->format('Y-m-d');
        $from               = Carbon::today()->subDay(30)->format('Y-m-d');
        $Data['to']           = $to;
        $Data['from']         = $from;

        $Data['website']      = DB::table('website')->where(['id' => 1])->first();



        //KEUANGAN
        $Data['content']      = DB::table('keuangan')->rightJoin('unit_usaha','unit_usaha.id_unit','=','keuangan.id_unit')->orderBy('keuangan.date_created','desc')->whereBetween('keuangan.tanggal',[$from, $to])->where(['keuangan.status' => 1])->get();
        $Data['pemasukan']    = DB::table('keuangan')->orderBy('date_created','desc')->whereBetween('tanggal',[$from, $to])->where(['status' => 1, 'jenis' => 1 ])->sum('nilai');
        $Data['pengeluaran']  = DB::table('keuangan')->orderBy('date_created','desc')->whereBetween('tanggal',[$from, $to])->where(['status' => 1, 'jenis' => 2 ])->sum('nilai');
        $Data['pengeluaran_list']  = DB::table('keuangan')->orderBy('date_created','desc')->whereBetween('tanggal',[$from, $to])->where(['status' => 1, 'jenis' => 2 , 'keuangan.approve_direktur' => 1,'approve_bendahara' => 1])->get();

        //$Data['pemasukan']    = DB::table('barang_jasa')->orderBy('date_created','desc')->whereBetween('tanggal',[$from, $to])->where(['status' => 1])->sum('harga');
        //$Data['pengeluaran']  = DB::table('logistik')->orderBy('date_created','desc')->whereBetween('tanggal',[$from, $to])->where(['status' => 1])->sum('harga');


        //LOGISTIK
        $Data['content_logistik']  = DB::table('logistik')->whereBetween('logistik.tanggal',[$from, $to])->rightJoin('unit_usaha','unit_usaha.id_unit','=','logistik.id_unit')->orderBy('logistik.date_created','desc')->where(['logistik.status' => 1])->get();
        $Data['total_logistik']    = DB::table('logistik')->whereBetween('tanggal',[$from, $to])->where(['logistik.status' => 1])->sum('harga');
        $Data_tabel_logistik = DB::table('logistik')->whereBetween('logistik.tanggal',[$from, $to])->where('id_unit', 1)->where(['logistik.status' => 1])->get();
        $Data_table_toArray = $Data_tabel_logistik->toArray();
        foreach($Data_table_toArray as $data){
            $Data['content_logistik']->push($data);
        }
        //BARANG JASA
        $Data['content_barangjasa']    = DB::table('barang_jasa')->whereBetween('barang_jasa.tanggal',[$from, $to])->rightJoin('unit_usaha','unit_usaha.id_unit','=','barang_jasa.id_unit')->orderBy('barang_jasa.date_created','desc')->where(['barang_jasa.status' => 1])->get();
        $Data['total_pemasukan_barangjasa']    = DB::table('barang_jasa')->whereBetween('barang_jasa.tanggal',[$from, $to])->where(['status' => 1])->sum('harga');
        $Data['total_pembelian_barangjasa']    = DB::table('barang_jasa')->whereBetween('barang_jasa.tanggal',[$from, $to])->where(['status' => 1])->sum('harga');
        $Data['total_penyewaan_barangjasa']    = DB::table('barang_jasa')->whereBetween('barang_jasa.tanggal',[$from, $to])->where(['status' => 1])->sum('harga');


        // TOKO
        $Data['content_toko']    = DB::table('toko')->whereBetween('toko.tanggal',[$from, $to])->rightJoin('unit_usaha','unit_usaha.id_unit','=','toko.id_unit')->orderBy('toko.date_created','desc')->where(['toko.status' => 1])->get();
        $Data['total_pemasukan_toko']    = DB::table('toko')->whereBetween('toko.tanggal',[$from, $to])->where(['status' => 1])->sum('harga');
       //HOMESTAY
       $Data['content_homestay']    = DB::table('homestay')->whereBetween('homestay.tanggal_masuk',[$from, $to])->rightJoin('unit_usaha','unit_usaha.id_unit','=','homestay.id_unit')->orderBy('homestay.date_created','desc')->where(['homestay.status' => 1])->get();
       $Data['total_homestay']    = DB::table('homestay')->whereBetween('homestay.tanggal_masuk',[$from, $to])->where(['status' => 1])->sum('harga');

       $Data['pemasukantoko']    = DB::table('toko')->orderBy('date_created','desc')->where(['status' => 1])->sum('harga');
       $Data['pemasukanhomestay']    = DB::table('homestay')->orderBy('date_created','desc')->where(['status' => 1])->sum('harga');

        //BAGI HASIL USAHA
        $Data['content_bagihasil']    = DB::table('bagi_hasil_usaha')->rightJoin('mitra','mitra.id_mitra','=','bagi_hasil_usaha.id_mitra')->whereBetween('bagi_hasil_usaha.tanggal',[$from, $to])->orderBy('bagi_hasil_usaha.date_created','desc')->where(['bagi_hasil_usaha.status' => 1, 'bagi_hasil_usaha.status_hasil' => 1])->get();
        $Data['total_pemasukan_bagihasil']    = DB::table('bagi_hasil_usaha')->whereBetween('bagi_hasil_usaha.tanggal',[$from, $to])->where(['status' => 1, 'status_hasil' => 1])->sum('nilai');


        //ASSET
        $Data['content_asset']          = DB::table('asset')->whereBetween('tanggal_terdaftar',[$from, $to])->orderBy('date_created','desc')->where(['status' => 1])->get();

        $Data['keuangan_pengeluaran']    = DB::table('keuangan')->whereBetween('tanggal',[$from, $to])->where(['status' => 1, 'jenis' => 2 , 'keuangan.approve_direktur' => 1,'approve_bendahara' => 1])->sum('nilai');
        $Data['keuangan_pemasukan']      = DB::table('keuangan')->whereBetween('tanggal',[$from, $to])->where(['status' => 1, 'jenis' => 1 , 'keuangan.approve_direktur' => 1,'approve_bendahara' => 1])->sum('nilai');
        $Data['total_asset']             = DB::table('asset')->whereBetween('tanggal_terdaftar',[$from, $to])->where(['status' => 1])->sum('nilai_asset');
        $Data['admin']        = DB::table('administrator')->where(['status' => 1, 'id_jabatan' => 4])->first();

        //NEWTAB
        $Data['barang_jasa_pemasukan']          = DB::table('barang_jasa')->whereBetween('tanggal',[$from, $to])->orderBy('date_created','desc')->where(['status' => 1])->get();
        $Data['logistik_pengeluaran']           = DB::table('logistik')->whereBetween('tanggal',[$from, $to])->orderBy('date_created','desc')->where(['status' => 1])->get();

        $Data['barang_jasa_pemasukan_total']    = DB::table('barang_jasa')->whereBetween('tanggal',[$from, $to])->where(['status' => 1])->sum('harga');
        $Data['toko_pemasukan_total']    = DB::table('toko')->whereBetween('tanggal',[$from, $to])->where(['status' => 1])->sum('harga');
        $Data['homestay_pemasukan_total']    = DB::table('homestay')->whereBetween('tanggal_masuk',[$from, $to])->where(['status' => 1])->sum('harga');
        $Data['logistik_pengeluaran_total']    = DB::table('logistik')->whereBetween('tanggal',[$from, $to])->where(['status' => 1])->sum('harga');


        $temp = 0;
        foreach($Data['content'] as $newdata){
            if($newdata->approve_direktur == 0){
                $temp += 1;
            }
        }
        if($temp > 0){
            $pdf = PDF::loadView('laporan_keuangan.laporan_unapproved_print', $Data);
        }else{
            $pdf = PDF::loadView('laporan_keuangan.laporan_print', $Data);
            }
        // $pdf = PDF::loadView('laporan_keuangan.laporan_print', $Data);
        return $pdf->download('Laporan Keuangan Bulanan.pdf');
        //return view('laporan_keuangan.laporan_print', $Data);

        ini_restore('max_execution_time');

    }


    function print_laporan_keuangan(request $req, $uuid){
        ini_set('max_execution_time', 300);

        $Data['website']      = DB::table('website')->where(['id' => 1])->first();

        $Data['content']      = DB::table('keuangan')->rightJoin('unit_usaha','unit_usaha.id_unit','=','keuangan.id_unit')->orderBy('keuangan.date_created','desc')->where(['keuangan.status' => 1, 'uuid_keuangan' => $uuid])->first();
        $Data['unit']         = DB::table('unit_usaha')->where(['status' => 1, 'id_unit' => $Data['content']->id_unit])->first();
        $Data['admin']        = DB::table('administrator')->where(['status' => 1, 'id_jabatan' => 4])->first();

        $Data['pemasukan']    = DB::table('barang_jasa')->orderBy('date_created','desc')->where(['status' => 1])->sum('harga');
        $Data['pengeluaran']  = DB::table('logistik')->orderBy('date_created','desc')->where(['status' => 1])->sum('harga');
        $Data['pemasukan_keuangan']    = DB::table('keuangan')->orderBy('date_created','desc')->where(['status' => 1, 'jenis' => 1])->sum('nilai');
        $Data['pengeluaran_keuangan']  = DB::table('keuangan')->orderBy('date_created','desc')->where(['status' => 1 , 'jenis' => 2])->sum('nilai');

        $pdf = PDF::loadView('laporan_keuangan.laporan_keuangan_section', $Data);

        return $pdf->download('Laporan_Keuangan.pdf');
        //return view('laporan_keuangan.laporan_keuangan_section', $Data);

        ini_restore('max_execution_time');
    }

    function print_laporan_keuangan_unapproved(request $req, $uuid){
        ini_set('max_execution_time', 300);

        $Data['website']      = DB::table('website')->where(['id' => 1])->first();

        $Data['content']      = DB::table('keuangan')->rightJoin('unit_usaha','unit_usaha.id_unit','=','keuangan.id_unit')->orderBy('keuangan.date_created','desc')->where(['keuangan.status' => 1, 'uuid_keuangan' => $uuid])->first();
        $Data['unit']         = DB::table('unit_usaha')->where(['status' => 1, 'id_unit' => $Data['content']->id_unit])->first();
        $Data['admin']        = DB::table('administrator')->where(['status' => 1, 'id_jabatan' => 4])->first();

        $Data['pemasukan']    = DB::table('barang_jasa')->orderBy('date_created','desc')->where(['status' => 1])->sum('harga');
        $Data['pengeluaran']  = DB::table('logistik')->orderBy('date_created','desc')->where(['status' => 1])->sum('harga');
        $Data['pemasukan_keuangan']    = DB::table('keuangan')->orderBy('date_created','desc')->where(['status' => 1, 'jenis' => 1])->sum('nilai');
        $Data['pengeluaran_keuangan']  = DB::table('keuangan')->orderBy('date_created','desc')->where(['status' => 1 , 'jenis' => 2])->sum('nilai');

        $pdf = PDF::loadView('laporan_keuangan.laporan_keuangan_unapproved_section', $Data);
        return $pdf->download('laporan-keuangan.pdf');
        //return view('laporan_keuangan.laporan_keuangan_section', $Data);

        ini_restore('max_execution_time');
    }



    function import_laporan_keuangan(request $request){
        Excel::import(new Laporan_keuangan_import, $request->file('file'));
		return redirect('/administrator/laporan-keuangan');
    }

    //LAPORAN KEGIATAN

    function print_laporan_kegiatan_all(request $req){
        ini_set('max_execution_time', 300);
        $to                 = $req->input('filter_to');
        $from               = $req->input('filter_from');
        $Data['to']           = $to;
        $Data['from']         = $from;

        $Data['website']      = DB::table('website')->where(['id' => 1])->first();

        $Data['content']      = DB::table('laporan_kegiatan')->rightJoin('unit_usaha','unit_usaha.id_unit','=','laporan_kegiatan.id_unit')->orderBy('laporan_kegiatan.date_created','desc')->whereBetween('laporan_kegiatan.tanggal',[$from, $to])->where(['laporan_kegiatan.status' => 1])->get();
        // $Data['unit']         = DB::table('unit_usaha')->where(['status' => 1, 'id_unit' => $Data['content']->id_unit])->first();
        $Data['admin']        = DB::table('administrator')->where(['status' => 1, 'id_jabatan' => 4])->first();

        $temp = 0;
        foreach($Data['content'] as $newdata){
            if($newdata->approve_direktur == 0){
                $temp += 1;
            }
        }
        if($temp > 0){
            $pdf = PDF::loadView('laporan_kegiatan.laporan_kegiatan_section_unapproved_all', $Data);
        }else{
            $pdf = PDF::loadView('laporan_kegiatan.laporan_kegiatan_section_all', $Data);
            }
        return $pdf->download('Laporan_Kegiatan_Filter.pdf');

        // $pdf = PDF::loadView('laporan_kegiatan.laporan_kegiatan_section_all', $Data);
        // return $pdf->download('laporan-kegiatan-all.pdf');
      // return view('laporan_kegiatan.laporan_kegiatan_section_all', $Data);

        ini_restore('max_execution_time');
    }

    function print_laporan_kegiatan_mingguan(request $req){
        ini_set('max_execution_time', 300);
        $to                 = Carbon::today()->format('Y-m-d');
        $from               = Carbon::today()->subDay(7)->format('Y-m-d');
        $Data['to']           = $to;
        $Data['from']         = $from;

        $Data['website']      = DB::table('website')->where(['id' => 1])->first();

        $Data['content']      = DB::table('laporan_kegiatan')->rightJoin('unit_usaha','unit_usaha.id_unit','=','laporan_kegiatan.id_unit')->orderBy('laporan_kegiatan.date_created','desc')->whereBetween('laporan_kegiatan.tanggal',[$from, $to])->where(['laporan_kegiatan.status' => 1])->get();
        // $Data['unit']         = DB::table('unit_usaha')->where(['status' => 1, 'id_unit' => $Data['content']->id_unit])->first();
        $Data['admin']        = DB::table('administrator')->where(['status' => 1, 'id_jabatan' => 4])->first();

        $temp = 0;
        foreach($Data['content'] as $newdata){
            if($newdata->approve_direktur == 0){
                $temp += 1;
            }
        }
        if($temp > 0){
            $pdf = PDF::loadView('laporan_kegiatan.laporan_kegiatan_section_unapproved_all', $Data);
        }else{
            $pdf = PDF::loadView('laporan_kegiatan.laporan_kegiatan_section_all', $Data);
            }
        return $pdf->download('Laporan_Kegiatan_Mingguan.pdf');
        // $pdf = PDF::loadView('laporan_kegiatan.laporan_kegiatan_section_all', $Data);
        // return $pdf->download('laporan-kegiatan-all.pdf');
      // return view('laporan_kegiatan.laporan_kegiatan_section_all', $Data);

        ini_restore('max_execution_time');
    }

    function print_laporan_kegiatan_bulanan(request $req){
        ini_set('max_execution_time', 300);
        $to                 = Carbon::today()->format('Y-m-d');
        $from               = Carbon::today()->subDay(30)->format('Y-m-d');
        $Data['to']           = $to;
        $Data['from']         = $from;

        $Data['website']      = DB::table('website')->where(['id' => 1])->first();

        $Data['content']      = DB::table('laporan_kegiatan')->rightJoin('unit_usaha','unit_usaha.id_unit','=','laporan_kegiatan.id_unit')->orderBy('laporan_kegiatan.date_created','desc')->whereBetween('laporan_kegiatan.tanggal',[$from, $to])->where(['laporan_kegiatan.status' => 1])->get();
        // $Data['unit']         = DB::table('unit_usaha')->where(['status' => 1, 'id_unit' => $Data['content']->id_unit])->first();
        $Data['admin']        = DB::table('administrator')->where(['status' => 1, 'id_jabatan' => 4])->first();

        $temp = 0;
        foreach($Data['content'] as $newdata){
            if($newdata->approve_direktur == 0){
                $temp += 1;
            }
        }
        if($temp > 0){
            $pdf = PDF::loadView('laporan_kegiatan.laporan_kegiatan_section_unapproved_all', $Data);
        }else{
            $pdf = PDF::loadView('laporan_kegiatan.laporan_kegiatan_section_all', $Data);
            }
        return $pdf->download('Laporan_Kegiatan_Bulanan.pdf');
        // $pdf = PDF::loadView('laporan_kegiatan.laporan_kegiatan_section_all', $Data);
        // return $pdf->download('laporan-kegiatan-all.pdf');
      // return view('laporan_kegiatan.laporan_kegiatan_section_all', $Data);

        ini_restore('max_execution_time');
    }

    function print_laporan_kegiatan(request $req, $uuid){
        ini_set('max_execution_time', 300);

        $Data['website']      = DB::table('website')->where(['id' => 1])->first();
        $Data['content']      = DB::table('laporan_kegiatan')->where(['status' => 1, 'uuid_kegiatan' => $uuid])->first();
        $Data['unit']         = DB::table('unit_usaha')->where(['status' => 1, 'id_unit' => $Data['content']->id_unit])->first();
        $Data['admin']        = DB::table('administrator')->where(['status' => 1, 'id_jabatan' => 4])->first();


        $pdf = PDF::loadView('laporan_kegiatan.laporan_kegiatan_section', $Data);
        return $pdf->download('Laporan_Kegiatan.pdf');
        //return view('laporan_kegiatan.laporan_kegiatan_section', $Data);

        ini_restore('max_execution_time');
    }
    function print_laporan_kegiatan_unapproved(request $req, $uuid){
        ini_set('max_execution_time', 300);

        $Data['website']      = DB::table('website')->where(['id' => 1])->first();
        $Data['content']      = DB::table('laporan_kegiatan')->where(['status' => 1, 'uuid_kegiatan' => $uuid])->first();
        $Data['unit']         = DB::table('unit_usaha')->where(['status' => 1, 'id_unit' => $Data['content']->id_unit])->first();
        $Data['admin']        = DB::table('administrator')->where(['status' => 1, 'id_jabatan' => 4])->first();


        $pdf = PDF::loadView('laporan_kegiatan.laporan_kegiatan_section_unapproved', $Data);
        return $pdf->download('laporan-kegiatan.pdf');
        //return view('laporan_kegiatan.laporan_kegiatan_section', $Data);

        ini_restore('max_execution_time');
    }

    function create_laporan_kegiatan(request $req){

        $Data = array(
            'uuid_kegiatan'      => Uuid::generate(),
            'tanggal'            => $req->input('tanggal'),
            'id_unit'            => $req->input('id_unit'),
            'keterangan'         => $req->input('keterangan'),
            'lokasi'             => $req->input('lokasi'),
            'upload_by'         => Session::get('username')
        );

        $Database = DB::table('laporan_kegiatan')->insert($Data);
        return redirect('/administrator/laporan-kegiatan');
    }

    function update_data_laporan_kegiatan(request $req, $uuid){
        $Data = array(
            'tanggal'            => $req->input('tanggal'),
            'id_unit'            => $req->input('id_unit'),
            'keterangan'         => $req->input('keterangan'),
            'lokasi'             => $req->input('lokasi'),
            'upload_by'         => Session::get('username')
        );

        $Database = DB::table('laporan_kegiatan')->where(['uuid_kegiatan' => $uuid])->update($Data);
        return redirect('/administrator/laporan-kegiatan')->with('update_ok','Success Update');
    }

    function delete_data_laporan_kegiatan(request $req){
        $uuid = $req->input('uuid');
        $Data = array(
            'status' => 0
        );

        $Database = DB::table('laporan_kegiatan')->where(['uuid_kegiatan' => $uuid])->update($Data);
        return redirect('/administrator/laporan-kegiatan');
    }

    function import_laporan_kegiatan(Request $request) {
        Excel::import(new Laporan_kegiatan_import, $request->file('file'));

		return redirect('/administrator/laporan-kegiatan');
	}

    function sekretaris_approved($status, $uuid){
        if($status == "setuju"){
            $code  = 1;
        } else{
            $code  = 2;
        }

        $Data = array(
            'approve_sekretaris' =>  $code
        );

        $Database = DB::table('laporan_kegiatan')->where(['uuid_kegiatan' => $uuid])->update($Data);
        return redirect('/administrator/laporan-kegiatan/detail/'.$uuid)->with('update_ok','Anda '.$status);
    }
    function bendahara_approved($status, $uuid){
        if($status == "setuju"){
            $code  = 1;
        } else{
            $code  = 2;
        }

        $Data = array(
            'approve_bendahara' =>  $code
        );

        $Database = DB::table('laporan_kegiatan')->where(['uuid_kegiatan' => $uuid])->update($Data);
        return redirect('/administrator/laporan-kegiatan/detail/'.$uuid)->with('update_ok','Anda '.$status);

    }
    function direktur_approved($status, $uuid){
        if($status == "setuju"){
            $code  = 1;
        } else{
            $code  = 2;
        }

        $Data = array(
            'approve_direktur' =>  $code
        );

        $Database = DB::table('laporan_kegiatan')->where(['uuid_kegiatan' => $uuid])->update($Data);
        return redirect('/administrator/laporan-kegiatan/detail/'.$uuid)->with('update_ok','Anda '.$status);

    }

}
