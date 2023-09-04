<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
class ClientsController extends Controller
{
    var $type_user = '';
    public function login(Request $request)
    {
        $validated   = $request->validate([
            'email'    => 'required',
            'password' => 'required',
        ]);
        $password    = $request->password;
        $email       = $request->email;
        $clienteData = $this->database_user($email, 'cliente_001');
        $database    = $clienteData->isNotEmpty() ? $clienteData : $this->database_user($email, 'vendedor_002');
        if ($database->isEmpty()) {
            $errors[] = 'No existe una cuenta con el correo proporcionado';
            return redirect('/')->withErrors($errors)->withInput($request->except('password'));
        }
        if (!Hash::check($password, $database['password'])) {
            $errors[] = 'Contraseña errónea';
        }
        if(isset($errors) && count($errors)){
            return redirect('/')->withErrors ($errors)->withInput($request->except('password'));
        }
        // Falta el codigo de verificacion
        // $this->sendMenssage($email);
        // $this->validateCode();

        $this->session_clients($database);
        return redirect('Bienvenido');
    }
    public function crear(Request $request)
    {
        $validated        = $request->validate([
            'email'       => 'required',
            'password'    => 'required',
            'confirm'     => 'required',
            'type_client' => ['required',Rule::in(['type_one', 'type_two'])]
        ]);
        if($request->password == $request->confirm){
            $email           = $request->email;
            $type_client     = $request->type_client ;
            $this->type_user = $type_client == 'type_two' ? 'C' : 'V';
            $type = [
                'type_two' => 'cliente_001',
                'type_one' => 'vendedor_002',
            ];
            $type_client    = $type[$request->type_client] ?? 000;
            return $type_client;
            if($type_client == 000){
                $errors[] = 'Ocurrio un problema interno';
                return redirect('crear_client')->withErrors($errors)->withInput($request->except('password'));
            }
            if ($type_client == 'vendedor_002') {
                if (!DB::table('seller')->where('email', $email)->exists()) {
                    $this->insertNewUser('seller', $request->all());
                } else {
                    $errors[] = 'Este correo electrónico ya está registrado. Por favor, inicia sesión.';
                    return redirect('/')->withErrors($errors)->withInput($request->except('password'));
                }
            } else if ($type_client == 'cliente_001') {
                if (!DB::table('clients')->where('email', $email)->exists()) {
                    $this->insertNewUser('clients', $request->all());
                } else {
                    $errors[] = 'Este correo electrónico ya está registrado. Por favor, inicia sesión.';
                    return redirect('/')->withErrors($errors)->withInput($request->except('password'));
                }
            }
            $database   = $this->database_user($request->email, $type_client);
            $this->session_clients($database);
            return redirect('Bienvenido');
        }
        $errors[] = 'Contraseña no son iguales';
        return redirect('crear_client')->withErrors($errors)->withInput($request->except('password'));

    }
    private function insertNewUser(string $table, array $request){
        try {
            DB::table($table)->insert([
                'email'    => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
            $id = $table == 'clients' ? 'C' : 'V';
            session(['type_user'  => $id]);
        } catch (Exception $e) {
            echo "Ha ocurrido una excepción: " . $e->getMessage();
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
        if ($data->name == "" or $data->last_name == '') {
            return view('site.users.profile');
        } else {
            if(session('type_user') == 'V'){
                $branch = DB::table('branch')->where('id_seller',session('uuid'))->get();
                return view('site.index')->with(compact('branch'));
            }
            if(session('type_user') == 'C'){
                $post = DB::table('post_branch')
                ->join('branch','branch.id_branch','=','post_branch.id_branch')
                ->orderBy('fecha', 'desc')->get();
                return view('site.index2')->with(compact('post'));
             }
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
            'nombre'    => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono'  => 'required|string',
            'direccion' => 'required|string|max:255',
            'postal'    => 'required|string|max:255',
            'estado'    => 'required|string|max:255',
            'ciudad'    => 'required|string|max:255',
            'userName'  => 'required|string|max:50|unique:clients',
            'foto'      => 'image|max:2048',
        ]);
        $postal        =  $request->postal;
        $estado        =  $request->estado;
        $ciudad        =  $request->ciudad;
        $userName      =  $request->userName;
        $nombre        =  $request->nombre;
        $apellidos     =  $request->apellidos;
        $direccion     =  $request->direccion;
        $telefono      =  $request->telefono;
        $nombreArchivo = 'defauld.jpg';
        $type_user     =  session('type_user');
        $table         =  $type_user  == 'V' ? 'seller' : 'clients';
        if(DB::table($table)->where('userName',$userName)->exists()){
            return back()->withErrors(['userName' => 'Usuario Registrados']);
        }
        if (isset($request->foto)) {
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $extension = $request->file('foto')->extension();
                $nombreArchivo = time() . '_' . uniqid() . '.' . $extension;
                $request->file('foto')->storeAs('public/fotos', $nombreArchivo);
            }
        }
        switch ($type_user) {
            case 'C':
                $this->type_user = 'C';
                if (isset($request->uuid)) {
                    DB::table('clients')->where('uuid', $request->uuid)->update([
                        'photo'       => $nombreArchivo,
                    ]);
                } else {
                  $save =  DB::table('clients')->where('id', session('id_user'))->update([
                        'name'        => $nombre,
                        'last_name'   => $apellidos,
                        'andress'     => $direccion,
                        'photo'       => $nombreArchivo,
                        'suscription' => 1,
                        'phone'       => $telefono,
                        'rang'        => 0,
                        'validate'    => 1,
                        'active'      => 1,
                        'id_category' => 1,
                        'postal'      => $postal,
                        'estado'      => $estado,
                        'ciudad'      => $ciudad,
                        'uuid'        => Str::uuid(),
                        'userName'    => $userName,
                        'online'      => 1
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
                    DB::table('seller')->where('id', session('id_user'))->update([
                        'name'        => $nombre,
                        'last_name'   => $apellidos,
                        'andress'     => $direccion,
                        'photo'       => $nombreArchivo,
                        'suscription' => 1,
                        'phone'       => $telefono,
                        'validate'    => 1,
                        'active'      => 1,
                        'category'    => 0,
                        'postal'      => $postal,
                        'estado'      => $estado,
                        'ciudad'      => $ciudad,
                        'uuid'        =>   Str::uuid(),
                        'userName'    => $userName,
                    ]);
                }
                break;
            default:
                return back()->withErrors(['userName' => 'Ocurrio un error Interno en el sistema 00000x1_01']);
        }
        $database = collect($this->queryClients(['id' => session('id_user')])->first());
        $this->session_clients($database);
        return isset($request->uuid) ? redirect('profile') : redirect('Bienvenido');
    }
    public function close_sessions()
    {
        $database = DB::table('clients')->where('uuid', session('uuid'))->count();
        if($database){
            DB::table('clients')->where('uuid', session('uuid'))->update([
                'online' => 2
            ]);
        }
        Session::flush();
        return redirect('Bienvenido');
    }
}
