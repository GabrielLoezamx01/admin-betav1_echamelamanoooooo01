<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;
class RegisteredUserController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        $create     = DB::table('google_login')->insert([
            'nickname'    => $googleUser->getNickname == null ? $googleUser->user['name'] : $googleUser->getNickname,
            'email'       => $googleUser->email,
            'avatar'      => $googleUser->avatar,
            'name'        => $googleUser->user['given_name'],
            'family_name' => $googleUser->user['family_name'],
            'google_id'   => $googleUser->id,
            'token'       => $googleUser->token,
            'expiresIn'   => $googleUser->expiresIn,
            'uuid'        => $googleUser->id,
            'active'      => 1,
        ]);
        $clientes = DB::table('clients')->insert([
            'email'     => $googleUser->email,
            'password'  => '',
            'google_id' => $googleUser->id,
            'uuid'      => '',
        ]);
        $this->sessionUsers($this->databaseUser($googleUser));
        return redirect('Bienvenido');
    }
    private function databaseUser($googleUser){
        return DB::table('google_login')->where('google_id', $googleUser->id)->first();
    }
    private function sessionUsers($database){
        $database = collect($database)->toArray();
        $active   = $database['active'] == '' ? 1 :  $database['active'];
        session(['id_user'    => $database['id']]);
        session(['name'       => $database['name']])    ?? "";
        session(['photo'      => $database['avatar']])   ?? "";
        session(['active'     => $active]);
        session(['uuid'       => $database['uuid']])    ?? "";
    }
}
