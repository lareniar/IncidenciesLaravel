@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ 'Home' }}</div>

                <div class="card-body">
 <a href="{{ url('/home/incidencias') }}" style="margin-top: 20px;" class="btn btn-lg btn-success btn-block">CONSULTAS
</a> 
<a href="{{ url('/home/incidencias') }}" style="margin-top: 20px;" class="btn btn-lg btn-success btn-block">INCIDENCIAS
</a> 
<a href="{{ url('/home/incidencias') }}" style="margin-top: 20px;" class="btn btn-lg btn-success btn-block">BOLETIN
</a> 

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

