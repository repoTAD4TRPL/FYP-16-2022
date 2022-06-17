<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;

class Authentication extends Controller{
    public function authentication(){
        return view('authentication');
    }

    public function authentication_sign(Request $request){
        
        $this->validate($request, ['nip'=>'required'], ['password'=>'required']);
        $nip = $request->input('nip');
        $pass = $request->input('password');        

        $users = DB::table('administrator')->where(['nip'=> $nip, 'is_active' => 1])->first();

        if($users == ""){
            return redirect('/')->with('failed','Login gagal');
        } else{
            if($users->nip == $nip AND Hash::check($pass, $users->password) ){ 
                Session::put(['status' => 'is_admin', 'id' => $users->id, 'jabatan' => $users->id_jabatan]);
                return redirect('/administrator/dashboard');
            } else {  
               return redirect('/')->with('failed','Login gagal');
            }
        }
    }
    
}
