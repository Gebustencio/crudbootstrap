@extends('layouts.app')
@section('content')
<div class="container">

@if(Session::has('mensaje'))
 {<div class="alert alert-success alert-dismissible" rote="alert">
   { Session::get('mensaje')}
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">&times;</span>
  </button>
</div>
   }
@endif

<a href="{{ url('empleado/create')}}" class="btn btn-success"> Registrar Nuevo Empleado </a>
<br>
<table class="table table-light">
  <thead>
   <tr>
    <th>Nro</th>
    <th>Foto</th>
    <th>Nombre</th>
    <th>Apellido Paterno</th>
    <th>Apellido Materno</th>
    <th>Correo</th>
    <th>Aciones</th>
   </tr>
  </thead>
  <tbody>
   @foreach($empleados  as $empleado)
      <tr>
        <td>{{ $empleado->id }}</td>
        <td>
        <img src="{{ asset('storage').'/'.$empleado->Foto}}" width="100" att="">
        </td>

        <td>{{ $empleado->nombre }}</td>
        <td>{{ $empleado->ApellidoPaterno }}</td>
        <td>{{ $empleado->ApellidoMaterno }}</td>
        <td>{{ $empleado->Correo }}</td>
        <td>
        <a href="{{url('/empleado/'.$empleado->id.'/edit')}}" class="btn btn-warning">
          Editar
        </a>
        |
         <form action="{{ url('/empleado/'.$empleado->id )}}" method="post" class="d-inline">
         @csrf
         {{method_field('DELETE')}}
         <input class="btn btn-danger" type="submit"onclick="return confirm('Quieres Borrar?')" value="Borrar">
         </form>
         </td>
      </tr>
    @endforeach
  </tbody>
</table>
{!!$empleados->links()!!}
</div>
@endsection
