<h2 class="text-center text-uppercase">
    {{ $Modo == 'crear'? 'Agregar Contacto':'Modificar Contacto'}}
</h2>


<div class="form-group">
    <label for="Nombre" class="control-label">{{'Nombre*'}}</label>
    <input type="text" class="form-control {{ $errors->has('Nombre')?'is-invalid':'' }} " name="Nombre" id="Nombre" value=" {{ isset($contacto->Nombre)?$contacto->Nombre:old('Nombre') }} ">
    {!! $errors->first('Nombre','
    <div class="invalid-feedback">
        Por favor ingresa un nombre.
    </div>
    ')!!}
</div>
<div class="form-group">
    <label for="Apellido" class="control-label">{{'Apellido'}}</label>
    <input type="text" class="form-control" name="Apellido" id="Apellido" value=" {{ isset($contacto->Apellido)?$contacto->Apellido:old('Apellido') }} ">
</div>
<div class="form-group">
    <label for="Celular" class="control-label">{{'Celular*'}}</label>
    <input type="number" class="form-control {{ $errors->has('Celular')?'is-invalid':'' }}" name="Celular" id="Celular" value={{ isset($contacto->Celular)?$contacto->Celular:old('Celular') }}>
    {!! $errors->first('Celular','
    <div class="invalid-feedback">
        Por favor ingresa un Celular.
    </div>
    ')!!}
</div>
<div class="form-group">
    <label for="Correo" class="control-label">{{'Correo*'}}</label>
    <input type="email" class="form-control {{ $errors->has('Correo')?'is-invalid':'' }}" name="Correo" id="Correo" value=" {{ isset($contacto->Correo)?$contacto->Correo:old('Correo') }} ">
    {!! $errors->first('Correo','
    <div class="invalid-feedback">
        Por favor ingresa un Correo.
    </div>
    ')!!}
</div>
<div class="form-group">
    <label for="Foto" class="control-label">{{'Foto*'}}</label>
    @if(isset($contacto->Foto))
    <br />
    <img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$contacto->Foto }} " width="100">
    <br />
    @endif
    <input type="file" class="form-control-file {{ $errors->has('Foto')?'is-invalid':'' }}" name="Foto" id="Foto" value="">
    {!! $errors->first('Foto','
    <div class="invalid-feedback">
        Por favor agrega una Foto valida.
    </div>
    ')!!}
</div>
<div class="form-group">
    <label for="Comentario" class="control-label">{{'Comentario'}}</label>
    <input type="text" class="form-control " name="Comentario" id="Comentario" value=" {{ isset($contacto->Comentario)?$contacto->Comentario:old('Comentario') }} ">
</div>
<div class="form-group">
    <label for="Edad" class="control-label">{{'Edad*'}}</label>
    <input type="number" class="form-control {{ $errors->has('Edad')?'is-invalid':'' }}" name="Edad" id="Edad" value={{ isset($contacto->Edad)?$contacto->Edad:old('Edad') }}>
    {!! $errors->first('Edad','
    <div class="invalid-feedback">
        Por favor ingresa una Edad valida.
    </div>
    ')!!}
</div>
<div class="form-group">
    <label for="Genero" class="control-label">{{'Genero'}}</label>
    <select class="form-control" id="Genero" name="Genero">
        <option value="Masculino" {{ isset($contacto->Edad)?($contacto->Genero == 'Masculino') ? "selected" : "":'' }}>{{'Masculino'}}</option>
        <option value="Femenino" {{ isset($contacto->Edad)?($contacto->Genero == 'Femenino') ? "selected" : "":'' }}>{{'Femenino'}}</option>
    </select>
</div>
<div class="form-group">
    <input type="submit" class="btn btn-success" value="{{ $Modo == 'crear'? 'Agregar Contacto' : 'Modificar Contacto' }}">
    <a href=" {{ url('/') }} " class="btn btn-primary">Regresar</a>
</div>