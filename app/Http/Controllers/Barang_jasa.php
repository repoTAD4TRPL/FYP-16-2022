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
        $Data['total_pembelian']    = DB::table('barang_jasa')->where(['status' => 1, 'jenis' => 2])->sum('harga');
        $Data['total_penyewaan']    = DB::table('barang_jasa')->where(['status' => 1, 'jenis' => 1])->sum('harga');

        return view('barang_jasa.index', $Data);
    }

    public function add_barangjasa(){
        $Data['title']      = "Tambah Penyewaan / Pembelian";
        $Data['page']       = "barang_jasa";
        $Data['master']     = "barang_jasa";
        $Data['unit']       = DB::table('unit_usaha')->where(['status' => 1])->get();

        return view('barang_jasa.add', $Data);
    }

    public function update_barangjasa($uuid){
        $check  = DB::table('barang_jasa')->where(['status' => 1, 'uuid_barang_jasa' => $uuid])->first();
        if($check){
            $Data['title']      = "Ubah Penyewaan / Pembelian";
            $Data['page']       = "barang_jasa";
            $Data['master']     = "barang_jasa";
            $Data['value']      = $check;   
            $Data['unit']       = DB::table('unit_usaha')->where(['status' => 1])->get();


            return view('barang_jasa.update', $Data);
        } else{
            return redirect('administrator/barang-jasa');
        }
    }

    //ACTION
    function create_barangjasa(request $req){
    
        $Data = array(
            'uuid_barang_jasa'  => Uuid::generate(),
            'jenis'             => $req->input('jenis'),
            'jumlah'            => $req->input('jumlah'),
            'tanggal'           => $req->input('tanggal'),
            'harga'             => str_replace('.', '', $req->input('harga')),
            'nama'              => $req->input('nama'),
            'id_unit'           => $req->input('id_unit')
        );

        $Database = DB::table('barang_jasa')->insert($Data);
        return redirect('/administrator/barang-jasa');
    }

    function update_data_barangjasa(request $req, $uuid){
        $Data = array(
            'jenis'             => $req->input('jenis'),
            'jumlah'            => $req->input('jumlah'),
            'tanggal'           => $req->input('tanggal'),
            'harga'             => str_replace(array('.',','), '', $req->input('harga')),
            'nama'              => $req->input('nama'),
            'id_unit'           => $req->input('id_unit')
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
    
}
