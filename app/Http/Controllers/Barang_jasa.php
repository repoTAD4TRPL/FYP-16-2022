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

class Barang_jasa extends Controller{
    public function index(){
        $Data['title']      = "Barang & Jasa";
        $Data['page']       = "barang_jasa";
        $Data['master']     = "barang_jasa";
        $Data['content']    = DB::table('barang_jasa')->rightJoin('unit_usaha','unit_usaha.id_unit','=','barang_jasa.id_unit')->orderBy('barang_jasa.date_created','desc')->where(['barang_jasa.status' => 1])->get();
        $Data['total_pemasukan']    = DB::table('barang_jasa')->where(['status' => 1])->sum('harga');

        return view('barang_jasa.index', $Data);
    }

    public function add_barangjasa(){
        $Data['title']      = "Tambah Transaksi Traktor";
        $Data['page']       = "barang_jasa";
        $Data['master']     = "barang_jasa";
        $Data['unit']       = DB::table('unit_usaha')->where(['status' => 1])->get();

        return view('barang_jasa.add', $Data);
    }

    public function update_barangjasa($uuid){
        $check  = DB::table('barang_jasa')->where(['status' => 1, 'uuid_barang_jasa' => $uuid])->first();
        if($check){
            $Data['title']      = "Ubah Transaksi Traktor";
            $Data['page']       = "barang_jasa";
            $Data['master']     = "barang_jasa";
            $Data['value']      = $check;
            $Data['unit']       = DB::table('unit_usaha')->where(['status' => 1])->get();


            return view('barang_jasa.update', $Data);
        } else{
            return redirect('administrator/barang-jasa');
        }
    }
    public function index_toko(){
        $Data['title']      = "Toko";
        $Data['page']       = "toko";
        $Data['master']     = "toko";
        $Data['content']    = DB::table('toko')->rightJoin('unit_usaha','unit_usaha.id_unit','=','toko.id_unit')->orderBy('toko.date_created','desc')->where(['toko.status' => 1])->get();
        $Data['total_pemasukan']    = DB::table('toko')->where(['status' => 1])->sum('harga');

        return view('toko.index', $Data);
    }

    public function add_toko(){
        $Data['title']      = "Tambah Transaksi Toko";
        $Data['page']       = "toko";
        $Data['master']     = "toko";
        $Data['unit']       = DB::table('unit_usaha')->where(['status' => 1])->get();

        return view('toko.add', $Data);
    }

    public function update_toko($uuid){
        $check  = DB::table('toko')->where(['status' => 1, 'uuid_toko' => $uuid])->first();
        if($check){
            $Data['title']      = "Ubah Transaksi Toko";
            $Data['page']       = "toko";
            $Data['master']     = "toko";
            $Data['value']      = $check;
            $Data['unit']       = DB::table('unit_usaha')->where(['status' => 1])->get();


            return view('toko.update', $Data);
        } else{
            return redirect('administrator/toko');
        }
    }

    public function index_homestay(){
        $Data['title']      = "Homestay";
        $Data['page']       = "homestay";
        $Data['master']     = "homestay";
        $Data['content']    = DB::table('homestay')->rightJoin('unit_usaha','unit_usaha.id_unit','=','homestay.id_unit')->orderBy('homestay.date_created','desc')->where(['homestay.status' => 1])->get();
        $Data['total_pemasukan']    = DB::table('homestay')->where(['status' => 1])->sum('harga');

        return view('homestay.index', $Data);
    }

    public function add_homestay(){
        $Data['title']      = "Tambah Transaksi Homestay";
        $Data['page']       = "homestay";
        $Data['master']     = "homestay";
        $Data['unit']       = DB::table('unit_usaha')->where(['status' => 1])->get();

        return view('homestay.add', $Data);
    }

    public function update_homestay($uuid){
        $check  = DB::table('homestay')->where(['status' => 1, 'uuid_homestay' => $uuid])->first();
        if($check){
            $Data['title']      = "Ubah Transaksi Homestay";
            $Data['page']       = "homestay";
            $Data['master']     = "homestay";
            $Data['value']      = $check;
            $Data['unit']       = DB::table('unit_usaha')->where(['status' => 1])->get();


            return view('homestay.update', $Data);
        } else{
            return redirect('administrator/homestay');
        }
    }

    //ACTION
    function create_barangjasa(request $req){

        $Data = array(
            'uuid_barang_jasa'  => Uuid::generate(),
            'jumlah'            => $req->input('jumlah'),
            'tanggal'           => $req->input('tanggal'),
            'harga'             => str_replace('.', '', $req->input('harga')),
            'nama'              => $req->input('nama'),
            'id_unit'           => $req->input('id_unit'),
            'upload_by'         => Session::get('username')
        );

        $Database = DB::table('barang_jasa')->insert($Data);
        return redirect('/administrator/barang-jasa');
    }

    function update_data_barangjasa(request $req, $uuid){
        $Data = array(
            'jumlah'            => $req->input('jumlah'),
            'tanggal'           => $req->input('tanggal'),
            'harga'             => str_replace(array('.',','), '', $req->input('harga')),
            'nama'              => $req->input('nama'),
            'id_unit'           => $req->input('id_unit'),
            'upload_by'         => Session::get('username')
        );

        $Database = DB::table('barang_jasa')->where(['uuid_barang_jasa' => $uuid])->update($Data);
        return redirect('/administrator/barang-jasa')->with('update_ok','Success Update');
    }

    function delete_data_barangjasa(request $req){
        $uuid = $req->input('uuid');
        $Data = array(
            'status' => 0
        );

        $Database = DB::table('barang_jasa')->where(['uuid_barang_jasa' => $uuid])->update($Data);
        return redirect('/administrator/barang-jasa');
    }

    function create_toko(request $req){

        $Data = array(
            'uuid_toko'       => Uuid::generate(),
            'keterangan'      => $req->input('keterangan'),
            'harga'           => str_replace('.', '', $req->input('harga')),
            'tanggal'         => $req->input('tanggal'),
            'pembeli'         => $req->input('pembeli'),
            'upload_by'       => Session::get('username'),
            'id_unit'           => $req->input('id_unit')
        );

        $Database = DB::table('toko')->insert($Data);
        return redirect('/administrator/toko');
    }

    function update_data_toko(request $req, $uuid){
        $Data = array(
            'keterangan'      => $req->input('keterangan'),
            'harga'           => str_replace('.', '', $req->input('harga')),
            'tanggal'         => $req->input('tanggal'),
            'pembeli'         => $req->input('pembeli'),
            'id_unit'           => $req->input('id_unit'),
            'upload_by'       => Session::get('username')
        );

        $Database = DB::table('toko')->where(['uuid_toko' => $uuid])->update($Data);
        return redirect('/administrator/toko')->with('update_ok','Success Update');
    }

    function delete_data_toko(request $req){
        $uuid = $req->input('uuid');
        $Data = array(
            'status' => 0
        );

        $Database = DB::table('toko')->where(['uuid_toko' => $uuid])->update($Data);
        return redirect('/administrator/toko');
    }

    function create_homestay(request $req){

        $Data = array(
            'uuid_homestay'       => Uuid::generate(),
            'nama'                => $req->input('nama'),
            'tipe_kamar'          => $req->input('tipe_kamar'),
            'tanggal_masuk'       => $req->input('tanggal_masuk'),
            'tanggal_keluar'      => $req->input('tanggal_keluar'),
            'pembeli'             => $req->input('pembeli'),
            'harga'               => str_replace('.', '', $req->input('harga')),
            'upload_by'           => Session::get('username'),
            'id_unit'             => $req->input('id_unit')
        );

        $Database = DB::table('homestay')->insert($Data);
        return redirect('/administrator/homestay');
    }

    function update_data_homestay(request $req, $uuid){
        $Data = array(
            'nama'                => $req->input('nama'),
            'tipe_kamar'          => $req->input('tipe_kamar'),
            'tanggal_masuk'       => $req->input('tanggal_masuk'),
            'tanggal_keluar'      => $req->input('tanggal_keluar'),
            'pembeli'             => $req->input('pembeli'),
            'harga'               => str_replace('.', '', $req->input('harga')),
            'upload_by'           => Session::get('username'),
            'id_unit'             => $req->input('id_unit')
        );

        $Database = DB::table('homestay')->where(['uuid_homestay' => $uuid])->update($Data);
        return redirect('/administrator/homestay')->with('update_ok','Success Update');
    }

    function delete_data_homestay(request $req){
        $uuid = $req->input('uuid');
        $Data = array(
            'status' => 0
        );

        $Database = DB::table('homestay')->where(['uuid_homestay' => $uuid])->update($Data);
        return redirect('/administrator/homestay');
    }


}
