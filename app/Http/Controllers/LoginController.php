<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\Count;

class LoginController extends Controller
{
    public function login (Request $request){
        $validated = $request->validate([
            'email' => 'required',
            'pass' => 'required',
        ]);
        $validate_sign_in = $this->validate_email($request->email, $request->pass);
        if($validate_sign_in){
           return redirect('page');
        }
        $errors = [
            'message'   => 'Usuario o contraseña incorrectos',
            'email'     => $request->email
        ];
        return view('login')->with('data',$errors);
    }
    private function validate_email(string $email,string $password){
        $database  = User::where('email',$email)->first();
        $validated = isset($database->email) ? $this->validate_password($database ,$password) : false;
        // Falta doble verifiacion mediante MSM a su numero telefonico o correo...
        if($validated){
            session(['email_user' => $database->email]);
            session(['id_user'    => $database->id]);
            session(['name'       => $database->name]);
            return true;
        }
        return false;
    }
    private function validate_password($database,$password){
        if (Hash::check($password, $database->password)) {
            return true;
        }
        return false;
    }
}
