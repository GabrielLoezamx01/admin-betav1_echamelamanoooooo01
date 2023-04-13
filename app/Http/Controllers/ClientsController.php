<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientsController extends Controller
{
    public function login(Request $request){
        $validated  = $request->validate([
            'email'    => 'required',
            'password' => 'required',
        ]);
        $database   = collect(DB::table('clients')->where('email',$request->email)->first());
        if(isset($database['id'])){
            if (Hash::check($request->password, $database['password'])) {
                session(['id_user'    => $database['id']]);
                session(['name'       => $database['name']]);
                session(['photo'      => $database['photo']]);
                session(['active'     => $database['active']]);
                session(['uuid'       => $database['uuid']]);
                return redirect('Bienvenido');
            } 
        }
        return redirect('login_client');
    }
}
