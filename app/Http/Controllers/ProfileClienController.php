<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Clientuser;
use Illuminate\Support\Facades\DB;
class ProfileClienController extends Controller
{
    public function index()
    {
        if (empty(session('name'))) {
            return redirect('Bienvenido');
        }
        if (session()->has('type_user') && session()->has('uuid')) {
            $table    = session('type_user') == 'C' ? 'clients' : 'seller';
            $query    = DB::table($table)->where('uuid', session('uuid'))->first();
            $database = collect($query);
            if($database->isEmpty()){
                return redirect('Bienvenido');
            }
            return view('site.users.user')->with(compact('query'));
        }
        return redirect('Bienvenido');
    }

    public function store (Request $request){
        return $request->all();
    }

}
