<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class ClientsController extends Controller
{
    public function login(Request $request)
    {
        $validated  = $request->validate([
            'email'    => 'required',
            'password' => 'required',
        ]);
        $database   = $this->database_user($request->email);
        if (isset($database['id'])) {
            if (Hash::check($request->password, $database['password'])) {
                $this->session_clients($database);
                return redirect('Bienvenido');
            }
        }
        return redirect('login_client');
    }
    public function crear(Request $request)
    {
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
        } else {
            // Falta vistas de errorss
            return 'Error email registrado';
        }
    }
    private function session_clients($database)
    {
        $active = $database['active'] == '' ? 1 :  $database['active'];
        session(['id_user'    => $database['id']]);
        session(['name'       => $database['name']])    ?? "";
        session(['photo'      => $database['photo']])   ?? "";
        session(['active'     => $active]);
        session(['uuid'       => $database['uuid']])    ?? "";
    }
    private function database_user(string $email)
    {
        return  collect(DB::table('clients')->where('email', $email)->first());
    }
    public function site(Request $request)
    {
        $data = $this->queryClients(['id' => session('id_user')])->first();
        if ($data->name == "" or $data->last_name == '' or $data->photo == '') {
            return view('site.users.profile');
        } else {
            return view('site.index');
        }
    }
    private function queryClients($query)
    {
        return DB::table('clients')->where($query);
    }
    public function data_clients(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto'      => 'nullable|image|max:2048', // Tamaño máximo de 2 MB
        ]);
        if (isset($request->foto)) {
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $extension = $request->file('foto')->extension();
                $nombreArchivo = time() . '_' . uniqid() . '.' . $extension;
                $request->file('foto')->storeAs('public/fotos', $nombreArchivo);
            } else {
                $nombreArchivo = null;
            }
        } else {
            return Redirect('Bienvenido');
        }
        if ($request->uuid) {
            DB::table('clients')->where('uuid', $request->uuid)->update([
                'photo'       => $nombreArchivo,
            ]);
        } {
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string|max:255',
                'apellidos' => 'required|string|max:255',
                'telefono' => 'required|string',
                //     'correo' => 'required|string|email|max:255',
                'direccion' => 'required|string|max:255',
                'postal'    => 'required|string|max:255',
                'estado'    => 'required|string|max:255',
                'ciudad'    => 'required|string|max:255',
                'foto'      => 'nullable|image|max:2048', // Tamaño máximo de 2 MB
            ]);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            DB::table('clients')->where('id', session('id_user'))->update([
                'name'        => $request->input('nombre'),
                'last_name'   => $request->input('apellidos'),
                //   'email'       => $request->input('correo'),
                'andress'     => $request->input('direccion'),
                'photo'       => $nombreArchivo,
                'suscription' => 1,
                'phone'       => $request->input('telefono'),
                'rang'        => 0,
                'validate'    => 1,
                'active'      => 1,
                'id_category' => 1,
                'postal'      => $request->postal,
                'estado'      => $request->estado,
                'ciudad'      => $request->ciudad,
                'uuid'        =>   Str::uuid()
            ]);
        }
        $database = collect($this->queryClients(['id' => session('id_user')])->first());
        $this->session_clients($database);
        return isset($request->uuid) ? redirect('profile') : redirect('Bienvenido');
    }
    public function close_sessions()
    {
        Session::flush();
        return redirect('Bienvenido');
    }
}
