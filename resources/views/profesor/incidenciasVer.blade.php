<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ URL::asset('js/incidencias.js')}}"></script>

@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                     
                <div class="card-header">
                {{ 'Home/Incidencias/Ver' }}</div>

                    {{-- TABLA DE INCIDENCIAS --}}
                    <table class="table table-bordered">
                        <thead>
                                <th scope="col">Nº</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Aula</th>
                                <th scope="col">Equipo</th>
                                <th colspan="2">Descripción</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Creador</th>
                                <th scope="col">Comentarios</th>

                        </thead>
                        <tbody>
                            {{-- fecha,código,aula,descripciónysuestado --}}
                            <tr>
                            <td><div><p>{{$incidencias ->id}}</p></div></td>
                            {{-- <td><div><p>{{ date ('F d, Y', strtotime($incidencias ->created_at)) }}</p></div></td> --}}
                            <td><div><p>{{ $incidencias ->created_at }}</p></div></td>
                            <td><div><p>{{$incidencias ->clase}}</p></div></td>
                            <td> <div><p>{{$incidencias ->equipo}}</p></div></td>
                            <td colspan="2"><div><p>{{$incidencias ->descripcion}}</p></div></td>
                            <td><div><p>{{$incidencias ->estado}}</p></div></td>
                            
                            <td> <div><p>{{$nombreProfesor}}</p></div></td>
                            <td> <div><p>{{$incidencias ->comentario}}</p></div></td>
                    </tbody>
                    </table>
                   <a href="{{ url('/home/incidencias') }}" style="margin: 20px; width:15%;" class="btn btn-lg btn-primary btn-block">Volver
</a> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
