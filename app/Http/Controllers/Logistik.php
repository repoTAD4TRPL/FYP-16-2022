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

class Logistik extends Controller{
    public function index(){
        $Data['title']      = "Logistik";
        $Data['page']       = "logistik";
        $Data['master']     = "logistik";
        $Data['content']    = DB::table('logistik')
        ->rightJoin('unit_usaha','unit_usaha.id_unit','=','logistik.id_unit')
        ->orderBy('logistik.date_created','desc')->where(['logistik.status' => 1])->get();
        $Data_tabel_logistik = DB::table('logistik')->where('id_unit', 1)->where(['logistik.status' => 1])->get();
        $Data_table_toArray = $Data_tabel_logistik->toArray();
        foreach($Data_table_toArray as $data){
            $Data['content']->push($data);
        }
        // $Data['content']->push($Data_table_toArray);
        $Data['total_logistik'] = DB::table('logistik')->where(['logistik.status' => 1])->sum('harga');
        // dd($Data);
        return view('logistik.index', $Data);
    }

    public function add_logistik(){
        $Data['title']      = "Tambah Logistik";
        $Data['page']       = "logistik";
        $Data['master']     = "logistik";
        $Data['unit']       = DB::table('unit_usaha')->where(['status' => 1])->get();

        return view('logistik.add', $Data);
    }

    public function update_logistik($uuid){
        $check  = DB::table('logistik')->where(['status' => 1, 'uuid_logistik' => $uuid])->first();
        if($check){
            $Data['title']      = "Ubah Logistik";
            $Data['page']       = "logistik";
            $Data['master']     = "logistik";
            $Data['value']      = $check;
            $Data['unit']       = DB::table('unit_usaha')->where(['status' => 1])->get();


            return view('logistik.update', $Data);
        } else{
            return redirect('administrator/logistik');
        }
    }

    //ACTION
    function create_logistik(request $req){

        $Data = array(
            'uuid_logistik'      => Uuid::generate(),
            'id_unit'            => $req->input('id_unit'),
            'tanggal'            => $req->input('tanggal'),
            'jumlah'             => $req->input('jumlah'),
            'keterangan'         => $req->input('keterangan'),
            'harga'              => str_replace('.', '', $req->input('harga')),
            'upload_by'         => Session::get('username'),
        );

        $Database = DB::table('logistik')->insert($Data);
        return redirect('/administrator/logistik');
    }

    function update_data_logistik(request $req, $uuid){
        $Data = array(
            'id_unit'            => $req->input('id_unit'),
            'tanggal'            => $req->input('tanggal'),
            'jumlah'             => $req->input('jumlah'),
            'keterangan'         => $req->input('keterangan'),
            'harga'              => str_replace(array('.',','), '', $req->input('harga')),
            'upload_by'         => Session::get('username')
        );

        $Database = DB::table('logistik')->where(['uuid_logistik' => $uuid])->update($Data);
        return redirect('/administrator/logistik')->with('update_ok','Success Update');
    }

    function delete_data_logistik(request $req){
        $uuid = $req->input('uuid');
        $Data = array(
            'status' => 0
        );

        $Database = DB::table('logistik')->where(['uuid_logistik' => $uuid])->update($Data);
        return redirect('/administrator/logistik');
    }

}
