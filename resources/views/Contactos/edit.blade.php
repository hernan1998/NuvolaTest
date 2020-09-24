@extends('layouts.app')

@section('content')


<div class="container">
    <div class="card">
        <div class="card-body">
            <form action="{{ url('/Contactos/'.$contacto->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                @include('Contactos.form',['Modo'=>'editar'])

            </form>
        </div>
    </div>
</div>

@endsection