
<h1> {{$modo}} empleado </h1>

@if(count($errors)>0)

<div class="alert alert-danger" role="alert">
    <ul>
    @foreach($errors->all() as $error)
    <li>{{$error}}</li> 
    @endforeach
</ul>
</div>
    

@endif

<div class="form-group">

<label for="nombre"> Nombre</label>
<input class="form-control" type="text" name="nombre" 
value="{{ isset($empleado->nombre)?$empleado->nombre:old('nombre') }}" id="nombre">
<br>

</div>

<div class="form-group">
<label for="apellidopaterno"> Apellido Paterno</label>
<input class="form-control" type="text" name="apellidopaterno" 
value="{{ isset($empleado->apellidopaterno)?$empleado->apellidopaterno:old('apellidopaterno') }}" id="apellidopaterno">
<br>
</div>

<div class="form-group">

<label for="apellitomaterno"> Apellido Materno</label>
<input class="form-control" type="text" name="apellitomaterno" 
value="{{ isset($empleado->apellitomaterno)?$empleado->apellitomaterno:old('apellitomaterno') }}" id="apellitomaterno">
<br>
</div>

<div class="form-group">

<label for="correo"> Correo</label>
<input class="form-control" type="text" name="correo" value="{{ isset($empleado->correo)?$empleado->correo:old('correo') }}" id="correo">
<br>
</div>

<div class="form-group">

<label for="foto"> Foto</label>
@if(isset($empleado->foto))  
<img src="{{ asset('storage').'/'.$empleado->foto }}" class="img-thumbnail img-fluid" alt="" style="width:100px;height:100px;"> 
@endif
<input class="form-control" type="file" name="foto" value="" id="foto">
<br>
</div>

<input class="btn btn-success"  type="submit" value="{{$modo}} Datos">


<a class="btn btn-primary" href="{{url('empleado/')}}">Regresar</a>
<br>