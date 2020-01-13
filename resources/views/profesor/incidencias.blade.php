<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ URL::asset('js/incidencias.js')}}"></script>

@extends('layouts.app')
<div style="position: fixed; bottom: 75%; right:1%; z-index:100;">
    <a href="{{ url('/home/incidencias/crear') }}">
        <div style="background-color:#2FA360; border-radius: 10px;">
            <svg id="i-compose" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32" height="32"
                fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <path d="M27 15 L27 30 2 30 2 5 17 5 M30 6 L26 2 9 19 7 25 13 23 Z M22 6 L26 10 Z M9 19 L13 23 Z" />
            </svg>
        </div>

    </a>
</div>
@section('content')

<div class="container">


    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ 'Home/Incidencias' }}</div>

                {{-- TABLA DE INCIDENCIAS --}}
                <table class="table table-bordered">
                    <thead>
                        <th scope="col">Nº</th>
                        <th scope="col">Aula</th>
                        <th scope="col">Equipo</th>
                        <th colspan="2">Descripción</th>
                        <th scope="col">Estado</th>
                    </thead>
                    <tbody>
                        {{-- REQUEST DE INCIDENCIAS --}}

                        @foreach($incidencias as $incidencia)

                        <tr>
                            <td>
                                <div>
                                    <p>{{$incidencia ->id}}</p>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <p>{{$incidencia ->clase}}</p>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <p>{{$incidencia ->equipo}}</p>
                                </div>
                            </td>
                            <td colspan="2">
                                <div>
                                    <p>{{$incidencia ->descripcion}}</p>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <p>{{$incidencia ->estado}}</p>
                                </div>
                            </td>

                            {{-- botones en el lado derecho --}}

                            <td colspan="3">
                                <button onclick="ver(id)" type="input" class="btn btn-primary"
                                    id="{{$incidencia ->id}}">
                                    <svg id="i-info" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="14"
                                        height="14" fill="none" stroke="currentcolor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2">
                                        <path d="M16 14 L16 23 M16 8 L16 10" />
                                        <circle cx="16" cy="16" r="14" />
                                    </svg>
                                </button>
                                <button onclick="editar(id)" type="input" class="btn btn-secondary"
                                    id="{{$incidencia ->id}}">
                                    <svg id="i-edit" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="14"
                                        height="14" fill="none" stroke="currentcolor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2">
                                        <path d="M30 7 L25 2 5 22 3 29 10 27 Z M21 6 L26 11 Z M5 22 L10 27 Z" />
                                    </svg>
                                </button>
                                <button onclick="eliminar(id)" type="input" class="btn btn-danger"
                                    id="{{$incidencia ->id}}"><svg id="i-trash" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 32 32" width="14" height="14" fill="none" stroke="currentcolor"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                        <path
                                            d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="float: right;"><a href="{{ url('/home/incidencias/crear') }}"
                        style="margin: 20px; width:100px; float: right; " class="btn btn-lg btn-success btn-block">Crear
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection