<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Uuid;
use Webp;
use Session;

use Illuminate\Support\Str;

class Artefak extends Controller{
    public function index(){
        $Data['title']      = "Artefak";
        $Data['page']       = "artefak";
        $Data['master']     = "artefak";
        $Data['content']    = DB::table('artefak')->orderBy('date_created','desc')->where(['status' => 1])->get();
        $list_of_document = DB::table('artefak')->select('nama_dokumen', 'id_artefak','file')->where('status',1)->get();
        
        return view('artefak.index', [
            'Data'=> $Data,
            'master'=>$Data['master'],
            'page'=>$Data['page'],
            'content'=>$Data['content'],
            'list_of_document'=>$list_of_document
        ]);
    }


    public function uploadDoc(Request $request){
        
        // $file_name = $_FILES['filename']['name'];
        $sign_check = DB::table('administrator')->where(['status' => 1, 'id' => Session::get('id')])->first();
        $user_id=DB::table('jabatan')->where(['status' => 1, 'id_jabatan' => $sign_check->id_jabatan])->first();
        $file_name = $request->file('filename')->getClientOriginalName();
        $document_path = $request->file('filename')->storeAs('file/' .$user_id->id_jabatan, $file_name);
        

        DB::table('artefak')->insert([
            'uuid_artefak'=>"",
            'nama_dokumen'=>$file_name,
            'file'=>$document_path,
        ]);

        return redirect('administrator/artefak');
    }

    public function downloadDocument($path){

        $file_path = base64_decode($path);
        return Storage::download($file_path);
    }
}