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

class Dashboard extends Controller{

    public function add_programkerja(){
        $Data['title']      = "Tambah Program Kerja";
        $Data['page']       = "dashboard";
        $Data['master']     = "dashboard";

        return view('dashboard.add', $Data);
    }
    public function update_programkerja($uuid){
        $check  = DB::table('program_kerja')->where(['status' => 1, 'uuid_pk' => $uuid])->first();
        if($check){
            $Data['title']      = "Ubah Program Kerja";
            $Data['page']       = "dashboard";
            $Data['master']     = "dashboard";
            $Data['value']      = $check;

            return view('dashboard.update', $Data);
        } else{
            return redirect('administrator/dashboard');
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
        return redirect('/administrator/dashboard');
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
        return redirect('/administrator/dashboard')->with('update_ok','Success Update');
    }

    function delete_data_programkerja(request $req){
        $uuid = $req->input('uuid');
        $Data = array(
            'status' => 0
        );

        $Database = DB::table('program_kerja')->where(['uuid_pk' => $uuid])->update($Data);
        return redirect('/administrator/dashboard');
    }


    public function dashboard(request $req){
        $Data['title']      = "Dashboard";
        $Data['page']       = "dashboard";
        $Data['master']     = "dashboard";

        $Data['year']       = $req->input('year') != "" ? $req->input('year') : Date('Y');
        $Data['barang_jasa']= DB::table('barang_jasa')->whereYear('tanggal','=',$Data['year'])->where(['status' => 1])->sum('harga');
        $Data['toko']       = DB::table('toko')->whereYear('tanggal','=',$Data['year'])->where(['status' => 1])->sum('harga');
        $Data['homestay']= DB::table('homestay')->whereYear('tanggal_masuk','=',$Data['year'])->where(['status' => 1])->sum('harga');
        $Data['asset']      = DB::table('asset')->whereYear('tanggal_terdaftar','=',$Data['year'])->where(['status' => 1])->sum('nilai_asset');
        $Data['hasil_usaha']= DB::table('bagi_hasil_usaha')->whereYear('tanggal','=',$Data['year'])->where(['status' => 1, 'status_hasil'=> 1])->sum('nilai');
        $Data['content']    = DB::table('program_kerja')->orderBy('date_created','desc')->where(['status' => 1])->get();


        return view('dashboard.index', $Data);
    }

    public function pengaturan(){
        $Data['title']      = "Pengaturan website";
        $Data['page']       = "";
        $Data['master']     = "";
        $Data['content']    = DB::table('website')->where(['id' => 1])->first();

        return view('pengaturan.index', $Data);
    }


    function pengaturan_update(request $req){
        $check                  = DB::table('website')->where(['id' => 1])->first();
        $file_nkd               = $req->file('image');
        if($check){
            if($file_nkd){
                $path                   = public_path('assets/images/', 'public');

                $extension_nkd          = $file_nkd->getClientOriginalExtension();
                $fileimg_nkd            = Uuid::generate() . '.' . $extension_nkd;
                $response_success_nkd   = $file_nkd->move($path, $fileimg_nkd);

                if(File::exists($path.$check->logo)) {
                    File::delete($path.$check->logo);
                }
            }
        } else{
            $path                   = public_path('assets/images/', 'public');

            $extension_nkd          = $file_nkd->getClientOriginalExtension();
            $fileimg_nkd            = Uuid::generate() . '.' . $extension_nkd;
            $response_success_nkd   = $file_nkd->move($path, $fileimg_nkd);
        }


        $Data = array(
            'name'               => $req->input('name'),
            'logo'               => $check ? ($file_nkd !="" ? $fileimg_nkd : $check->logo ) :  $fileimg_nkd
        );

        if($check){
            $Database = DB::table('website')->where(['id' => 1])->update($Data);
        } else{
            $Database = DB::table('website')->insert($Data);
        }
        return redirect('/administrator/pengaturan')->with('update_ok','Success Update');
    }

}
