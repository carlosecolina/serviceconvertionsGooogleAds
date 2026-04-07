<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        $idUsuario = auth()->user()['id']; 

        $role = DB::select('SELECT roles.name  FROM  model_has_roles  INNER JOIN roles ON model_has_roles.role_id = roles.id  INNER JOIN users ON model_has_roles.model_id = users.id  WHERE users.id =  ?', [$idUsuario]);
        
        if ( count($role) == 0 ) {
            return redirect()->route('index'); // Cambia 'login' al nombre de la ruta de tu página de inicio de sesión
        }

        return $next($request);
    }
}
