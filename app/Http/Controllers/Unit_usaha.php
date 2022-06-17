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

class Unit_usaha extends Controller{
    public function index(){
        $Data['title']      = "Unit Usaha";
        $Data['page']       = "unit_usaha";
        $Data['master']     = "unit_usaha";
        $Data['content']    = DB::table('unit_usaha')->orderBy('date_created','desc')->where(['status' => 1])->get();

        return view('unit_usaha.index', $Data);
    }

    public function add_unit(){
        $Data['title']      = "Tambah Unit Usaha";
        $Data['page']       = "unit_usaha";
        $Data['master']     = "unit_usaha";

        return view('unit_usaha.add', $Data);
    }

    public function update_unit($uuid){
        $check  = DB::table('unit_usaha')->where(['status' => 1, 'unit_uuid' => $uuid])->first();
        if($check){
            $Data['title']      = "Ubah Unit Usaha";
            $Data['page']       = "unit_usaha";
            $Data['master']     = "unit_usaha";
            $Data['value']      = $check;   

            return view('unit_usaha.update', $Data);
        } else{
            return redirect('administrator/unit-usaha');
        }
    }

    //ACTION
    function create_unit(request $req){
        //IMG THUMBNAIL
        $path                   = public_path('assets/images/unit-usaha/', 'public');
        $file_nkd               = $req->file('image');
        $extension_nkd          = $file_nkd->getClientOriginalExtension(); 
        $fileimg_nkd            = Uuid::generate() . '.' . $extension_nkd; 
        $response_success_nkd   = $file_nkd->move($path, $fileimg_nkd);     

        $Data = array(
            'unit_uuid'          => Uuid::generate(),
            'nama_unit'          => $req->input('nama_unit'),
            'deskripsi'          => $req->input('deskripsi'),
            'image'              => $fileimg_nkd,
            'tanggal_dibuka'     => $req->input('tanggal_dibuka'),
            'aset'               => $req->input('aset'),
            'lapkeu'             => $req->input('lapkeu'),
            'lapkeg'             => $req->input('lapkeg'),
        );

        $Database = DB::table('unit_usaha')->insert($Data);
        return redirect('/administrator/unit-usaha');
    }

    function update_data_unit(request $req, $uuid){
        $check  = DB::table('unit_usaha')->where(['status' => 1, 'unit_uuid' => $uuid])->first();
        $file_nkd               = $req->file('image');
        if($file_nkd){
            $path                   = public_path('assets/images/unit-usaha/', 'public');
            
            $extension_nkd          = $file_nkd->getClientOriginalExtension(); 
            $fileimg_nkd            = Uuid::generate() . '.' . $extension_nkd; 
            $response_success_nkd   = $file_nkd->move($path, $fileimg_nkd);
            
            if(File::exists($path.$check->image)) {
                File::delete($path.$check->image);
            }     
        }
        $Data = array(
            'nama_unit'          => $req->input('nama_unit'),
            'deskripsi'          => $req->input('deskripsi'),
            'image'              => $file_nkd !="" ? $fileimg_nkd : $check->image,
            'tanggal_dibuka'     => $req->input('tanggal_dibuka'),
            'aset'               => $req->input('aset'),
            'lapkeu'             => $req->input('lapkeu'),
            'lapkeg'             => $req->input('lapkeg'),
        );

        $Database = DB::table('unit_usaha')->where(['unit_uuid' => $uuid])->update($Data);
        return redirect('/administrator/unit-usaha')->with('update_ok','Success Update');
    }

    function delete_data_unit(request $req){
        $uuid = $req->input('uuid');
        $Data = array(
            'status' => 0
        );

        $Database = DB::table('unit_usaha')->where(['unit_uuid' => $uuid])->update($Data);
        return redirect('/administrator/unit-usaha');
    }
    
}
