@extends('layout')
@section('contenido')
<center>
<h2 class="mt-2 ">{{ $medicamento->exists ? 'Editar medicamento' : 'Agregar medicamento'}}</h2>

<div style="width:400px;heigth:200;border-radius:10px;padding:15px;" class="bg-info">
<form action="{{$medicamento->exists ? route ('medicamentos.update', $medicamento->id) : route('medicamentos.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @if($medicamento->exists)
      @method ('PUT')
    @endif
<div class="mb-3">
    <label for="" class="form-label">Nombre</label>
    <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $medicamento->nombre) }}">
    @error('nombre')
        <div class="text-danger">{{ $message }}</div>
    @enderror
  </div>

    <div class="mb-3">
    <label for="" class="form-label">Marca</label>
    <input type="text" class="form-control" name="marca" value="{{ old('nombre', $medicamento->marca) }}">
    @error('marca')
        <div class="text-danger">{{ $message }}</div>
    @enderror
  </div>

  
  <div class="mb-3">
    <label for="" class="form-label">Laboratorio</label>
    <input type="text" class="form-control" name="laboratorio" value="{{ old('laboratorio', $medicamento->laboratorio) }}">
    @error('laboratorio')
        <div class="text-danger">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="" class="form-label">Dosis</label>
    <input type="text" class="form-control" name="dosis" value="{{ old('dosis', $medicamento->dosis) }}">
    @error('dosis')
        <div class="text-danger">{{ $message }}</div>
    @enderror
  </div>
  
  @if($medicamento->exists && $medicamento->imagen)
  <div class="mb-3">
    <label for="" class="form-label">Imagen</label> <br>
    <img src="{{ asset('imagenes/'.$medicamento->imagen) }}" alt="imagen" heigth="100 px" width="200px">  
</div>
@endif
<div class="mb-3">
    <label for="imagen" class="form-label">Imagen</label>
    <input type="file" class="form-control" name="imagen">
  </div>
  <button type="submit" class="btn btn-primary">
    {{ $medicamento->exists ? 'Editar' : 'Guardar'}}
  </button>
</form>
</div>
</center>
@endsection