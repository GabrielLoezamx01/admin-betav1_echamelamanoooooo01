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
        $database   = $this->database_user($request->email);
        if(isset($database['id'])){
            if (Hash::check($request->password, $database['password'])) {
                $this->session_clients($database);
                return redirect('Bienvenido');
            }
        }
        return redirect('login_client');
    }
    public function crear(Request $request){
        $validated  = $request->validate([
            'email'    => 'required',
            'password' => 'required',
        ]);
        if (!DB::table('clients')->where('email', $request->email)->exists()) {
            DB::table('clients')->insert([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $database   = $this->database_user($request->email);
            $this->session_clients($database);
            return redirect('Bienvenido');
        }else{
            // Falta vistas de errorss
            return 'Error email registrado';
        }
    }
    private function session_clients($database){
        $active = $database['active'] == '' ? 1 : $database['active'];
        session(['id_user'    => $database['id']]);
        session(['name'       => $database['name']])    ?? "";
        session(['photo'      => $database['photo']])   ?? "";
        session(['active'     => $active]);
        session(['uuid'       => $database['uuid']])    ?? "";
    }
    private function database_user(string $email){
       return  collect(DB::table('clients')->where('email',$email)->first());
    }
    public function site(Request $request){
        $data = $this->queryClients(['id' => session('id_user')])->first();
        if($data->name == "" OR $data->last_name == '' OR $data->photo == ''){
            return view('site.users.profile');
        }else{
            return view('site.index');
        }
    }
    private function queryClients($query){
        return DB::table('clients')->where($query);
    }
}
