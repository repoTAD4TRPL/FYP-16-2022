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

class Program_kerja extends Controller{
    public function index_programkerja(request $req){
        $Data['title']      = "Program Kerja";
        $Data['page']       = "program-kerja";
        $Data['master']     = "program-kerja";
        $Data['content']    = DB::table('program_kerja')->orderBy('date_created','desc')->where(['status' => 1])->get();
        $Data['year']       = $req->input('year') != "" ? $req->input('year') : Date('Y');

        return view('program-kerja.index', $Data);
    }
    public function add_programkerja(){
        $Data['title']      = "Tambah Program Kerja";
        $Data['page']       = "program-kerja";
        $Data['master']     = "program-kerja";

        return view('program-kerja.add', $Data);
    }
    public function update_programkerja($uuid){
        $check  = DB::table('program_kerja')->where(['status' => 1, 'uuid_pk' => $uuid])->first();
        if($check){
            $Data['title']      = "Ubah Program Kerja";
            $Data['page']       = "program-kerja";
            $Data['master']     = "program-kerja";
            $Data['value']      = $check;

            return view('program-kerja.update', $Data);
        } else{
            return redirect('administrator/program-kerja');
        }
    }
    function create_programkerja(request $req){

        $Data = array(
            'uuid_pk'               => Uuid::generate(),
            'program'               => $req->input('program'),
            'kegiatan'              => $req->input('kegiatan'),
            'anggaran'              => str_replace(array('.',','), '', $req->input('anggaran')),
            'sumber'                => $req->input('sumber'),
            'output'                => $req->input('output'),
            'indikator'             => $req->input('indikator'),
            'waktu'                 => $req->input('waktu'),
        );

        $Database = DB::table('program_kerja')->insert($Data);
        return redirect('/administrator/program-kerja');
    }

    function update_data_programkerja(request $req, $uuid){
        $Data = array(
            'program'               => $req->input('program'),
            'kegiatan'              => $req->input('kegiatan'),
            'anggaran'              => str_replace(array('.',','), '', $req->input('anggaran')),
            'sumber'                => $req->input('sumber'),
            'output'                => $req->input('output'),
            'indikator'             => $req->input('indikator'),
            'waktu'                 => $req->input('waktu'),
        );

        $Database = DB::table('program_kerja')->where(['uuid_pk' => $uuid])->update($Data);
        return redirect('/administrator/program-kerja')->with('update_ok','Success Update');
    }

    function delete_data_programkerja(request $req){
        $uuid = $req->input('uuid');
        $Data = array(
            'status' => 0
        );

        $Database = DB::table('program_kerja')->where(['uuid_pk' => $uuid])->update($Data);
        return redirect('/administrator/program-kerja');
    }

}
