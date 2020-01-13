<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use DB;
class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //cogemos id de la base de datos del user autentificado (esto se coge del dato del guarda por defecto)
        $useradmin = Auth::user()->admin;
        //si hay valor se pasa a la pagina sino no
        if ($useradmin) {
            return $next($request);
        }
    return redirect('/home');
    }
}
