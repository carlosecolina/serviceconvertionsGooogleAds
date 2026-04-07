<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {
        $role = Auth::user()->roles->pluck('name');
        if ($request->query('ref')) {
            $ref = $request->query('ref');
            return redirect()->intended($ref);
        }
        if ($request->wantsJson()) {
            return response()->json(['two_factor' => false]);
        }

        switch ($role[0]) {
            case 'Admin':
                return redirect()->intended(config('fortify.home'));
            case 'Customer':
                return redirect()->intended(config('fortify.home_public'));
            default:
                return redirect()->route('index');
        }
    }
}
