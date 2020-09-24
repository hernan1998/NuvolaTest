@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <form action="{{ url ('/Contactos')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}

                @include('Contactos.form',['Modo'=>'crear'])

            </form>
        </div>
    </div>
</div>

@endsection