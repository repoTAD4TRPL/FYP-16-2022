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

class Pegawai extends Controller{
    public function index_profile(){
        $Data['title']      = "Profile";
        $Data['page']       = "";
        $Data['master']     = "";
        $Data['unit']       = DB::table('unit_usaha')->where(['status' => 1])->get();
        $Data['jabatan']    = DB::table('jabatan')->where(['status' => 1])->get();
        $Data['value']      = $check  = DB::table('administrator')->where(['status' => 1, 'id' => Session::get('id')])->first();

        return view('pegawai.profile', $Data);
    }

    public function index_pegawai(){
        $Data['title']      = "Pegawai";
        $Data['page']       = "";
        $Data['master']     = "";
        $Data['content']    = DB::table('administrator')->rightJoin('jabatan','jabatan.id_jabatan','=','administrator.id_jabatan')->orderBy('administrator.date_created','desc')->whereNotIn('id',[Session::get('id')])->where(['administrator.status' => 1])->get();
        

        return view('pegawai.index', $Data);
    }

    public function add_pegawai(){
        $Data['title']      = "Tambah Pegawai";
        $Data['page']       = "";
        $Data['master']     = "";
        $Data['unit']       = DB::table('unit_usaha')->where(['status' => 1])->get();
        $Data['jabatan']    = DB::table('jabatan')->where(['status' => 1])->get();

        return view('pegawai.add', $Data);
    }

    public function update_pegawai($uuid){
        $check  = DB::table('administrator')->where(['status' => 1, 'uuid' => $uuid])->first();
        if($check){
            $Data['title']      = "Ubah Pegawai";
            $Data['page']       = "";
            $Data['master']     = "";
            $Data['value']      = $check;   
            $Data['unit']       = DB::table('unit_usaha')->where(['status' => 1])->get();
            $Data['jabatan']    = DB::table('jabatan')->where(['status' => 1])->get();

            return view('pegawai.update', $Data);
        } else{
            return redirect('administrator/pegawai');
        }
    }

    //ACTION
    function create_pegawai(request $req){
        //IMG THUMBNAIL
        $path                   = public_path('assets/images/pegawai/', 'public');
        $file_nkd               = $req->file('image');
        $extension_nkd          = $file_nkd->getClientOriginalExtension(); 
        $fileimg_nkd            = Uuid::generate() . '.' . $extension_nkd; 
        $response_success_nkd   = $file_nkd->move($path, $fileimg_nkd);     

        $Data = array(
            'uuid'        => Uuid::generate(),
            'id_jabatan'  => $req->input('id_jabatan'),
            'nama'        => $req->input('nama'),
            'nip'         => $req->input('nip'),
            'kelamin'     => $req->input('kelamin'),
            'email'       => $req->input('email'),
            'id_unit'     => $req->input('id_unit'),
            'password'    => Hash::make($req->input('password')),
            'avatar'      => $fileimg_nkd,
            'is_active'   => $req->input('is_active')
        );

        $Database = DB::table('administrator')->insert($Data);
        return redirect('/administrator/pegawai');
    }

    function update_data_pegawai(request $req, $uuid){
        $check  = DB::table('administrator')->where(['status' => 1, 'uuid' => $uuid])->first();
        $file_nkd               = $req->file('image');
        if($file_nkd){
            $path                   = public_path('assets/images/pegawai/', 'public');
            
            $extension_nkd          = $file_nkd->getClientOriginalExtension(); 
            $fileimg_nkd            = Uuid::generate() . '.' . $extension_nkd; 
            $response_success_nkd   = $file_nkd->move($path, $fileimg_nkd);
            
            if(File::exists($path.$check->avatar)) {
                File::delete($path.$check->avatar);
            }     
        }
        $Data = array(
            'id_jabatan'  => $req->input('id_jabatan'),
            'nama'        => $req->input('nama'),
            'nip'         => $req->input('nip'),
            'kelamin'     => $req->input('kelamin'),
            'email'       => $req->input('email'),
            'id_unit'     => $req->input('id_unit'),
            'password'    => $req->input('password')  != '' ?  Hash::make($req->input('password')) : $check->password,
            'avatar'      => $file_nkd !='' ? $fileimg_nkd : $check->avatar,
            'is_active'   => $req->input('is_active')
        );

        $Database = DB::table('administrator')->where(['uuid' => $uuid])->update($Data);
        return redirect('/administrator/pegawai')->with('update_ok','Success Update');
    }

    function delete_data_pegawai(request $req){
        $uuid = $req->input('uuid');
        $Data = array(
            'status' => 0
        );

        $Database = DB::table('administrator')->where(['uuid' => $uuid])->update($Data);
        return redirect('/administrator/pegawai');
    }


    function update_profile(request $req, $uuid){
        $check  = DB::table('administrator')->where(['status' => 1, 'uuid' => $uuid])->first();
        $file_nkd               = $req->file('image');
        if($check->id_jabatan == "4"){
            $file_ttd                   = $req->file('file_ttd');
            if($file_ttd){
                $pathttd                   = public_path('assets/images/ttd/', 'public');
                
                $extension_ttd          = $file_ttd->getClientOriginalExtension(); 
                $fileimg_ttd            = Uuid::generate() . '.' . $extension_ttd; 
                $response_success_nkd   = $file_ttd->move($pathttd, $fileimg_ttd);
                
                if(File::exists($pathttd.$check->file_ttd)) {
                    File::delete($pathttd.$check->file_ttd);
                }     
            }
        }


        if($file_nkd){
            $path                   = public_path('assets/images/pegawai/', 'public');
            
            $extension_nkd          = $file_nkd->getClientOriginalExtension(); 
            $fileimg_nkd            = Uuid::generate() . '.' . $extension_nkd; 
            $response_success_nkd   = $file_nkd->move($path, $fileimg_nkd);
            
            if(File::exists($path.$check->avatar)) {
                File::delete($path.$check->avatar);
            }     
        }
        $Data = array(
            'nama'        => $req->input('nama'),
            'nip'         => $req->input('nip'),
            'kelamin'     => $req->input('kelamin'),
            'email'       => $req->input('email'),
            'password'    => $req->input('password')  != '' ?  Hash::make($req->input('password')) : $check->password,
            'avatar'      => $file_nkd !='' ? $fileimg_nkd : $check->avatar,
            'file_ttd'    => $check->id_jabatan == "4" ? ($file_ttd !='' ? $fileimg_ttd : '') : ''
        );

        $Database = DB::table('administrator')->where(['uuid' => $uuid])->update($Data);
        return redirect('/administrator/profile')->with('update_ok','Success Update');
    }

    //SIGNOUT
    function signout(){
      
        Session::flush();
        return redirect('/');
    }
    
}
