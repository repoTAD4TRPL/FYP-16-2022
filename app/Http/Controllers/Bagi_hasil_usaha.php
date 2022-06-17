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

class Bagi_hasil_usaha extends Controller{
    //BAGI HASIL USAHA
    public function index_bagi_hasil_usaha(){
        $Data['title']      = "Bagi hasil usaha";
        $Data['page']       = "bagi_hasil_usaha";
        $Data['master']     = "bagi_hasil_usaha";
        $Data['content']    = DB::table('bagi_hasil_usaha')->rightJoin('mitra','mitra.id_mitra','=','bagi_hasil_usaha.id_mitra')->orderBy('bagi_hasil_usaha.date_created','desc')->where(['bagi_hasil_usaha.status' => 1])->get();
        $Data['total_pemasukan']    = DB::table('bagi_hasil_usaha')->where(['status' => 1, 'status_hasil' => 1])->sum('nilai');


        return view('bagi_hasil_usaha.index', $Data);
    }

    public function add_bagi_hasil_usaha(){
        $Data['title']      = "Tambah Bagi hasil usaha";
        $Data['page']       = "bagi_hasil_usaha";
        $Data['master']     = "bagi_hasil_usaha";
        $Data['mitra']      = DB::table('mitra')->orderBy('date_created','desc')->where(['status' => 1, 'status_mitra' => 1])->get();

        return view('bagi_hasil_usaha.add', $Data);
    }

    public function update_bagi_hasil_usaha($uuid){
        $check  = DB::table('bagi_hasil_usaha')->where(['status' => 1, 'uuid_bagi_hasil' => $uuid])->first();
        if($check){
            $Data['title']      = "Ubah Bagi hasil usaha";
            $Data['page']       = "bagi_hasil_usaha";
            $Data['master']     = "bagi_hasil_usaha";
            $Data['value']      = $check;   
            $Data['mitra']      = DB::table('mitra')->orderBy('date_created','desc')->where(['status' => 1, 'status_mitra' => 1])->get();


            return view('bagi_hasil_usaha.update', $Data);
        } else{
            return redirect('administrator/bagi_hasil_usaha');
        }
    }


    // MITRA
    public function index_mitra(){
        $Data['title']      = "Mitra";
        $Data['page']       = "bagi_hasil_usaha_mitra";
        $Data['master']     = "bagi_hasil_usaha";
        $Data['content']    = DB::table('mitra')->orderBy('date_created','desc')->where(['status' => 1])->get();

        return view('mitra.index', $Data);
    }

    public function add_mitra(){
        $Data['title']      = "Tambah Mitra";
        $Data['page']       = "bagi_hasil_usaha_mitra";
        $Data['master']     = "bagi_hasil_usaha";

        return view('mitra.add', $Data);
    }

    public function update_mitra($uuid){
        $check  = DB::table('mitra')->where(['status' => 1, 'uuid_mitra' => $uuid])->first();
        if($check){
            $Data['title']      = "Ubah Mitra";
            $Data['page']       = "bagi_hasil_usaha_mitra";
            $Data['master']     = "bagi_hasil_usaha";
            $Data['value']      = $check;   

            return view('mitra.update', $Data);
        } else{
            return redirect('administrator/mitra');
        }
    }

    //ACTION

    //BAGI HASIL USAHA
    function create_bagi_hasil_usaha(request $req){

        $Data = array(
            'uuid_bagi_hasil'       => Uuid::generate(),
            'jenis_bagi_hasil'      => $req->input('jenis_bagi_hasil'),
            'nama'                  => $req->input('nama'),
            'id_mitra'              => $req->input('id_mitra'),
            'jumlah'                => $req->input('jumlah'),
            'tanggal'               => $req->input('tanggal'),
            'nilai'                 => str_replace(array('.',','), '', $req->input('nilai')),
            'status_hasil'          => $req->input('status_hasil')
        );

        $Database = DB::table('bagi_hasil_usaha')->insert($Data);
        return redirect('/administrator/bagi-hasil-usaha');
    }

    function update_data_bagi_hasil_usaha(request $req, $uuid){
        $Data = array(
            'jenis_bagi_hasil'      => $req->input('jenis_bagi_hasil'),
            'nama'                  => $req->input('nama'),
            'id_mitra'              => $req->input('id_mitra'),
            'jumlah'                => $req->input('jumlah'),
            'tanggal'               => $req->input('tanggal'),
            'nilai'                 => str_replace(array('.',','), '', $req->input('nilai')),
            'status_hasil'          => $req->input('status_hasil')
        );

        $Database = DB::table('bagi_hasil_usaha')->where(['uuid_bagi_hasil' => $uuid])->update($Data);
        return redirect('/administrator/bagi-hasil-usaha')->with('update_ok','Success Update');
    }

    function delete_data_bagi_hasil_usaha(request $req){
        $uuid = $req->input('uuid');
        $Data = array(
            'status' => 0
        );

        $Database = DB::table('bagi_hasil_usaha')->where(['uuid_bagi_hasil' => $uuid])->update($Data);
        return redirect('/administrator/bagi-hasil-usaha');
    }


    // MITRA
    function create_mitra(request $req){

        $Data = array(
            'uuid_mitra'          => Uuid::generate(),
            'nama_mitra'          => $req->input('nama_mitra'),
            'alamat'              => $req->input('alamat'),
            'bidang'              => $req->input('bidang'),
            'tanggal_mulai'       => $req->input('tanggal_mulai'),
            'tanggal_selesai'     => $req->input('tanggal_selesai'),
            'status_mitra'        => $req->input('status_mitra')
        );

        $Database = DB::table('mitra')->insert($Data);
        return redirect('/administrator/mitra');
    }

    function update_data_mitra(request $req, $uuid){
        $Data = array(
            'nama_mitra'          => $req->input('nama_mitra'),
            'alamat'              => $req->input('alamat'),
            'bidang'              => $req->input('bidang'),
            'tanggal_mulai'       => $req->input('tanggal_mulai'),
            'tanggal_selesai'     => $req->input('tanggal_selesai'),
            'status_mitra'        => $req->input('status_mitra')
        );

        $Database = DB::table('mitra')->where(['uuid_mitra' => $uuid])->update($Data);
        return redirect('/administrator/mitra')->with('update_ok','Success Update');
    }

    function delete_data_mitra(request $req){
        $uuid = $req->input('uuid');
        $Data = array(
            'status' => 0
        );

        $Database = DB::table('mitra')->where(['uuid_mitra' => $uuid])->update($Data);
        return redirect('/administrator/mitra');
    }
    
}
