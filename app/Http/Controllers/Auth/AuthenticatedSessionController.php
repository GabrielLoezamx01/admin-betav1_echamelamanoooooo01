<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthenticatedSessionController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user       = $this->databaseUser($googleUser);
        if (!$user) {
            $uuid =  Str::uuid();
            DB::table('clients')->insert([
                'photo'     => '',
                'email'     => $googleUser->email,
                'password'  => '',
                'google_id' => $googleUser->id,
                'uuid'      => '',
            ]);
            DB::table('google_login')->insert([
                'nickname'    => $googleUser->getNickname == null ? $googleUser->user['name'] : $googleUser->getNickname,
                'email'       => $googleUser->email,
                'avatar'      => $googleUser->avatar,
                'name'        => $googleUser->user['given_name'],
                'family_name' => $googleUser->user['family_name'],
                'google_id'   => $googleUser->id,
                'token'       => $googleUser->token,
                'expiresIn'   => $googleUser->expiresIn,
                'uuid'        => $uuid,
                'active'      => 1,
            ]);
        }
        $this->sessionUsers($this->databaseUser($googleUser));
        return redirect('Bienvenido');
        // Aquí puedes manejar la lógica para autenticar al usuario y redirigirlo a la página deseada
    }
    private function databaseUser($googleUser){
        return DB::table('clients')->where('google_id', $googleUser->id)->first();
    }
    private function sessionUsers($database){
        $database = collect($database)->toArray();
        $active   = $database['active'] == '' ? 1 :  $database['active'];
        session(['id_user'    => $database['id']]);
        session(['name'       => $database['name']])    ?? "";
        session(['photo'      => $database['photo']])   ?? "";
        session(['active'     => $active]);
        session(['uuid'       => $database['uuid']])    ?? "";
    }
}
