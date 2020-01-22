@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ 'Home/Incidencias/' }}{{$incidencias->id}}</div>

                <form action="/home/incidencias/{{$incidencias->id}}" method="post">
                    @csrf

                    <label>Nº Incidencia</label>
                    <input type="text" name="id" value="{{$incidencias->id}}" disabled> <br>

                    <label>Clase</label>
                    <select name="classroom" style="margin-left: 50px;">
                        @foreach($classrooms as $classroom)

                        @if($classroom != $incidencias->clase )
                        <option value="{{$classroom}}">{{$classroom}} </option>
                        @else
                        <option value="{{$classroom}}" selected>{{$classroom}} </option>
                        @endif
                        @endforeach
                    </select><br>

                    <label>Equipo</label>
                    <input type="text" name="equipo" style="margin-left: 40px;" value="{{$incidencias->equipo}}">
                    <br>
                    <label>Descripcion</label>
                    <select name="description" style="margin-left: 10px;">
                        @foreach($codIncidencias as $codIncidencia)
                        @if($codIncidencia == $incidencias->descripcion)
                            <option value="{{$codIncidencia}}" selected>{{$codIncidencia}}</option> 
                        @else
                            <option value="{{$codIncidencia}}">{{$codIncidencia}}</option> 
                            @endif
                        @endforeach
                   </select><br>
                    <label>Estado</label>
                    
                    <select name="state" style="margin-left: 40px;">
                        @foreach($estados as $estado)
                        @if($estado == $incidencias->estado)
                            @if($estado == $incidencias->estado)
                                <option value="{{$estado}}" selected>{{$estado}}</option> 
                            @else
                            <option value="{{$estado}}" selected>{{$estado}}</option> 
                            @endif
                        @else
                            <option value="{{$estado}}">{{$estado}}</option> 
                        @endif
                        @endforeach
                    </select><br>
                    <label>Comentarios</label><br>
                    <textarea name="comentario"  style="margin-left: 5px;"> {!!  \Session::get('input_comentario') !!}</textarea><br><br>
                    <button type="input" class="btn btn-primary">Enviar</button>
                    <button class="btn btn-danger"><a href="{{ url('/home/incidencias') }}"
                            style="height:10%; width:15%; color:white; text-decoration:none;">Cancelar
                        </a> </button>
                </form>
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