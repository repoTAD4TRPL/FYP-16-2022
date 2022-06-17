<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Uuid;
use Webp;
use Session; 

use Illuminate\Support\Str;

class Asset_keuangan extends Controller{
    public function asset_keuangan_grafik($year){
        $Data['title']      = "Keuangan";
        $Data['page']       = "asset_keuangan_grafik";
        $Data['master']     = "asset_keuangan";
        $Data['content']    = DB::table('keuangan')->rightJoin('unit_usaha','unit_usaha.id_unit','=','keuangan.id_unit')->orderBy('keuangan.date_created','desc')->where(['keuangan.status' => 1])->get();
        

        $Data['pemasukan']    = DB::table('keuangan')->orderBy('date_created','desc')->where(['status' => 1, 'jenis' => 1])->sum('nilai');
        $Data['pengeluaran']  = DB::table('keuangan')->orderBy('date_created','desc')->where(['status' => 1, 'jenis' => 2])->sum('nilai');
        $Data['year']         = $year;

        return view('keuangan.grafik', $Data);
    }
 

    //KEUANGAN
    public function index_keuangan(){
        $Data['title']      = "Keuangan";
        $Data['page']       = "keuangan";
        $Data['master']     = "asset_keuangan";
        $Data['content']    = DB::table('keuangan')->rightJoin('unit_usaha','unit_usaha.id_unit','=','keuangan.id_unit')->orderBy('keuangan.date_created','desc')->where(['keuangan.status' => 1])->get();
        
        $Data['pemasukan']    = DB::table('barang_jasa')->orderBy('date_created','desc')->where(['status' => 1])->sum('harga');
        $Data['pengeluaran']  = DB::table('logistik')->orderBy('date_created','desc')->where(['status' => 1])->sum('harga');

        $Data['pemasukan_keuangan']    = DB::table('keuangan')->orderBy('date_created','desc')->where(['status' => 1, 'jenis' => 1])->sum('nilai');
        $Data['pengeluaran_keuangan']  = DB::table('keuangan')->orderBy('date_created','desc')->where(['status' => 1 , 'jenis' => 2])->sum('nilai');
        
        

        return view('keuangan.index', $Data);
    }

    public function detail_keuangan($uuid){
        $check  = DB::table('keuangan')->where(['status' => 1, 'uuid_keuangan' => $uuid])->first();
        if($check){
            $Data['title']      = "Detail Laporan Keuangan";
            $Data['page']       = "keuangan";
            $Data['master']     = "asset_keuangan";
            $Data['value']      = $check;   
            $Data['unit']       = DB::table('unit_usaha')->where(['status' => 1, 'id_unit' => $check->id_unit])->first();


            return view('keuangan.detail', $Data);
        } else{
            return redirect('administrator/keuangan');
        }
    }

    public function add_keuangan(){
        $Data['title']      = "Tambah Keuangan";
        $Data['page']       = "keuangan";
        $Data['master']     = "asset_keuangan";
        $Data['unit']       = DB::table('unit_usaha')->where(['status' => 1])->get();
        

        return view('keuangan.add', $Data);
    }

    public function update_keuangan($uuid){
        $check  = DB::table('keuangan')->where(['status' => 1, 'uuid_keuangan' => $uuid])->first();
        if($check){
            $Data['title']      = "Ubah Keuangan";
            $Data['page']       = "keuangan";
            $Data['master']     = "asset_keuangan";
            $Data['value']      = $check;   
            $Data['unit']       = DB::table('unit_usaha')->where(['status' => 1])->get();



            return view('keuangan.update', $Data);
        } else{
            return redirect('administrator/keuangan');
        }
    }


    //ASSET
    public function index_asset(){
        $Data['title']      = "Sumber Daya BArang";
        $Data['page']       = "asset";
        $Data['master']     = "asset_keuangan";
        $Data['content']    = DB::table('asset')->orderBy('date_created','desc')->where(['status' => 1])->get();
        
        $Data['keuangan_pengeluaran']    = DB::table('keuangan')->where(['status' => 1, 'jenis' => 2])->sum('saldo_akhir');
        $Data['keuangan_pemasukan']      = DB::table('keuangan')->where(['status' => 1, 'jenis' => 1])->sum('saldo_akhir');
        $Data['total_asset']             = DB::table('asset')->where(['status' => 1])->sum('nilai_asset');
        

        return view('asset.index', $Data);
    }

    public function add_asset(){
        $Data['title']      = "Tambah Barang";
        $Data['page']       = "asset";
        $Data['master']     = "asset_keuangan";

        return view('asset.add', $Data);
    }

    public function update_asset($uuid){
        $check  = DB::table('asset')->where(['status' => 1, 'uuid_asset' => $uuid])->first();
        if($check){
            $Data['title']      = "Ubah Barang";
            $Data['page']       = "asset";
            $Data['master']     = "asset_keuangan";
            $Data['value']      = $check;   
            $Data['content']    = DB::table('asset')->orderBy('date_created','desc')->where(['status' => 1])->get();
            $Data['total_asset']= DB::table('asset')->where(['status' => 1])->sum('nilai_asset');
            return view('asset.update', $Data);
        } else{
            return redirect('administrator/asset');
        }
    }

        //MANUSIA
        public function index_manusia(){
            $Data['title']      = "Manusia";
            $Data['page']       = "manusia";
            $Data['master']     = "asset_keuangan";
            $Data['content']    = DB::table('manusia')->orderBy('date_created','desc')->where(['status' => 1])->get();
    
            return view('manusia.index', $Data);
        }
    
        public function add_manusia(){
            $Data['title']      = "Tambah Manusia";
            $Data['page']       = "manusia";
            $Data['master']     = "asset_keuangan";
    
            return view('manusia.add', $Data);
        }
    
        public function update_manusia($uuid){
            $check  = DB::table('manusia')->where(['status' => 1, 'uuid_manusia' => $uuid])->first();
            if($check){
                $Data['title']      = "Ubah Manusia";
                $Data['page']       = "manusia";
                $Data['master']     = "asset_keuangan";
                $Data['value']      = $check;   
    
    
                return view('manusia.update', $Data);
            } else{
                return redirect('administrator/manusia');
            }
        }

    //ACTION


    //KEUANGAN
    function create_keuangan(request $req){
    
        $Data = array(
            'uuid_keuangan'     => Uuid::generate(),
            'tanggal'           => $req->input('tanggal'),
            'jenis'             => $req->input('jenis'),
            'keterangan'        => $req->input('keterangan'),
            'nilai'             => str_replace(array('.',','), '', $req->input('nilai')),
            'id_unit'           => $req->id_unit
        );

        $Database = DB::table('keuangan')->insert($Data);
        return redirect('/administrator/keuangan');
    }

    function update_data_keuangan(request $req, $uuid){
        $Data = array(
            'tanggal'           => $req->input('tanggal'),
            'jenis'             => $req->input('jenis'),
            'keterangan'        => $req->input('keterangan'),
            'nilai'             => str_replace(array('.',','), '', $req->input('nilai')),
            'id_unit'           => $req->id_unit
        );

        $Database = DB::table('keuangan')->where(['uuid_keuangan' => $uuid])->update($Data);
        return redirect('/administrator/keuangan')->with('update_ok','Success Update');
    }

    function delete_data_keuangan(request $req){
        $uuid = $req->input('uuid');
        $Data = array(
            'status' => 0
        );

        $Database = DB::table('keuangan')->where(['uuid_keuangan' => $uuid])->update($Data);
        return redirect('/administrator/keuangan');
    }

    //ASSET
    function create_asset(request $req){
    
        $Data = array(
            'uuid_asset'             => Uuid::generate(),
            'nama_asset'             => $req->input('nama_asset'),
            'nomor_asset'            => $req->input('nomor_asset'),
            'keterangan'             => $req->input('keterangan'),
            'tanggal_terdaftar'      => $req->input('tanggal_terdaftar'),
            'nilai_asset'            => str_replace(array('.',','), '', $req->input('nilai_asset'))
        );

        $Database = DB::table('asset')->insert($Data);
        return redirect('/administrator/asset');
    }

    function update_data_asset(request $req, $uuid){
        $Data = array(
            'nama_asset'             => $req->input('nama_asset'),
            'nomor_asset'            => $req->input('nomor_asset'),
            'keterangan'             => $req->input('keterangan'),
            'tanggal_terdaftar'      => $req->input('tanggal_terdaftar'),
            'nilai_asset'            => str_replace(array('.',','), '', $req->input('nilai_asset'))
        );

        $Database = DB::table('asset')->where(['uuid_asset' => $uuid])->update($Data);
        return redirect('/administrator/asset')->with('update_ok','Success Update');
    }

    function delete_data_asset(request $req){
        $uuid = $req->input('uuid');
        $Data = array(
            'status' => 0
        );

        $Database = DB::table('asset')->where(['uuid_asset' => $uuid])->update($Data);
        return redirect('/administrator/asset');
    }
    

//MANUSIA
    function create_manusia(request $req){
    // dd($req->all());
        $Data = array(
            'uuid_manusia'          => Uuid::generate(),
            'nama'                  => $req->input('nama'),
            'kelamin'               => $req->input('kelamin'),
            'tugas'                 => $req->input('tugas'),
            'is_active'             => $req->input('is_active'),
        );

        $Database = DB::table('manusia')->insert($Data);
        return redirect('/administrator/manusia');
    }

    function update_data_manusia(request $req, $uuid){
        $Data = array(
            'nama'               => $req->input('nama'),
            'kelamin'            => $req->input('kelamin'),
            'tugas'              => $req->input('tugas'),
            'is_active'          => $req->input('is_active')
        );

        $Database = DB::table('manusia')->where(['uuid_manusia' => $uuid])->update($Data);
        return redirect('/administrator/manusia')->with('update_ok','Success Update');
    }

    function delete_data_manusia(request $req){
        $uuid = $req->input('uuid');
        $Data = array(
            'status' => 0
        );

        $Database = DB::table('manusia')->where(['uuid_manusia' => $uuid])->update($Data);
        return redirect('/administrator/manusia');
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

        $Database = DB::table('keuangan')->where(['uuid_keuangan' => $uuid])->update($Data);
        return redirect('/administrator/keuangan/detail/'.$uuid)->with('update_ok','Anda '.$status);
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

        $Database = DB::table('keuangan')->where(['uuid_keuangan' => $uuid])->update($Data);
        return redirect('/administrator/keuangan/detail/'.$uuid)->with('update_ok','Anda '.$status);

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

        $Database = DB::table('keuangan')->where(['uuid_keuangan' => $uuid])->update($Data);
        return redirect('/administrator/keuangan/detail/'.$uuid)->with('update_ok','Anda '.$status);
        
    }
}