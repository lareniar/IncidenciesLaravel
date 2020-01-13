@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                        {{ 'Home/Incidencias/Crear' }}</div>

                <form action="/home/incidencias/crear" method="post">
                    @csrf 
                    <label>Clase</label>
                    <select name="classroom" style="margin-left: 85px;">
                        @foreach($classrooms as $classrom)
                            <option value="{{$classrom}}">{{$classrom}}</option> 
                        @endforeach
                   </select>
                   <br>

                   <div style="col-xs-8 col-sm-8 col-md-8 col-xl-8">
                    <div class="form-group">
                        <label>Nombre del equipo</label>
                    
                        <input type="text" name="equipo" style="width:50%;" placeholder="HZxxxxxx" value="{!!  \Session::get('input_equipo') !!}" autofocus>
                    </div>
                </div>
                    <br>
                    <div style="col-xs-8 col-sm-8 col-md-8 col-xl-8">
                        <div class="form-group">
                    <label>Descripcion</label>
                    <select name="description" style="margin-left: 45px;">
                        @foreach($codIncidencias as $codIncidencia)
                            <option value="{{$codIncidencia}}">{{$codIncidencia}}</option> 
                        @endforeach
                   </select>
              </div>
            </div>
                <br>
                    <label>Estado</label>
                    <select name="state" style="margin-left: 75px;">
                            <option value="Sin Resolver" selected>Sin Resolver</option> 
                            <option value="En Espera">En Espera</option> 
                            <option value="Resuelto">Resuelto</option> 
                   </select><br>       <br>
                   <label>Comentarios</label>
                   <br>
                   <textarea name="comentario"  style="margin-left: 120px;" value="{!!  \Session::get('input_comentario') !!}"> </textarea><br><br>
                   <button type="input" class="btn btn-primary">Enviar</button>
                   <button class="btn btn-danger"><a href="{{ url('/home/incidencias') }}" style="color:white; text-decoration:none;" >Cancelar
                   </a> </button>
                </form>
                <br>

                @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-dark" role="alert">
                        <li>{{ $error }}</li> 
                    </div>
                    @endforeach
                </ul>
        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
