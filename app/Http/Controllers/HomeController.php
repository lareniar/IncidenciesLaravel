<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //cogemos id de la base de datos del user autentificado (esto se coge del dato del guarda por defecto)
           $useradmin = Auth::user()->admin;

           //si hay valor se pasa a la pagina sino no
           if ($useradmin) {
            return view('admin.home');
        }else{
            return view('profesor.home');
        }
    }
}
