<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Incidencia;
use App\Professor;
use Validator;
use Mail;
use Gate;

class IncidenciasController extends Controller
{
    var $classrooms = ['102', '103', '104', '105', '201', '202', '203', '204', '205'];
    var $codIncidencia =[
        "No se enciende la CPU/ CPU ez da pizten",
        "No se enciende la pantalla/Pantaila ez da pizten",
        "No entra en mi sesión/ ezin sartu nere erabiltzailearekin",
        "No navega en Internet/ Internet ez dabil",
        "No se oye el sonido/ Ez da aditzen",
        "No lee el DVD/CD",
        "Teclado roto/ Tekladu hondatuta",
        "No funciona el ratón/Xagua ez dabil",
        "Muy lento para entrar en la sesión/oso motel dijoa",
        "Otros(Especifica en el comentario)",
    ];

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
    public function incidencias()
    {
        // cogemos id de la base de datos del user autentificado (esto se coge del dato del guarda por defecto)
        $useradmin = Auth::user()->admin;
        // si hay valor se pasa a la pagina sino no
        $incidencias = DB::table('incidencias')->where('activo', '=', true)->get();
        if ($useradmin) {
            // datos de las incidencias
            return view('admin.incidencias', ['incidencias' => $incidencias]);
        } else {
            // cogemos las incidencias activas del profesor logeado
            $incidenciasProfesor = [
                'id_profesor' => Auth::user()->id,
                'activo' => true,
            ];
            $incidencias = DB::table('incidencias')->where($incidenciasProfesor)->get();
            return view('profesor.incidencias',  ['incidencias' => $incidencias]);
        }
    }

    public function form()
    {

        // cogemos id de la base de datos del user autentificado (esto se coge del dato del guarda por defecto)
        $useradmin = Auth::user()->admin;
        // si hay valor se pasa a la pagina sino no
        if ($useradmin) {
            return view('admin.incidenciasForm', ['classrooms' => $this->classrooms, 'codIncidencias' => $this->codIncidencia]);
        } else {
            return view('profesor.incidenciasForm', ['classrooms' => $this->classrooms, 'codIncidencias' => $this->codIncidencia]);
        }
    }

    public function verIncidencia($id)
    {
        $incidencias = Incidencia::whereId($id)->first();
        $nombreProfesor = Professor::whereId( $incidencias->id_profesor)->first();
        Gate::define('view-post', function ($nombreProfesor , $incidencias) {
            return $nombreProfesor ->id === $incidencias->id_profesor;
        });

        if (Gate::allows('view-post', $incidencias)) {
            $nombreProfesor = $nombreProfesor->name;
            $useradmin = Auth::user()->admin;
            //si hay valor se pasa a la pagina sino no
    
            if ($useradmin) {
                return view('admin.incidenciasVer', ['incidencias' => $incidencias, 'nombreProfesor' => $nombreProfesor ]);
            } else {
                return view('profesor.incidenciasVer', ['incidencias' => $incidencias, 'nombreProfesor' => $nombreProfesor]);
            }
        }else{
            return redirect("/home/incidencias");
        }
        
    }

    public function crearIncidencia(Request $request)
    {
        // data validation
        $rules = [
            'classroom' => 'required',
            'description' => 'required',
            'equipo' => ['required', 'regex:/^HZ[1-9]{6}$/'],
            'state' => 'required',
        ];
        $customMessages = [
            'description.required' => 'Pon una descripcion minima de 10 caracteres.',
            'nombre.min' => 'El nombre no cumple.',
            'equipo.required' => 'El equipo tiene que ser HZ y 6 números',
            'equipo.regex' => 'El equipo tiene que ser HZ y 6 números',
            'state.required' => 'Pon el estado.',
        ];

        $inputsValue = [
            'input_description' =>  $request->description,
            'input_equipo' =>  $request->equipo,
            'input_comentario' =>  $request->comentario,
        ];

        // $this->validate($request, $rules, $customMessages);
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with($inputsValue);
                
        }else{

            $userid = Auth::user()->id;
            /*Como meter datos*/
            $Incidencia = new Incidencia;
            $Incidencia->equipo = $request->equipo;
            $Incidencia->descripcion = $request->description;
            $Incidencia->clase = $request->classroom;
            $Incidencia->estado = $request->state;
            $Incidencia->comentario = $request->comentario;
            $Incidencia->id_profesor = $userid;
            // enviar correo al administrador
            // $email = DB::table('professors')->where('admin', true)->first();
            // Mail::to( $email->email)->send(new IncidenciaCreada($Incidencia));
            $Incidencia->save();

            return redirect("/home/incidencias");
        }
       
    }

    public function eliminarIncidencia(Request $request)
    {
        DB::table('incidencias')->where('id', '=', $request->id)->update(['activo' => false]);
        // como borrar filas
        // DB::table('incidencias')->where('id', '=', $request ->id)->delete();
    }

    public function editarIncidencia($id)
    {
        $incidencias = Incidencia::whereId($id)->first();
        $useradmin = Auth::user()->admin;
        // si hay valor se pasa a la pagina sino no
        if ($useradmin) {
            return view('admin.incidenciasEditar', ['incidencias' => $incidencias, 
            'classrooms' => $this->classrooms,
             'codIncidencias' => $this->codIncidencia]);
        } else {
            return view('profesor.incidenciasEditar', ['incidencias' => $incidencias,
             'classrooms' => $this->classrooms,
              'codIncidencias' => $this->codIncidencia]);
        }
    }

    public function updateIncidencia(Request $request)
    {
          // data validation
          $rules = [
            'classroom' => 'required',
            'description' => 'required|min:10',
            'equipo' => ['required', 'regex:/^HZ[1-9]{6}$/'],
            'state' => 'required',
        ];
        $customMessages = [
            'description.required' => 'Pon una descripcion minima de 10 caracteres.',
            'nombre.min' => 'El nombre no cumple.',
            'equipo.required' => 'El equipo tiene que ser HZ y 6 números',
            'equipo.regex' => 'El equipo tiene que ser HZ y 6 números',
            'state.required' => 'Pon el estado.',
        ];

        $inputsValue = [
            'input_description' =>  $request->description,
            'input_equipo' =>  $request->equipo,
            'input_comentario' =>  $request->comentario,
        ];

        // $this->validate($request, $rules, $customMessages);
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->with($inputsValue); 
        }else{
        DB::table('incidencias')->where('id', '=', $request->id)->update([
            'clase' => $request->classroom,
            'equipo' => $request->equipo,
            'descripcion' => $request->description,
            'estado' => $request->state,
            'comentario' => $request->comentario,
        ]);
        return redirect("/home/incidencias");
        }
        
    }
}
