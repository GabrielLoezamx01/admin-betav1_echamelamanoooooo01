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
        return 'papu';
        if(session('name') == ''){
            return redirect('Bienvenido');
        }
        switch (session('type_user')) {
            case 'C':
                $user = Clientuser::where('uuid', session('uuid'))->limit(1)->get();
                break;
            case 'V':
                $user = DB::table('seller')->where('uuid', session('uuid'))->limit(1)->get();
                break;
            default:
                $user = Clientuser::where('uuid', session('uuid'))->limit(1)->get();
                break;
        }
        return view('site.users.user')->with(compact('user'));
    }
}
