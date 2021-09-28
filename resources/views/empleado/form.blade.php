<h1>{{$modo}} empleado</h1>
@if(count($errors)>0)
  <div class="alert alert-danger" rote="alert">
  <ul>
   @foreach($errors->all() as $error)
    <li> {{ $error }} </li>
   @endforeach
   </ul>
   </div>
@endif
<div class="form-group">
<label for="Nombres">Nombres</label>
<input class="form-control" type="text" name="Nombre"
 value="{{ isset($empleado->nombre)?$empleado->nombre:old('Nombre') }}" id="Nombre">
</div>
<div class="form-group">
<label for="ApellidoPaterno">Apellidos Paterno</label>
<input class="form-control" type="text" name="ApellidoPaterno" id="ApellidoPaterno"
value="{{isset($empleado->ApellidoPaterno)?$empleado->ApellidoPaterno:old('ApellidoPaterno') }}">
</div>
<div class="form-group">
<label for="ApellidoMaterno">Apellidos Materno</label>
<input class="form-control" type="text" name="ApellidoMaterno" id="ApellidoMaterno"
value="{{ isset($empleado->ApellidoMaterno)?:old('ApellidoMaterno') }}">
</div>
<div class="form-group">
<label for="Correo">Correo</label>
<input class="form-control" type="text" name="Correo" id="Correo"
value="{{ isset($empleado->Correo)?$empleado->Correo:old('Correo') }}">
<br>
</div>
<div class="form-group">
<label for="Foto">Foto</label>
@if(isset($empleado->Foto))
  <img src="{{asset('storage').'/'.$empleado->Foto}}" width="100" att="" >
@endif
<input type="file" name="Foto" value="" id="Foto">
<br>
<div>
<input class="btn btn-success" type="submit" value="{{$modo}} datos">
<a class="btn btn-primary" href="{{ url('empleado/')}}"> Regresar </a>
