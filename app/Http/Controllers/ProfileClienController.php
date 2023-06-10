<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Clientuser;

class ProfileClienController extends Controller
{
    public function index (){
        $user = Clientuser::where('uuid',session('uuid'))->limit(1)->get();
        return view('site.users.user')->with(compact('user'));
    }
}
