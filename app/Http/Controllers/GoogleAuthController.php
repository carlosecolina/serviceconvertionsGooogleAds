<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
  //
  public function redirect()
  {

    $state = 'google_ads';
    return  Socialite::driver('google')
      ->stateless()
      ->scopes([
        'https://www.googleapis.com/auth/adwords'
      ])
      ->with([
        'access_type' => 'offline',
        'prompt' => 'consent',
        'state' => $state,
      ])
      ->redirect();
  }

  public function callback(Request $request)
  {



    if ($request->state === 'google_ads') {

      $googleUser = Socialite::driver('google')
        ->stateless()
        ->with([
          'access_type' => 'offline',
          'prompt' => 'consent',
        ])
        ->user();

      $admin = auth()->user();

      $admin->update([
        'google_id' => $googleUser->id,
        'google_refresh_token' => $googleUser->refreshToken,
        'google_access_token' => $googleUser->token,
        'google_token_expires_at' => now()->addSeconds($googleUser->expiresIn),
        'external_auth' => 'google_ads',
      ]);
      $redirectUrl = url('/admin/dashboard');

      return response("
            <script>
                if (window.opener) {
                    // Redirige la ventana que está atrás
                    window.opener.location.href = '$redirectUrl';
                    // Cierra esta ventana actual
                    window.close();
                } else {
                    // Si por alguna razón no hay ventana padre, redirige aquí mismo
                    window.location.href = '$redirectUrl';
                }
            </script>
        ");
    } else {
      $user = Socialite::driver('google')->user();
      $userExist = User::where('external_id', $user->id)->where('external_auth', 'google')->first();

      if ($userExist) {
        Auth::login($userExist);

        return redirect()->route('index');
      } else {
        if (User::where('email', $user->email)->exists()) {
          $userExist = User::where('email', $user->email)->first();
          $userExist->external_id = $user->id;
          $userExist->external_auth = 'google';
          $userExist->save();
          Auth::login($userExist);
        } else {
          $userNew = User::create([
            'name' => $user->user['given_name'],
            'lastname' => $user->user['family_name'] ?? '',
            'email' => $user->email,
            'external_id' => $user->id,
            'external_auth' => 'google',
            'avatar' => $user->avatar

          ])->assignRole('Customer');
          Auth::login($userNew);
        }

        return redirect()->route('index');
      }
    }
  }
}
