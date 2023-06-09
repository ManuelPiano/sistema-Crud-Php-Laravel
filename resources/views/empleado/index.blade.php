@extends('layouts.app')

@section('content')


<div class="container">


    
        @if(Session::has('message'))
        <div class="alert alert-warning alert-dismissible fade show" aria-hidden="true" role="alert">
        {{ Session::get('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </button>
        </div>
         @endif
</div>





<a href="{{url('empleado/create')}}" class="btn btn-success">Registrar nuevo empleado</a>
<br>
<br>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Correo</th>
            <th>Acciones</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach($empleados as $empleado)
        <tr>
            <td>{{ $empleado->id }}</td>


            <td>
            <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->foto }}" alt="" width="100" >            
            </td>


            <td>{{ $empleado->nombre }}</td>
            <td>{{ $empleado->apellidopaterno }}</td>
            <td>{{$empleado->apellitomaterno}}</td>
            <td>{{$empleado->correo}}</td>
            <td>
                
                <a href="{{ url('/empleado/' .$empleado->id.'/edit') }}" class="btn btn-warning">
                    EDITAR

                </a>
                 


                <form action="{{url('/empleado/' .$empleado->id)}}" method="POST" class="d-inline">
                    @csrf
                    {{method_field('DELETE')}}
                    <input type="submit" onclick="return confirm('¿Deseas borrar el registro?')" 
                    value="Borrar" class="btn btn-danger">

                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{!! $empleados->links() !!}
</div>
@endsection