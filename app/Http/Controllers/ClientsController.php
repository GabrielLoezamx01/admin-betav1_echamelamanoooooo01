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
    var $type_user = '';
    public function login(Request $request)
    {
        $validated  = $request->validate([
            'email'    => 'required',
            'password' => 'required',
        ]);
        $database   = count($this->database_user($request->email, 'cliente_001')) > 0 ?
            $this->database_user($request->email, 'cliente_001') : $this->database_user($request->email, 'vendedor_002');

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
        if (isset($request->type_client)) {
            if ($request->type_client == 'type_two') {
                $this->type_user == 'C';
            }
            if ($request->type_client == 'type_one') {
                $this->type_user == 'V';
            }
        }
        $validated  = $request->validate([
            'email'    => 'required',
            'password' => 'required',
            'type_client' => 'required'
        ]);
        $type = [
            'type_two' => 'cliente_001',
            'type_one' => 'vendedor_002',
        ];
        $type_client = $type[$request->type_client] ?? 000;
        if ($type_client == 'vendedor_002') {
            if (!DB::table('seller')->where('email', $request->email)->exists()) {
                session(['type_user'  => 'V']);
                DB::table('seller')->insert([
                    'email'    => $request->email,
                    'password' => Hash::make($request->password),
                ]);
            } else {
                return 'Error email registrado';
            }
        } else if ($type_client == 'cliente_001') {
            if (!DB::table('clients')->where('email', $request->email)->exists()) {
                session(['type_user'  => 'C']);
                DB::table('clients')->insert([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
            } else {
                return 'Error email registrado';
            }
        }
        $database   = $this->database_user($request->email, $type_client);
        $this->session_clients($database);
        return redirect('Bienvenido');
    }
    private function session_clients($database)
    {
        $active = $database['active'] == '' ? 1 :  $database['active'];
        session(['id_user'    => $database['id']]);
        session(['name'       => $database['name']])    ?? "";
        session(['photo'      => $database['photo']])   ?? "";
        session(['active'     => $active]);
        session(['uuid'       => $database['uuid']])    ?? "";
        session(['type_user'  => $this->type_user]);
    }
    private function database_user(string $email, string $type)
    {
        if ($type == 'vendedor_002') {
            $this->type_user = 'V';
            return  collect(DB::table('seller')->where('email', $email)->first());
        } else if ($type == 'cliente_001') {
            $this->type_user = 'C';
            return  collect(DB::table('clients')->where('email', $email)->first());
        }
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
        if (session('type_user') == 'V') {
            return DB::table('seller')->where($query);
        }
        if (session('type_user') == 'C') {
            return DB::table('clients')->where($query);
        }
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

        switch (session('type_user')) {
            case 'C':
                $this->type_user = 'C';
                if (isset($request->uuid)) {
                    DB::table('clients')->where('uuid', $request->uuid)->update([
                        'photo'       => $nombreArchivo,
                    ]);
                } else {
                    $validator = Validator::make($request->all(), [
                        'nombre' => 'required|string|max:255',
                        'apellidos' => 'required|string|max:255',
                        'telefono' => 'required|string',
                        'direccion' => 'required|string|max:255',
                        'postal'    => 'required|string|max:255',
                        'estado'    => 'required|string|max:255',
                        'ciudad'    => 'required|string|max:255',
                        'foto'      => 'nullable|image|max:9000',
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
                break;
            case 'V':
                $this->type_user = 'V';
                if (isset($request->uuid)) {
                    DB::table('seller')->where('uuid', $request->uuid)->update([
                        'photo'       => $nombreArchivo,
                    ]);
                } else {
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
                    DB::table('seller')->where('id', session('id_user'))->update([
                        'name'        => $request->input('nombre'),
                        'last_name'   => $request->input('apellidos'),
                        //   'email'       => $request->input('correo'),
                        'andress'     => $request->input('direccion'),
                        'photo'       => $nombreArchivo,
                        'suscription' => 1,
                        'phone'       => $request->input('telefono'),
                        'validate'    => 1,
                        'active'      => 1,
                        'category'    => 0,
                        'postal'      => $request->postal,
                        'estado'      => $request->estado,
                        'ciudad'      => $request->ciudad,
                        'uuid'        =>   Str::uuid()
                    ]);
                }
                break;
            default:
                return 'Ocurrio un error Interno en el sistema 00000x1_01';
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
